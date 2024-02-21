<x-mail::message>
Hello, {{ $user_name }}

The document {{ $document->original_name }} was <span style="text-decoration: underline">{{ Str::title($status) }}</span> by the bank.

@if ($status == 'rejected')
<h6>Rejected Reason:</h6>
<x-mail::panel>
  {{ $document->rejected_reason }}
</x-mail::panel>
<br>
<x-mail::button :url="$url">
Kindly re-upload this document here
</x-mail::button>
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
