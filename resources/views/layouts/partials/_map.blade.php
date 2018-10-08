@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

    <script>
        $("form").submit(function(e){
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

        $('.ui.modal').modal({ blurring: false });
        var well_name = "{{ $location->well_name }}";
        var well_api = "{{ $location->api_number }}";
        var operator_name = "{{ $location->current_operator }}";
        var city = "{{ $location->closest_city ? $location->closest_city : ""}}";
        var state = "{{ $location->state ? $location->state : ""}}";
        var cityState = city + ", " + state;
        var latLon = String("{{ $location->latitude ? $location->latitude : 0 }},{{ $location->longitude ? $location->longitude : 0 }}");
        var androidLink = "https://www.google.com/maps/search/?api=1&query=" + latLon;
        var appleLink = "http://maps.apple.com/?q=" + latLon;

        // TODO: More security.... on thi function... yeah?
        if ($('#township').attr('id')) {
            if (city == "") {
                axios.get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latLon + '&key={{ env('GOOGLE_MAP_KEY') }}')
                    .then(response => {
                        var backupCity = "";
                        $.each(response.data.results[0].address_components, function (i, address_component) {
                            if (address_component.types[0] == "locality"){
                                itemLocality = address_component.long_name;
                                $('#township').text(itemLocality + ", ");
                                $('#township_label').text("City, ");
                                city = itemLocality;
                                cityState = city + ", " + "{{ $location->state ? $location->state : ""}}";
                                axios.get(window.location.href + '/city/' + city);
                                getCityCoordinates();
                            }
                            if (address_component.types[0] == "neighborhood"){
                                backupCity = address_component.long_name;
                                console.log(backupCity);
                            }
                            if (address_component.types[0] == "administrative_area_level_1"){
                                state = address_component.long_name;
                            }
                        });

                        if (city.trim() == "") {
                            $('#township').text(backupCity + ", ");
                            $('#township_label').text("City, ");
                            city = backupCity;
                            cityState = backupCity + ", " + state;
                            axios.get(window.location.href + '/city/' + backupCity);
                            getCityCoordinates();
                        }
                    }).catch(error => {
                        // Do something?
                });
            }
        }

        if (city != "") {
            getCityCoordinates();
        }
        function getCityCoordinates() {
            var bool = true;
            if (bool) {
                axios.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + city + '+' + state.split(' ').join('+') + '&key={{ env('GOOGLE_MAP_KEY') }}')
                    .then(response => {
                        var xlatLon = response.data.results[0].geometry.location;
                        var xlat = xlatLon.lat;
                        var xlon = xlatLon.lng;
                        getDirections(xlat, xlon);
                    });
            }
        }

        function getDirections(lat, lon) {
            axios.get('https://maps.googleapis.com/maps/api/directions/json?origin=' + lat + ',' + lon +
                '&destination=' + latLon + '&key={{ env('GOOGLE_MAP_KEY') }}').then(response => {
                console.log(response.data);
            });
        }
        // http://api.geonames.org/findNearestIntersectionJSON?formatted=true&lat=33.5020523071289&lng=-112.329467773438&username=keisto&style=full
        // http://api.geonames.org/findNearbyStreetsJSON?formatted=true&lat=lat&lng=lon&username=keisto&style=full
        // https://maps.googleapis.com/maps/api/directions/json?origin=\(nearLocation.coordinate.latitude),\(nearLocation.coordinate.longitude)&destination=\(lat),\(lon)&key=\(googleKey)

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
    </script>
    <script>
        var map;
        var latitude = Number("{{ $location->latitude ? $location->latitude : '' }}");
        var longitude = Number("{{ $location->longitude ? $location->longitude : '' }}");

        function loadMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 17,
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