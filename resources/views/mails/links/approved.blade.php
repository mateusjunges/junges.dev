@component('mail::message')
Hi,

Your link [{{ $link->title }}]({{ $link->url }}) was approved. You can now view it on [the links page at junges.dev]({{ route('community') }})

Thanks,

Mateus.
@endcomponent
