@component('mail::message')

    {{-- Body --}}

    # Correo!
    Enviado a {{ $client->email }}
    Eveento el {{ $client->cita}}

    {{--   
    @component('mail::button', ['url' => '', 'color' => 'success'])
            Enlace
    @endcomponent  
    --}}

@endcomponent