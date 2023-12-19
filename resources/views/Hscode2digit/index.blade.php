<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            第{{ $number }}類
        </h2>
    </x-slot>
    <div class = "mx-auto">
        <table class = "table table-striped" >
            <thead>    
                <tr>
                    <th>HScode上4桁</th><th>品目</th>
                </tr>
            </thead>
            @foreach($Item as $item)
            <tbody>
                <tr>
                    <td>{{$item -> HScode_4}}</td>
                    <td>{{$item -> description}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>


</x-app-layout>