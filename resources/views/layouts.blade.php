<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>文档的标题</title>
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}" />

    <script type="text/javascript" src="{{ URL::asset('jquery/jquery.js') }}"></script>
</head>

<body>

<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">JACKPUSH BATE</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><a href="">管理员：{{$turename}}</a></li>
            <li class="layui-nav-item"><a href="{{url('/password')}}">修改密码</a></li>
            <li class="layui-nav-item"><a href="{{url('/logout')}}">退出</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-gray">
        <div class="layui-side-scroll">
            <!-- 空白段落 -->
            <div style="margin: 15px 0;"></div>

            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul id="demo1"></ul>
        </div>
    </div>
    <div class="layui-body">
        <!-- 内容主体区域 -->

        <!-- 引用模板 -->
        @yield('content')
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © jackpush.com
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('layui/layui.all.js') }}"></script>
<script>
    //由于模块都一次性加载，因此不用执行 layui.use() 来加载对应模块，直接使用即可：
    ;!function(){
        var layer = layui.layer
            ,form = layui.form;
    }();

    //Demo
    layui.use(['tree', 'layer'], function(){
        var layer = layui.layer
            ,$ = layui.jquery;

        layui.tree({
            elem: '#demo1' //指定元素
            ,target: '_self' //是否新选项卡打开（比如节点返回href才有效）
            ,click: function(item){ //点击节点回调
                layer.msg('当前节名称：'+ item.name + '<br>全部参数：'+ JSON.stringify(item));
                console.log(item);
            }
            ,nodes: [ //节点
                {
                    name: '代码管理'
                    ,id: 1
                    ,alias: ''
                    ,children: [
                    {
                        name: '代码分类'
                        ,id: 11
                        ,href:'{{url('CodeSpecies')}}'
                    }, {
                        name: '代码类型'
                        ,id: 12
                        ,href:'{{url('CodeType')}}'
                    }, {
                        name: '测试（设置跳转）'
                        ,id: 13
                        ,href: 'http://www.layui.com/'
                        ,alias: 'weidu'
                    }
                ]
                }, {

                    name: '数据管理',id: 2,spread: true,children: [{

                    // -----------
                        {!! $str !!}
                    // -----------
                }
                ,{
                    name: '统计管理'
                    ,id: 3
                    ,alias: 'changyong'
                    ,children: [
                        {
                            name: '爱情动作片'
                            ,id: 31
                            ,alias: 'love'
                        }, {
                            name: '技术栈'
                            ,id: 12
                            ,children: [
                                {
                                    name: '前端'
                                    ,id: 121
                                }
                                ,{
                                    name: '全端'
                                    ,id: 122
                                }
                            ]
                        }
                    ]
                }
            ]
        });


        //生成一个模拟树
        var createTree = function(node, start){
            node = node || function(){
                var arr = [];
                for(var i = 1; i < 10; i++){
                    arr.push({
                        name: i.toString().replace(/(\d)/, '$1$1$1$1$1$1$1$1$1')
                    });
                }
                return arr;
            }();
            start = start || 1;
            layui.each(node, function(index, item){
                if(start < 10 && index < 9){
                    var child = [
                        {
                            name: (1 + index + start).toString().replace(/(\d)/, '$1$1$1$1$1$1$1$1$1')
                        }
                    ];
                    node[index].children = child;
                    createTree(child, index + start + 1);
                }
            });
            return node;
        };

        layui.tree({
            elem: '#demo2' //指定元素
            ,nodes: createTree()
        });

    });
</script>
</body>
</html>