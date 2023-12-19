<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            第{{ $number }}類
        </h2>
    </x-slot>

    @foreach($Item as $item)
        <p>{{$item -> HScode_4}}</p>
        <p>{{$item -> description}}</p>
    @endforeach


</x-app-layout>