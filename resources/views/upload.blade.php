<!DOCTYPE html>
<html>
<head>
    <title>ファイルアップロード</title>
</head>
<body>

@if(Session::has('success'))
    <div style="color: green;">{{ Session::get('success') }}</div>
@endif

@if(Session::has('error'))
    <div style="color: red;">{{ Session::get('error') }}</div>
@endif

<form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">アップロードする</button>
</form>

</body>
</html>