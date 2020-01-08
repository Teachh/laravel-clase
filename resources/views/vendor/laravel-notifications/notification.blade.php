@if($notification['enclose'])
    <{{ $notification['enclose'] }}>
@endif
<div class="notification {{ $notification['class'] }}"
     data-type="notification"
     data-close-class="{{ (Notify::getIconPrefix() . config('notifications.icons.close')) }}"
        {{ $notification['attributes'] }}>
    @if($notification['icon'])
        <span class="icon {{ $notification['icon'] }}"></span>
    @endif
    @if(!empty($notification['title']))
        <h1>{{ $notification['title'] }}</h1>
    @endif
    {!! Markdown::convertToHtml($notification['message']) !!}
</div>
@if($notification['enclose'])
    </{{ $notification['enclose'] }}>
@endif