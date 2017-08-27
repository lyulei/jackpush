@extends('layouts')
@section('content')
    <div style="padding: 15px;">
        <!-- 面包屑 -->
        <span class="layui-breadcrumb">
            <a href="{{url('')}}">首页</a>
            <a><cite>代码类型</cite></a>
        </span>

        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>

        <!-- 提示信息显示区域 -->
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif

        <!-- 代码分类新增表单 -->
        <form method="post" class="layui-form" action="{{url('CodeType')}}">
            {!! csrf_field() !!}
            <label class="layui-inline">代码类型:</label>
            <div class="layui-inline">
                <select name="codetype" lay-verify="">
                    @foreach($lists as $list)
                        <option value="{{$list->codetypeid}}">{{$list->codetype}}</option>
                    @endforeach
                </select>
            </div>
            <label class="layui-inline">代码名称:</label>
            <div class="layui-inline">
                <input type="text" name="codename" required  lay-verify="required" placeholder="请输入代码名称" autocomplete="off" class="layui-input">
            </div>
            <label class="layui-inline">是否显示:</label>
            <div class="layui-inline">
                <input type="checkbox" checked="" name="display" lay-skin="switch" lay-filter="switchTest" lay-text="YES|NO">
            </div>
            <!-- <label class="layui-inline">是否显示2</label>
            <div class="layui-inline">
                <input name="display" type="radio" value="1" checked="checked" />显示 <input name="display" type="radio" value="0" />不显示
            </div> -->
            <div class="layui-inline">
                <button class="layui-btn layui-btn-primary">新增</button>
            </div>
        </form>

        <!-- 空白段落 -->
        <div style="margin: 15px 0;"></div>

        <!-- 代码分类列表 -->
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
            </colgroup>
            <thead>
                <tr>
                    <th>代码编号</th>
                    <th>代码类型</th>
                    <th>代码名称</th>
                    <th>是否显示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <th>{{$result->codeid}}</th>
                        <th lay-data="{edit:'text'}">{{$result->codetype}}</th>
                        <th lay-data="{edit:'text'}">{{$result->codename}}</th>
                        <th lay-data="{edit:'text'}">{{$result->display}}</th>
                        <th>
                            <a href="{{url('CodeType/'.$result->codeid.'/edit')}}">配置</a> |
                            <a href="{{url('CodeType/'.$result->codeid.'/edit')}}">编辑</a> |
                            <a href="javascript:;" onclick="delCodeSpecies({{$result->codeid}})">删除</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
    <script>
        // 删除
        function delCodeSpecies(id) {
            //一般直接写在一个js文件中
            layui.use(['layer', 'form'], function(){
                var layer = layui.layer
                    ,form = layui.form;
                //询问框
                layer.confirm('确定删除这个代码分类吗？', {
                    btn: ['确认','取消'] //按钮
                }, function(){
                    $.post("{{url('CodeType')}}/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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