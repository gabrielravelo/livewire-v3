<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prueba
        </h2>
    </x-slot>

    @persist('player')
        <audio src="{{ asset('audios/suei.mp3') }}" controls></audio>
    @endpersist
</x-app-layout>