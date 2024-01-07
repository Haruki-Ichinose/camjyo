<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category -> description}}のうち{{$HScode_data -> description}}なものを{{$Country}}へ送る
    </h2>

    <h3>状況</h3>
       {{$exportability_id}}
  </x-slot>
</x-app-layout>