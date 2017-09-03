@extends('layouts')
@section('content')
    <div style="padding: 15px;">
        <!-- 面包屑 -->
        <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a href="{{url('CodeInfo')}}">游戏基本信息</a>
            <a><cite>道具/代码基本信息</cite></a>
        </span>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>
        <!-- 提示信息显示区域 -->
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif
    <!-- 代码基本信息新增表单 -->
        <form method="post" class="layui-form" action="{{url('CodeInfoConf')}}">
            {!! csrf_field() !!}
            <label class="layui-inline">道具名称:</label>
            <div class="layui-inline">
                <input type="text" name="itemname" required  lay-verify="required" placeholder="请输入道具名称" autocomplete="off" class="layui-input">
            </div>
            {!! $inputstr !!}
            <label class="layui-inline">资费（分）:</label>
            <div class="layui-inline">
                <input type="text" name="fee" required  lay-verify="required" placeholder="请输入资费金额" autocomplete="off" class="layui-input">
            </div>
            <label class="layui-inline">开始日期:</label>
            <div class="layui-inline">
                <input type="text" name="begindate" required  lay-verify="required" placeholder="请输入开始日期" autocomplete="off" class="layui-input" value="1">
            </div>
            <label class="layui-inline">结束日期:</label>
            <div class="layui-inline">
                <input type="text" name="enddate" required  lay-verify="required" placeholder="请输入结束日期" autocomplete="off" class="layui-input" value="31">
            </div>
            <label class="layui-inline">计费上限:</label>
            <div class="layui-inline">
                <input type="text" name="feelimit" required  lay-verify="required" placeholder="请输入计费上限" autocomplete="off" class="layui-input" value="1000000">
            </div>
            <label class="layui-inline">激活:</label>
            <div class="layui-inline">
                <input type="checkbox" checked="" name="status" lay-skin="switch" lay-filter="switchTest" lay-text="YES|NO">
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-primary">新增</button>
            </div>
        </form>
        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>

        <!-- 代码分类列表 -->
        <table class="layui-table">
            {!! $tbstr !!}
        </table>
    </div>
    <script>
        // 删除
        function delCodeInfoConf(id) {
            //一般直接写在一个js文件中
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer
                    ,form = layui.form;
                //询问框
                layer.confirm('确定删除这个道具/代码基本信息吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    $.post("{{url('CodeInfoConf')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                        if(data.status == 1){
                            location.href = location.href;
                            layer.msg(data.message, {icon: 1});
                        } else {
                            layer.msg(data.message, {icon: 2});
                        }
                    })
                    //layer.msg('的确很重要', {icon: 1});
                }, function(){

                });
            });
        }
    </script>
@endsection