<!-- resources/views/your/view.blade.php -->

<x-app-layout>
    <x-slot name="header">
         {{ __("HOME") }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-teal-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- ボタンの部分 -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-header fs-3">第{{$i}}類</h5>
                                <p class="card-text">
                                    {{ (new \App\Models\HScode_4digits())->getText($i) }}
                                </p>
                                <form method="POST" action="{{ route('2digit.index', ['number' => $i]) }}">
                                    @csrf
                                    <button class="btn btn-outline-primary btn-lg" type="submit">次へ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</x-app-layout>
