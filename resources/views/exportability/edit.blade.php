<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data -> descripiton}}なものを{{$Country}}へ送る
    </h2>
  </x-slot>  
    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
        <h2>現在のデータ</h2>
        <h3>輸出可否</h3>
        @if($exportability_data->exportability== 1 )
            <p class="">輸出可能<p>    
        @elseif($exportability_data->exportability== 2 )
            <p class="">輸出不可能<p>
        @else
            <p class="">条件付き輸出可能<p>
        @endif
    
        <h3>説明</h3>
        <p>{{$exportability_data -> explanation}}</p>


        <h3>この登録を削除する</h3>
        <form action="{{ route('exportability.destroy',$exportability_data -> id) }}" method="POST">
            @csrf
            @method('delete')
            <input type="submit" value="削除実行"></button>
        </form>
    </div>
    
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('exportability.update',$exportability_data -> id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-10">
              <select class="form-select mb-3" name="exportability" id="">
                <option selected>輸出状況を選択</option>
                <option value="1">輸出可能</option>
                <option value="2">輸出不可</option>
                <option value="3">条件付き輸出可能</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">輸出可否についての説明</label>
              <textarea class="form-control" name="explanation" rows="3"></textarea>
            </div>
            <input type="hidden" name="countries_id" value="{{$Country_id}}">
            <input type="hidden" name="h_scode_9digits_id" value="{{$HScode_id}}">

            <div class="flex items-center mt-4">
                <input type="submit" value="変更を登録する">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>