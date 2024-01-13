<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data -> descripiton}}なものを{{$Country}}へ送る
    </h2>
   </x-slot>
    <h3>輸出可否</h3>
    @if($exportability_data->exportability== 1 )
        <p class="">輸出可能</p>    
    @elseif($exportability_data->exportability== 2 )
        <p class="">輸出不可能</p>
    @else
        <p class="">条件付き輸出可能</p>
    @endif

    <h3>説明</h3>
    <p>{{$exportability_data -> explanation}}</p>
</x-app-layout>