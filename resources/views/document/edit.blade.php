<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data-> description}}なものを{{$country_name}}へ送る
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="w-9/12 mx-auto">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="text-center">
          <h2 class="text-xl">{{$parent -> parent}}用の{{$child -> child}}の{{$grandchild -> grandchild}}に書類を編集</h2>
        </div>
        <div class="mt-4">
            <h2>現在のデータ</h2>
            <p class="text-sm">{{$document_data -> description}}</p>
            <a class="text-sm" target="_blank" href="{{$document_data -> URL}}">{{$document_data -> URL}}</a>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('document.update',$document_data -> id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">書類についての説明</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div>
                <label class="form-label">書類のURL</label>
                <textarea class="form-control" name="URL" rows="1"></textarea>
            </div>
            <input type="hidden" name="parents_id" value="{{$parent -> id}}">
            <input type="hidden" name="child_id" value="{{$child -> id}}">
            <input type="hidden" name="grandchild_id" value="{{$grandchild -> id}}">
            <input type="hidden" name="countries_id" value="{{$exportability_data -> countries_id}}">
            <input type="hidden" name="h_scode_9digits_id" value="{{$exportability_data -> h_scode_9digits_id}}">
            <input type="hidden" name="exportability_id" value="{{$exportability_data->id}}">
            <div class="flex items-center mt-4">
                <input type="submit" value="登録">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>