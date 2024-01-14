<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-white">
        {{$category}}の{{$HScode_data -> descripiton}}を{{$Country}}へ送るための書類
    </h2>
  </x-slot>  
  <main class="flex-1"> 
    <div class="py-12 flex ">
    <div class="w-4/12 ">
  <div class="p-6 bg-blue-800 shadow-sm sm:rounded-l  mx-auto">
    <div class="mx-auto p-2">
        <h2 class="font-semibold text-xl text-white flex">現在のデータ</h2>
    </div>

    <div class="mx-auto p-2">
        <h3 class="font-semibold text-xl text-white">輸出可否</h3>
        @if($exportability_data->exportability == 1)
            <p class="text-white">輸出可能</p>    
        @elseif($exportability_data->exportability == 2)
            <p class="text-white">輸出不可能</p>
        @else
            <p class="text-white">条件付き輸出可能</p>
        @endif
    </div>
  
    <div class="mx-auto p-2">
        <h3 class="font-semibold text-xl text-white">説明</h3>
        <p class="text-white">{{$exportability_data->explanation}}</p>
    </div>

    <div class="mx-auto p-2">
        <h3 class="text-white">この登録を削除する</h3>
        <button onclick="showModal()" class="text-white bg-red-500 hover:bg-red-600 py-2 px-4 rounded">削除実行</button>
    </div>
  </div>
    </div>
    

 <div class=" mx-auto w-9/12 p-6">
      <div class=" bg-white dark:bg-gray-800 border-b border-blue-800 dark:border-gray-800 ">
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
            @foreach($page_info as $value)
                <input type="hidden" name="page_info[]" value="{{$value}}">
            @endforeach
            <div class="flex items-center mt-4">
                <input type="submit" value="変更を登録する">
            </div>
          </form>
        </div>
     </div>
   </div>
</div>
</main>




        <!-- モーダルウィンドウ -->
        <div id="deleteModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <p>本当に削除しますか？</p>
                <form action="{{ route('exportability.destroy',$exportability_data -> id) }}" method="POST">
                    @csrf
                    @method('delete')
                    @foreach($page_info as $value)
                        <input type="hidden" name="page_info[]" value="{{$value}}">
                    @endforeach
                    <button type="submit" class="btn btn-danger">はい、削除する</button>
                </form>
            </div>
        </div>
    </div>
    </div>
   
  </div>

  <script>
        function showModal() {
            document.getElementById("deleteModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("deleteModal").style.display = "none";
        }
  </script>
  <style>
    .modal {
      display: none; /* 初期状態ではモーダルを非表示にする */
      position: fixed; /* モーダルを画面に固定 */
      z-index: 2; /* 他の要素より上に表示 */
      left: 0;
      top: 0;
      width: 100%; /* 幅全体 */
      height: 100%; /* 高さ全体 */
      overflow: auto; /* スクロールバーが必要な場合に表示 */
      background-color: rgb(0, 0, 0); /* 背景色は黒 */
      background-color: rgba(0, 0, 0, 0.4); /* 背景色は半透明 */
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; /* 上下にマージンを取り、水平方向は自動で中央揃え */
      padding: 20px;
      border: 1px solid #888;
      width: 50%; /* モーダルの幅を設定 */
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      animation-name: animatetop;
      animation-duration: 0.4s
    }

    @keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
    }

    .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }

    .modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
    }

    /* ボタンのデザイン */
    .btn {
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 18px;
    }

    /* 削除ボタンのスタイル */
    .btn-danger {
    background-color: #f44336;
    color: white;
    }

    /* 削除ボタンのホバー時のスタイル */
    .btn-danger:hover {
    background-color: #da190b;
    }
  </style>
</x-app-layout>