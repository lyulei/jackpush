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
        <div class="layui-logo">JACKPUSH</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item"><a href="">管理员：admin</a></li>
            <li class="layui-nav-item"><a href="">修改密码</a></li>
            <li class="layui-nav-item"><a href="">退出</a></li>
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
        <div style="padding: 15px;">
            <!-- 面包屑 -->
            <span class="layui-breadcrumb">
                <a href="">首页</a>
                <a href="">国际新闻</a>
                <a href="">亚太地区</a>
                <a><cite>正文</cite></a>
            </span>

            <!-- 空白段落 -->
            <div style="margin: 15px 0;"></div>

            <!-- 代码分类新增表单 -->
            <form class="layui-form" action="">
                    <label class="layui-inline">代码类型:</label>
                    <div class="layui-inline">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入代码类型" autocomplete="off" class="layui-input">
                    </div>
                <label class="layui-inline">父级分类:</label>
                <div class="layui-inline">
                    <select name="city" lay-verify="">
                        <option value="">请选择</option>
                        <option value="010">北京</option>
                        <option value="021">上海</option>
                        <option value="0571">杭州</option>
                    </select>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn">新增代码分类</button>
                </div>
            </form>

            <!-- 空白段落 -->
            <div style="margin: 15px 0;"></div>

            <table id="js_stu_tb" border="1">
                <thead>
                <tr>
                    <th class="stu_no">学号</th>
                    <th class="stu_name">姓名</th>
                    <th class="stu_age">年龄</th>
                    <th class="op">操作</th>
                </tr>
                </thead>
                <tbody id="js_hide_tby">
                <tr style="display:none;">
                    <td class="stu_no"><input type="text"/></td>
                    <td class="stu_name"><input type="text"/></td>
                    <td class="stu_age"><input type="text"/></td>
                    <td class="op" align="center">
                        <input class="js_stusave_btn" type="button" value="保存"/>
                        <input class="js_stuedit_btn" type="button" value="修改" style="display:none;"/>
                        <input class="js_studel_btn" type="button" value="删除"/>
                    </td>
                </tr>
                <tbody/>
                <tbody id="js_stuinfo_tby">
                <tr>
                    <td class="stu_no"> 001</td>
                    <td class="stu_name">张三</td>
                    <td class="stu_age">18</td>
                    <td class="op" align="center">
                        <input class="js_stusave_btn" type="button" value="保存" style="display:none;"/>
                        <input class="js_stuedit_btn" type="button" value="修改"/>
                        <input class="js_studel_btn" type="button" value="删除"/>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>



    <div class="layui-footer">
        <!-- 底部固定区域 -->
        © jackpush.com
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('layui/layui.all.js') }}"></script>

<script>
    // 测试表单增删改功能
    $(document).ready(function(){

        var tb = $("#js_stu_tb");

        //添加学生
        $("#js_addstu_btn").click(function(){
            var hideTr = $("#js_hide_tby",tb).children().first();
            var newTr = hideTr.clone().show();
            $("#js_stuinfo_tby",tb).append(newTr);
        });
/**/
        //保存学生信息
        $(".js_stusave_btn",tb).die('click').live('click',function(){
            var tr = $(this).parent().parent();
            $("input[type='text']",tr).each(function(i,el){
                el = $(el);
                el.parent().text(el.val());
                el.remove();
            });
            $(".js_stusave_btn",tr).hide();
            $(".js_stuedit_btn",tr).show();
        });

        //修改学生信息
        $(".js_stuedit_btn",tb).die('click').live('click',function(){
            var tr = $(this).parent().parent();
            $("td:not('.op')",tr).each(function(i,el){
                el = $(el);
                var html = "<input value='"+el.text()+"' type='text'>";
                el.html(html);
            });
            $(".js_stuedit_btn",tr).hide();
            $(".js_stusave_btn",tr).show();
        });

        //删除学生信息
        $(".js_studel_btn",tb).die('click').live('click',function(){
            $(this).parent().parent().remove();
        });

        //根据关键字查询学生信息
        $("#js_searchstu_btn").click(function(){
            var keyword = $("#js_keyword_text").val();
            var tby = $("#js_stuinfo_tby",tb);
            if(!!!keyword){
                tby.children().show();
            }else{
                tby.children().hide();
                $("td:contains('"+keyword+"')",tby).each(function(i,el){
                    $(el).parent().show();
                });
            }


        });

    });
</script>


<script>
    /*
    var table = layui.table;

    //执行渲染
    table.render({
        elem: '#demo' //指定原始表格元素选择器（推荐id选择器）
        ,height: 315 //容器高度
        ,cols:  [[ //标题栏
            {checkbox: true}
            ,{field: 'id', title: '代码编号', width: 80}
            ,{field: 'codetype', title: '代码类型', width: 120}
            ,{field: 'codename', title: '代码名称', width: 120}
            ,{field: 'display', title: '是否显示', width: 120}
        ]] //设置表头
        ,data:[
            {"id":103,"codetype":1,"codename":"xxx公司","display":1}
            ,{"id":104,"codetype":2,"codename":"aaa公司","display":1}
            ,{"id":105,"codetype":1,"codename":"bbb公司","display":1}
            ]
        //,…… //更多参数参考右侧目录：基本参数选项

    });
    //console.log(checkStatus.data) //获取选中行的数据
    function getTr() {
        alert(1);
    }
    */
</script>
<script>



    //由于模块都一次性加载，因此不用执行 layui.use() 来加载对应模块，直接使用即可：
    ;!function(){
        var layer = layui.layer
            ,form = layui.form;

        //form.render(); //更新全部
    }();

    //Demo
    layui.use(['tree', 'layer'], function(){
        var layer = layui.layer
            ,$ = layui.jquery;

        layui.tree({
            elem: '#demo1' //指定元素
            ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
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
                    }, {
                        name: '代码类型'
                        ,id: 12
                    }, {
                        name: '测试（设置跳转）'
                        ,id: 13
                        ,href: 'http://www.layui.com/'
                        ,alias: 'weidu'
                    }
                ]
                }, {
                    name: '我的邮箱'
                    ,id: 2
                    ,spread: true
                    ,children: [
                        {
                            name: 'QQ邮箱'
                            ,id: 21
                            ,spread: true
                            ,children: [
                            {
                                name: '收件箱'
                                ,id: 211
                                ,children: [
                                {
                                    name: '所有未读'
                                    ,id: 2111
                                }, {
                                    name: '置顶邮件'
                                    ,id: 2112
                                }, {
                                    name: '标签邮件'
                                    ,id: 2113
                                }
                            ]
                            }, {
                                name: '已发出的邮件'
                                ,id: 212
                            }, {
                                name: '垃圾邮件'
                                ,id: 213
                            }
                        ]
                        }, {
                            name: '阿里云邮'
                            ,id: 22
                            ,children: [
                                {
                                    name: '收件箱'
                                    ,id: 221
                                }, {
                                    name: '已发出的邮件'
                                    ,id: 222
                                }, {
                                    name: '垃圾邮件'
                                    ,id: 223
                                }
                            ]
                        }
                    ]
                }
                ,{
                    name: '收藏夹'
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