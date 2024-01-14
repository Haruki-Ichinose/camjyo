<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight ">
        {{$category}}のうち{{$HScode_data->descripiton}}なものを{{$Country}}へ送るための確認事項
    </h2>
   </x-slot>

       <div class="flex">
        <!-- サイドバーコンポーネントの呼び出し -->
        @include('layouts.sidebar')

        <main class="flex-1">

        <div class="max-w-7xl mx-auto p-4 ">
            <div class="bg-blue-800 overflow-hidden shadow-sm sm:rounded-lg">
              
                        <div class="font-semibold p-6 text-white ">
                           <div class="col-span-3">
                    <label class="block text-sm font-medium text-white">品目</label>
                    <span class="text-lg font-semibold">{{$category}}</span>
                </div>
                </div>       
        </div>

   <div class="py-12">
    <div class="flex mx-auto">
      <div class="bg-white dark:bg-gray-800 overflow-hidden  sm:rounded-lg mx-auto">
      <div class="p-6 bg-blue-800  border-b border-gray-200  flex flex-col mx-auto">
    <div class="mb-4 text-left">
        <h3 class="text-xl font-semibold text-white">輸出可否</h3>
        <p class="text-white ">
            @if($exportability_data->exportability == 1)
                輸出:O
            @elseif($exportability_data->exportability == 2)
                輸出:X
            @else
                条件付き輸出:O
            @endif
        </p>
    </div>
    

    <div class="text-left">
        <h3 class="text-xl font-semibold text-white">説明</h3>
        <p class="text-white">{{ $exportability_data->explanation }}</p>
    </div>
    </div>
</div>
 <div class=" mx-auto w-9/12">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @foreach($parents as $parent)
            <div class="p-6 border border-gray-200">
              <details close>
                <summary class="text-xl">
                  {{$parent -> parent}}
                </summary>
                <div class="mt-4">
                  @foreach($children as $child)
                    @if($child -> parents_id === $parent -> id)
                      <div class="p-2 bg-gray-100 border-b border-gray-200">
                        <details>
                          <summary class="text-lg">{{ $child -> child }}</summary>
                          @foreach($grandchildren as $grandchild)
                            @php
                              $flag = 1;
                            @endphp
                            @if($grandchild -> child_id === $child -> id && $grandchild -> parent_id === $parent -> id )
                              <ol>
                                <li class="ml-4 p-2 bg-white border border-gray-300 rounded">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                     <label class="form-check-label" for="flexCheckDefault">
                                  <p class="font-bold">{{ $grandchild -> grandchild }}</p>
                                    <div class="mt-2 ml-2">
                                      @if(is_null($documents))
                                        <div class="mt-2 flex justify-end">
                                          <form method="GET" action="{{ route('document.create')}}">
                                            <input type="hidden" name="exportability_id" value="{{ $exportability_data -> id }}" >
                                            <input type="hidden" name="parent_id" value="{{ $grandchild -> parent_id }}">
                                            <input type="hidden" name="child_id" value="{{ $grandchild -> child_id }}">
                                            <input type="hidden" name="grandchild_id" value="{{ $grandchild -> id }}">
                                            <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="ここに書類を追加"><bottun>
                                          </form>
                                        </div>
                                      @else
                                      @foreach($documents as $document)
                                        @if($grandchild -> id === $document -> grandchild_id && $grandchild -> child_id === $document -> child_id && $grandchild -> parent_id === $document ->parents_id )
                                          @php
                                            $flag = 0;
                                          @endphp
                                          <p class="text-sm">{{$document -> description}}</p>
                                          <a class="text-sm" target="_blank" href="{{$document -> URL}}">{{$document -> URL}}</a>
                                          <div class="mt-2 flex justify-end">
                                              <form method="GET" action="{{ route('document.edit',$document -> id)}}">
                                                <input type="hidden" name="exportability_id" value="{{ $exportability_data -> id }}" >
                                                <input type="hidden" name="parent_id" value="{{ $grandchild -> parent_id }}">
                                                <input type="hidden" name="child_id" value="{{ $grandchild -> child_id }}">
                                                <input type="hidden" name="grandchild_id" value="{{ $grandchild -> id }}">
                                                <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="この書類を編集"><bottun>
                                              </form>
                                              <form action="{{ route('document.destroy', $document -> id )}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                  <input type="hidden" name="exportability_id" value="{{ $exportability_data -> id }}">
                                                  <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="この書類を削除"></button>
                                              </form>
                                            </div>
                                        @endif
                                      @endforeach
                                      @endif
                                      @if($flag)
                                        <div class="mt-2 flex justify-end">
                                          <form method="GET" action="{{ route('document.create')}}">
                                            <input type="hidden" name="exportability_id" value="{{ $exportability_data -> id }}" >
                                            <input type="hidden" name="parent_id" value="{{ $grandchild -> parent_id }}">
                                            <input type="hidden" name="child_id" value="{{ $grandchild -> child_id }}">
                                            <input type="hidden" name="grandchild_id" value="{{ $grandchild -> id }}">
                                            <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="ここに書類を追加"><bottun>
                                          </form>
                                        </div>
                                         </label>
                                         </div>
                                      @endif
                                    </div>
                                </li>
                              </ol>
                            @endif
                          @endforeach
                        </details>
                      </div>
                    @endif
                  @endforeach
                </div>
              </details>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="container mt-5">
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            ファイルアップロード
        </div>
        <div class="card-body">
            <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">ファイルを選択</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary">アップロードする</button>
            </form>
        </div>
    </div>
</div>



  </div>
    



</x-app-layout>