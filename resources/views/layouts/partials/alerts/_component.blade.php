<div style="position: absolute; width: 320px; top:64px; right: 0; left: 0; margin: auto">
    <div class="ui {{ $type }} icon flash-message message">
        <i class="{{ $icon }} icon"></i>
        <i class="close icon"></i>
        <div class="content">
            <div class="header">{{ $header }}</div>
            <p>{{ $slot }}</p>
        </div>
    </div>
</div>