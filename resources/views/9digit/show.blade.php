@php
    $N = 3;
    $allCountries = \App\Models\Country::all();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight max-w-screen-xl ">
            {{ $four_digit_ctt->description }}: [HScodde"{{ $four_digit_ctt->HScode_4 }}"]の内容
        </h2>
    </x-slot>

    <div class="mx-auto p-4 ">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 max-auto text-gray-900 ">
            <form method="POST" action="{{ route('6digit.show') }}" class="mb-6">
                @csrf
                <input type="hidden" name="number" value="{{ $four_digit_ctt->HScode_4 }}">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">品目</label>
                        <span class="text-lg font-semibold">{{ $four_digit_ctt->description }}</span>
                    </div>
                    
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">HScode</label>
                        <span class="text-lg font-semibold">{{ $four_digit_ctt->HScode_4 }}{{ $four_digit_ctt->HScode_5 }}</span>
                    </div>
                    <div class="clear-both">
                        @for($i = 1; $i <= $N; $i++)
                            <div>
                                <label for="country{{ $i }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">輸出国{{ $i }}</label>
                                <select name="countries[]" id="country{{ $i }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($allCountries as $country)
                                        <option value="{{ $country -> name  }}" {{ $input_countries[$i-1] == $country -> name ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                    </div>
                    
                    <div class="col-span-2 flex items-end">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            検索
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        品目
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        HScode
                    </th>
                    @for($i = 1; $i <= $N; $i++)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        
                        輸出国{{$i}}:{{ $input_countries[$i-1] }}
                        </th>
                    @endfor
                </tr>
            </thead>
                
                @foreach($nine_digit_ctt as $Nine_digit_ctt)
                <tbody>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$Nine_digit_ctt -> description}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$Nine_digit_ctt -> HScode_4}}{{$Nine_digit_ctt -> HScode_5}}</td>
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
                                    <form method="GET" action="{{ route('exportability.edit')}}">
                                        <input type="hidden" name="exportability_id" value="{{ $exportability -> id }}" >
                                        <input type="hidden" name="page_info[]" value="{{ $four_digit_ctt->HScode_4 }}">
                                        @for($k = 1; $k <= $N; $k++)    
                                            <input type="hidden" name="page_info[]" value="{{ $input_countries[$k-1] }}">
                                        @endfor
                                        <input type="submit" value="編集"></button>
                                    </form>
                                    <form action="{{ route('exportability.show', ['exportability' => $exportability->id]) }}" method="GET">
                                        <button type="submit">詳細書類確認</button>
                                    </form>
                                @else
                                    <!-- 情報がない場合のリンク -->
                                    <p class="">データ未入力<p>
                                    <form method="GET" action="{{ route('exportability.create')}}">
                                        <input type="hidden" name="Country" value="{{ $input_countries[$i-1] }}" >
                                        <input type="hidden" name="HScode_id" value="{{ $hscode_id}}">
                                        <input type="hidden" name="page_info[]" value="{{ $four_digit_ctt->HScode_4 }}">
                                        @for($k = 1; $k <= $N; $k++)    
                                            <input type="hidden" name="page_info[]" value="{{ $input_countries[$k-1] }}">
                                        @endfor
                                        <input type="submit" value="新規登録"></button>
                                    </form>
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