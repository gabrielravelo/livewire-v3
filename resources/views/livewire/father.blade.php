<div>
    @persist('player')
        <audio src="{{ asset('audios/suei.mp3') }}" controls></audio>
    @endpersist

    <x-button wire:click='redirigir'>
        Ir a prueba
    </x-button>

    <h1 class="text-2xl font-semibold">Soy el componente padre</h1>

    <div>
        <livewire:children :$name />
    </div>
</div>
