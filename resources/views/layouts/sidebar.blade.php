<!-- resources/views/layouts/sidebar.blade.php -->
<div class="bg-yellow-500 text-white p-4">
    <!-- サイドバーのコンテンツ -->
    <ul class="list-group">
<li class="list-group-item list-group-item-light">
 <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        TOPへ
</x-nav-link>
</li>
        <li class="list-group-item list-group-item-light">分類
        <!-- 追加のメニュー項目をここに追加 -->
         @for ($i = 1; $i <= 10; $i++)
          <form method="POST" action="{{ route('2digit.index', ['number' => $i]) }}">
                @csrf
                <button class="btn btn-outline-black btn-lg" type="submit">第{{$i}}類</button>
          </form>
          @endfor
          </li>
    </ul>
</div>





