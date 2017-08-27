<link rel="stylesheet" href="{{ URL::asset('css/jackpush.css') }}" />

<div id="login">
    <h1>JACKPUSH</h1>
<form method="POST" action="">
    {!! csrf_field() !!}

    @if(session('msg'))
    <div>{{ session('msg') }}</div>
    @endif
    <div>
        账号
        <input type="text" name="phonenumber" value="{{ old('phonenumber') }}">
    </div>

    <div>
        密码
        <input type="password" name="password" id="password">
    </div>

    <div>
        <button type="submit">登录</button>
    </div>
</form>

</div>