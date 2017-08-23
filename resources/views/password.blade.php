@extends('layouts')
@section('content')
    <div id="content">
        <div id="title"><a href="{{url('/')}}">首页</a> >> 修改密码</div>
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
<div><button type="submit">保存</button></div>
</form>
    </div>
@endsection