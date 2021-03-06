@if(session()->has('success'))
    @component('layouts.partials.alerts._component', ['type' => 'green', 'header' => 'Success!', 'icon' => 'thumbs up outline'])
        {{ session('success') }}
    @endcomponent
@endif

@if(session()->has('error'))
    @component('layouts.partials.alerts._component', ['type' => 'red', 'header' => 'Failed!', 'icon' => 'life ring outline'])
        {{ session('error') }}
    @endcomponent
@endif

@if(session()->has('warning'))
    @component('layouts.partials.alerts._component', ['type' => 'orange', 'header' => 'Warning!', 'icon' => 'exclamation triangle icon'])
        {{ session('warning') }}
    @endcomponent
@endif