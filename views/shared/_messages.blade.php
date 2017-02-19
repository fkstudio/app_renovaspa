@if (session('success'))
<p class="open-message message-alert success">{{ session('success') }}</p>
@endif

@if (session('failure'))
<p class="open-message message-alert failure">{{ session('failure') }}</p>
@endif