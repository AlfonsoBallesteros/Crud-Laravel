@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Header Title
        @endcomponent
    @endslot

{{-- Body --}}

    # Correo!
    Enviado a {{ $client->email }}
{{--   
    @component('mail::button', ['url' => '', 'color' => 'success'])
            Enlace
    @endcomponent  
--}}

{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Super FOOTER!
        @endcomponent
    @endslot
@endcomponent