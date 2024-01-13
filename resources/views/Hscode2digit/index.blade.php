<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            第{{ $number }}類
        </h2>
    </x-slot>
    <div class="flex">
        <!-- サイドバーコンポーネントの呼び出し -->
        @include('layouts.sidebar')
    
        <main class="flex-1"> 
        
        <div class="max-w-7xl mx-auto p-2 flex">
            <div class="bg-blue-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="font-semibold p-6 text-white  mx-auto">
                            第{{ $number }}類の詳細
                        </div>
             </div>
        </div>     
    
        <div class="mx-auto p-4">
        <table class="table table-striped border border-white shadow-md" style="table-layout: fixed; width: 100%;">
            <colgroup>
                <col style="width: 33.3%;">
                <col style="width: 33.3%;">
                <col style="width: 33.3%;">
            </colgroup>
            <thead class="bg-yellow-500 text-white">
                <tr>
                    <th class="fs-5 border">HScode</th>
                    <th class="fs-5 border">品目</th>
                    <th class="fs-5 border">詳細</th>
                </tr>
            </thead>
            <tbody> <!-- tbodyをループの外で一度だけ生成 -->
                @foreach($Item as $item)
                    <tr>
                        <td class="border">{{ $item->HScode_4 }}</td>
                        <td class="border">{{ $item->description }}</td>
                        @php
                            $buf = $item->HScode_4;
                        @endphp
                        <td class="border">
                            <form method="POST" action="{{ route('6digit.index', ['number' => $buf]) }}">
                                @csrf
                                <button type="submit" class="btn btn-light">さらに</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </main>
    </div> 
</x-app-layout>