<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            
            <!--ボタンタグの部分-->
            @for ($i = 1; $i <= 2; $i++)
                <form method="POST" action="{{ route('2digit.index' , ['number' => $i] ) }}" >
                    @csrf
                    <button class="btn btn-outline-primary" type="submit" >第{{$i}}類</button>
                </form>
            @endfor
        </div>
    </div>
</x-app-layout>
