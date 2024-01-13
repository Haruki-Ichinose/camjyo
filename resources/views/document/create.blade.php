<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data-> description}}なものを{{$country_name}}へ送る
    </h2>
  </x-slot>
{{$parent -> parent}}
{{$child -> child}}
{{$grandchild -> grandchild}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('exportability.store') }}" method="POST">
            @csrf
            
            <div class="flex items-center mt-4">
                <input type="submit" value="登録">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>