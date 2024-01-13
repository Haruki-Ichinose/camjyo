<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
        {{$category}}のうち{{$HScode_data -> descripiton}}なものを{{$Country}}へ送る
    </h2>
   </x-slot>
   <div class="py-12">
    <div class="flex">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 flex flex-col">
    <div class="mb-4 text-left">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">輸出可否</h3>
        <p class="text-gray-700 dark:text-gray-300">
            @if($exportability_data->exportability == 1)
                輸出可能
            @elseif($exportability_data->exportability == 2)
                輸出不可能
            @else
                条件付き輸出可能
            @endif
        </p>
    </div>

    <div class="text-left">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">説明</h3>
        <p class="text-gray-700 dark:text-gray-300">{{ $exportability_data->explanation }}</p>
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
  </div>
    



</x-app-layout>