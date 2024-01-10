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

    <div class="mx-auto p-4">
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
                
                @for($i = 1; $i <= $N; $i++)
                    <div>
                        <label for="country{{ $i }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">輸出国{{ $i }}</label>
                        <select name="countries[]" id="country{{ $i }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @foreach($allCountries as $country)
                                <option value="{{ $country->name }}">
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endfor
                
                <div class="col-span-2 flex items-end">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        検索
                    </button>
                </div>
            </div>
        </form>
        
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
                            輸出国{{ $i }}
                        </th>
                    @endfor
                </tr>
            </thead>
                
                @foreach($nine_digit_ctt as $nine_digit_ctt)
                <tbody>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$nine_digit_ctt -> description}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$nine_digit_ctt -> HScode_4}}{{$nine_digit_ctt -> HScode_5}}</td>
                        @for($i = 1; $i <= $N; $i++)
                            <td class="px-6 py-4 whitespace-nowrap">
                                状態
                            </td>
                        @endfor
                    </tr>
                </tbody>
                @endforeach
                </table>
            </div>
        </div>
 
</x-app-layout>