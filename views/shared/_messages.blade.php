@if (session('success'))
<p class="message-alert success">{{ session('success') }}</p>
@endif

@if (session('failure'))
<p class="message-alert failure">{{ session('failure') }}</p>
@endif