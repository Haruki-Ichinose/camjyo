<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data -> descripiton}}なものを{{$Country}}へ送る
    </h2>
   </x-slot>
   <div class="py-12">
    <div class=" mx-auto w-9/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          <h3>輸出可否</h3>
          @if($exportability_data->exportability== 1 )
              <p class="">輸出可能</p>    
          @elseif($exportability_data->exportability== 2 )
              <p class="">輸出不可能</p>
          @else
              <p class="">条件付き輸出可能</p>
          @endif
      
          <h3>説明</h3>
          <p>{{$exportability_data -> explanation}}</p>
        </div>
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
                            @if($grandchild -> child_id === $child -> id && $grandchild -> parent_id === $parent -> id )
                              <ol>
                                <li class="ml-4 p-2 bg-white border border-gray-300 rounded">
                                  <p class="font-bold">{{ $grandchild -> grandchild }}</p>
                                    <div class="mt-2 ml-2">
                                      <p class="text-sm">アメリカ向け輸出牛肉取扱認定施設リスト</p>
                                      <a class="text-sm" href="https://www.maff.go.jp/j/shokusan/hq/i-4/attach/pdf/yusyutu_shinsei_hokubei-23.pdf">https://www.maff.go.jp/j/shokusan/hq/i-4/attach/pdf/yusyutu_shinsei_hokubei-23.pdf</a>
                                      @if(1)
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
                                      <div class="mt-2 flex justify-end">
                                          <form method="GET" action="{{ route('document.create')}}">
                                            <input type="hidden" name="exportability_id" value="{{ $exportability_data -> id }}" >
                                            <input type="hidden" name="parent_id" value="{{ $grandchild -> parent_id }}">
                                            <input type="hidden" name="child_id" value="{{ $grandchild -> child_id }}">
                                            <input type="hidden" name="grandchild_id" value="{{ $grandchild -> id }}">
                                            <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="この書類を編集"><bottun>
                                          </form>
                                          <form action="{{ route('exportability.create') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                              <input class="p-2 border border-gray-500 rounded-lg text-sm" type="submit" value="この書類を削除"></button>
                                          </form>
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
  </div>
    



</x-app-layout>