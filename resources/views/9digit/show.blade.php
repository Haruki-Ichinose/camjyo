@php
    $N = 3;
    $allCountries = \App\Models\Country::all();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $four_digit_ctt -> description }}:[HScode"{{ $four_digit_ctt -> HScode_4 }}"]の内容
        </h2>
    </x-slot>
        
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <table class = "table table-striped" >
                <thead>    
                    <tr>
                        <th>品目</th><th>HScode</th>
                        <form method="POST" action="{{ route('6digit.show') }}">
                            @csrf
                                <input type="hidden" name="number" value="{{ $four_digit_ctt -> HScode_4 }}">
                            @for($i = 1; $i <= $N; $i++)
                                <th>輸出国{{$i}}
                                    <select name="countries[]" id="" class=" form-select form-select-sm $form-select-font-size:3 mb-3" aria-label=".form-select-sm example">
                                        @foreach($allCountries as $country)
                                            <option value="{{ $country -> name  }}" {{ $input_countries[$i-1] == $country -> name ? 'selected' : '' }}>
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
                
                @foreach($nine_digit_ctt as $Nine_digit_ctt)
                    <tbody>
                        <tr>
                            <td>{{$Nine_digit_ctt -> description}}</td>
                            <td>{{$Nine_digit_ctt -> HScode_4}}{{$Nine_digit_ctt -> HScode_5}}</td>
                            @for($i = 1; $i <= $N; $i++)
                                <td>
                                @php
                                    $country_id = $country_ids[$i-1];
                                    $hscode_id = $Nine_digit_ctt->id;
                                    $exportability = $exportabilities[$country_id][$hscode_id] ?? null;
                                @endphp

                                @if ($exportability)
                                    <!-- ここにexportabilityの具体的な情報を表示 -->
                                    @if($exportability->exportability== 1 )
                                        <p class="">輸出可能<p>    
                                    @elseif($exportability->exportability== 2 )
                                        <p class="">輸出不可能<p>
                                    @else
                                        <p class="">判断保留中<p>
                                    @endif
                                    <a href="{{ route('exportability.edit', ['exportability'=>$exportability]) }}">
                                        {{ __('編集') }}
                                    </a>
                                    <br>
                                    <a href="{{ route('exportability.show',['exportability'=>$exportability,'HScode' => $hscode_id, 'Country' => $country_id ])}}">
                                        {{ __('詳細書類確認') }}
                                    </a>
                                @else
                                    <!-- 情報がない場合のリンク -->
                                    <p class="">データ未入力<p>
                                    <a href="{{ route('exportability.create', ['HScode' => $hscode_id, 'Country' => $country_id ]) }}">
                                        {{ __('新規登録') }}
                                    </a>
                                @endif
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>