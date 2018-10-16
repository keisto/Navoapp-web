<div id="modal_terms" class="ui modal">
    <div class="header">Terms and Conditions</div>
    <div class="scrolling content">
        {{--<h4>Terms</h4>--}}
        {{--<p>By accessing the website at https://navoapp.io, you are agreeing to be bound by these terms of service,--}}
            {{--all applicable laws and regulations, and agree that you are responsible for compliance with any applicable--}}
            {{--local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site.--}}
            {{--The materials contained in this website are protected by applicable copyright and trademark law.</p>--}}
        {{--<h4>Disclaimer</h4>--}}
        {{--<p>The information provided by Navoapp.io are provided on an 'as is' basis. Navo makes no warranties,--}}
            {{--expressed or implied, and hereby disclaims and negates all other warranties including, without limitation,--}}
            {{--implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of--}}
            {{--intellectual property or other violation of rights.</p>--}}
        {{--<h4>License</h4>--}}
        {{--<p>Navo may only be accessed by users who have registered and therefore agreed to these terms and conditions. Team accounts--}}
            {{--may register users, but the user must agree to the terms and privacy policy before using Navo's services.--}}
            {{--In accessing Navo, you agree that the data may only be used for your use and may not be sold or redistributed--}}
            {{--without the written consent of Navo. No license or claim is made to public domain data except that such data--}}
            {{--may not be obtained from this site for resale.</p>--}}
        {{--<p>Further, Navoapp.io does not warrant or make any representations concerning the accuracy, likely results,--}}
            {{--or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites--}}
            {{--linked to this site.</p>--}}
        {{--<h4>Links</h4>--}}
        {{--<p>Navo has not reviewed all of the sites linked to its website and is not responsible for the contents--}}
            {{--of any such linked site. The inclusion of any link does not imply endorsement by Navo of the site.--}}
            {{--Use of any such linked website is at the user's own risk.</p>--}}
    </div>
</div>

<div id="modal_privacy" class="ui modal">
    <div class="header">Privacy Policy</div>
    <div class="scrolling content">
        <p>Very long content goes here</p>
    </div>
</div>

@section('scripts')
    <script>
        $('#show_terms').click(function () {
            $('#modal_terms').modal('show');
        });

        $('#show_privacy').click(function () {
            $('#modal_privacy').modal('show');
        });
    </script>
@endsection