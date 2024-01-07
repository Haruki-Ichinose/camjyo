@php
    $N = 3;
    $allCountries = \App\Models\Country::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $four_digit_ctt -> description }}:[HScodde"{{ $four_digit_ctt -> HScode_4 }}"]の内容
        </h2>
    </x-slot>
        
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <table class = "table table-striped" >
                <thead>    
                    <tr>
                        <th>品目</th><th>HScode</th>
                        <form method="POST" action="{{ route('6digit.show')}}">
                            @csrf
                                <input type="hidden" name="number" value="{{ $four_digit_ctt -> HScode_4 }}">
                            @for($i = 1; $i <= $N; $i++)
                                <th>輸出国{{$i}}
                                    <select name="countries[]" id="" class="form-select form-select-sm mb-3" aria-label=".form-select-sm example">
                                            <option value=""></option>
                                        @foreach($allCountries as $country)
                                            <option value="{{ $country -> name  }}">
                                                {{$country -> name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </th>
                            @endfor
                                <th>
                                    <input type="submit" value="検索"></button>
                                </th>
                        </form>
                    </tr>
                </thead>
                
                @foreach($nine_digit_ctt as $nine_digit_ctt)
                <tbody>
                    <tr>
                        <td>{{$nine_digit_ctt -> description}}</td>
                        <td>{{$nine_digit_ctt -> HScode_4}}{{$nine_digit_ctt -> HScode_5}}</td>
                        @for($i = 1; $i <= $N; $i++)
                            <td>
                                ー
                            </td>
                        @endfor
                    </tr>
                </tbody>
                @endforeach
                </table>
            </div>
        </div>
</x-app-layout>