<form method="post" action="">
{!! csrf_field() !!}

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
<div>原密码：<input type="password" name="password_old"></div>
<div>新密码：<input type="password" name="password"></div>
<div>确认密码：<input type="password" name="password_confirmation"></div>
<div><button type="submit">登录</button></div>
<div><button type="submit">返回</button></div>
</form>