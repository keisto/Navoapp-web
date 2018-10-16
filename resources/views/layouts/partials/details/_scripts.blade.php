@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    {{--<script src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
    <script>
        $( document ).ready(function() {

            $('#select_all').checkbox({
                onChecked() {
                    console.log('check');
                    const options = $('#team_numbers > option').toArray().map((obj) => obj.value);
                    $('#team_numbers').dropdown('set exactly', options);
                },
                onUnchecked() {
                    $('#team_numbers').dropdown('clear');
                },
            });

            $("#favorite-form").submit(function(e){
                e.preventDefault(e);
                axios.post("/location/favorite/{{$location->id}}").then(response => {
                    if (response.data == "removed") {
                        $('#favorite_button').removeClass('yellow').removeClass('button')
                            .addClass('basic').addClass('button');
                        $('#favorite_button').attr('data-tooltip', 'Location Removed.');
                    } else if (response.data == "added") {
                        $('#favorite_button').removeClass('basic').removeClass('button')
                            .addClass('yellow').addClass('button');
                        $('#favorite_button').attr('data-tooltip', 'Location Added!');
                    } else if (response.data == "error") {
                        $('#favorite_button').attr('data-tooltip', 'Failed to Add.');
                    }
                }).catch(error => {
                    $('#favorite_button').attr('data-tooltip', 'Failed to Add.');
                });
            });

            var $originalUserNotes;
            resetNote();

            $("#note-form").submit(function(e){
                e.preventDefault(e);
                axios.post("/location/note/{{$location->id}}", { text : $('#note_text').val() }).then(response => {
                    if (response.data == "updated") {
                        setTimeout(function () {
                            $('#note_button').addClass('disabled');
                        }, 2500);
                        $('#note_button').attr('data-tooltip', 'Note Updated.');
                        $('#note_updated').text('Updated: just now');
                        resetNote();
                    } else if (response.data == "saved") {
                        setTimeout(function () {
                            $('#note_button').addClass('disabled');
                        }, 2500);
                        $('#note_button').attr('data-tooltip', 'Note Saved!');
                        $('#note_updated').text('Updated: Now');
                        resetNote();
                    } else if (response.data == "removed") {
                        setTimeout(function () {
                            $('#note_button').addClass('disabled');
                        }, 2500);
                        $('#note_updated').text('No Note Created');
                        $('#note_button').attr('data-tooltip', 'Note Removed.');
                        resetNote();
                    } else if (response.data == "error") {
                        $('#note_button').attr('data-tooltip', 'Failed. Try to refresh?');
                    }
                }).catch(error => {
                    $('#note_button').attr('data-tooltip', 'Failed.');
                });
            });
            var totalMessagesToSend = 0;
            var messagesSentSoFar = 0;
            $('#message-form').submit(function (e) {
                e.preventDefault();
                $("#message_sent_to").html('Successfully sent to: ');
                $('#progress_modal').modal('show');
                numbers = $('#add_numbers').val().split(",");
                users = $('#team_numbers').val();

                if (users) {
                    totalMessagesToSend = users.length;
                    if (users.length > 0) {
                        for (var i = 0; i < users.length; i++) {
                            sendMessage(users[i]);
                        }
                    }
                }

                if (numbers.length > 0) {
                    if (numbers[0].length >= 10) {
                        totalMessagesToSend+= numbers.length;
                        for (var i = 0; i < numbers.length; i++) {
                            sendMessage(null, numbers[i].trim());
                        }
                    }
                }
            });

            function sendMessage($user, $number = null) {
                axios.post("/location/share/message", {
                    message : $('#text-message').val(),
                    user : $user,
                    number : $number,
                }).then(response => {
                    messagesSentSoFar++;
                    $('#progress_percent').data('total', totalMessagesToSend);
                    $('#progress_percent').data('value', messagesSentSoFar);
                    $('#progress_percent').progress({
                        label: 'ratio',
                        text: {
                            ratio: '{value} of {total}'
                        }
                    });
                    if (response.data != "error") {
                        if (messagesSentSoFar != totalMessagesToSend) {
                            $("#message_sent_to").html($("#message_sent_to").html() + response.data + ", ");
                        } else {
                            $("#message_sent_to").html($("#message_sent_to").html() + response.data);
                        }
                    }
                }).catch(error => {
                    // Error
                });
            }

            function resetNote() {
                $originalUserNotes = $('#user_note').val();
                $('#note_text').val($originalUserNotes);
            }

            $('#user_note').keyup(function () {
                if ($originalUserNotes != $('#user_note').val()) {
                    $('#note_text').val($('#user_note').val());
                    $('#note_button').removeClass('disabled');
                } else {
                    $('#note_button').addClass('disabled');
                }
            });

            // $('.ui.modal').modal({ blurring: false });
            var well_name = "{{ $location->well_name }}";
            var well_api = "{{ $location->api_number }}";
            var operator_name = "{{ $location->current_operator }}";
            var city = "{{ $location->closest_city ? $location->closest_city : ""}}";
            var state = "{{ $location->state ? $location->state : ""}}";
            var cityState = city + ", " + state;
            var latitude = String("{{ $location->latitude ? $location->latitude : 0 }}");
            var longitude = String("{{ $location->longitude ? $location->longitude : 0 }}");
            var latLon = String(latitude + "," + longitude);
            var androidLink = "https://www.google.com/maps/search/?api=1&query=" + latLon;
            var appleLink = "http://maps.apple.com/?q=" + latLon;

            var message = $('#text-message');
            var messageVal = $('#text-message').val();

            $('.checkbox input:checkbox').each(function () {
                $(this).change(function () {
                    messageBuilder();
                });
            });

            $('#well_notes').keyup(function () {
                messageBuilder();
            });

            if ($('#no-latlon-mobile')) {
                if (!isMobile)
                $('#no-latlon-mobile').css({'margin-top':'-144px'});
            }
            messageBuilder();
            function messageBuilder() {
                messageVal = "";
                var checked = false;
                $('.checkbox input:checkbox').each(function () {
                    if ($(this).is(':checked')) {
                        checked = true;
                        switch ($(this).attr('id')) {
                            case 'well_name':
                                message.val(messageVal + "Well Name: \n" + well_name + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'well_api':
                                message.val(messageVal + "API Number: \n" + well_api + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'well_operator':
                                message.val(messageVal + "Operator: \n" + operator_name + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'well_location':
                                message.val(messageVal + "Nearest City, State: \n" + cityState + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'well_latlon':
                                message.val(messageVal + "Latitude, Longitude: \n" + latLon + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'apple_device':
                                message.val(messageVal + "Apple Link: \n" + appleLink + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            case 'android_device':
                                message.val(messageVal + "Android Link: \n" + androidLink + "\n");
                                messageVal = $('#text-message').val();
                                break;
                            default:
                                messageVal = "";
                                break;
                        }
                    }
                });
                if ($('#well_notes').val() != "") {
                    message.val(messageVal + "Notes: \n" + $('#well_notes').val() + "\n");
                    messageVal = $('#text-message').val();
                }
                if(messageVal != "") {
                    $('#copy_button').removeClass('disabled');
                    $('#send_button').removeClass('disabled');
                    message.val(messageVal + "Provided by: Navoapp.io");
                    messageVal = $('#text-message').val();

                }
                if (!checked && $('#well_notes').val() == "") {
                    message.val("");
                    $('#copy_button').addClass('disabled');
                    $('#send_button').addClass('disabled');
                }
            }


            function copyMessage() {
                var copyText = message;
                copyText.select();
                document.execCommand("copy");
                document.getSelection().removeAllRanges();

                $('#copy_button').attr('data-tooltip', 'Message Copied!');
                // setTimeout(function () {
                //     $('.ui.modal').modal("hide");
                // }, 1000);
                setTimeout(function () {
                    $('#copy_button').attr('data-tooltip', 'Copy Message');
                }, 2500);
            }
        });


    </script>
    <script>
        var map;
        var latitude = Number("{{ $location->latitude ? $location->latitude : '' }}");
        var longitude = Number("{{ $location->longitude ? $location->longitude : '' }}");

        function loadMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            {{--var image = "{{ asset('images/point-a.svg') }}";--}}
            var marker = new google.maps.Marker({
                position: {lat: latitude, lng: longitude},
                map: map,
                title: '{{ $location->well_name }}',
            });
        }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=loadMap"></script>
@endsection