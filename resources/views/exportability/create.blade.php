<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white">
        {{$category}}の{{$HScode_data-> description}}を{{$Country}}へ輸出
    </h2>
  </x-slot>
  

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('exportability.store') }}" method="POST">
            @csrf
            <div class="mb-10">
              <select class="form-select mb-3" name="exportability" id="" required>
                <option selected>輸出状況を選択</option>
                <option value="1">O</option>
                <option value="2">X</option>
                <option value="3">条件付きO</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">輸出可否についての説明</label>
              <textarea class="form-control" name="explanation" rows="3"  required></textarea>
            </div>
            <input type="hidden" name="countries_id" value="{{$Country_id}}">
            <input type="hidden" name="h_scode_9digits_id" value="{{$HScode_id}}">
            @foreach($page_info as $value)
                <input type="hidden" name="page_info[]" value="{{$value}}">
            @endforeach
            <div class="flex items-center mt-4">
                <input type="submit" value="登録">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>