<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic Layout - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('easyui/themes/default/easyui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('easyui/themes/icon.css') }}">

    <script type="text/javascript" src="{{ URL::asset('easyui/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('easyui/jquery.easyui.min.js') }}"></script>
</head>
<body class="easyui-layout">
<div data-options="region:'north',border:false" style="height:60px;background:#B3DFDA;padding:10px">
    jackpush demo
</div>
<div data-options="region:'west',split:true,title:'West'" style="width:300px;padding:10px;">
    <div class="easyui-panel" style="padding:5px">
        <ul class="easyui-tree">
            <li>
                <span>代码管理</span>
                <ul>
                    <li data-options="state:'closed'">
                        <span>Photos</span>
                        <ul>
                            <li data-options="state:'closed'">
                                <span>Friend</span>
                                <ul>
                                    <li><span>hi</span></li>
                                    <li><span>hello</span></li>
                                </ul>
                            </li>
                            <li>
                                <span>Wife</span>
                            </li>
                            <li>
                                <span>Company</span>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <span>Program Files</span>
                        <ul>
                            <li>Intel</li>
                            <li>Java</li>
                            <li>Microsoft Office</li>
                            <li>Games</li>
                        </ul>
                    </li>
                    <li>代码分类</li>
                    <li>代码类型</li>
                </ul>
            </li>
            <li>
                <span>My Documents</span>
            </li>
        </ul>
    </div>
</div>
<div data-options="region:'south',border:false" style="height:50px;background:#A9FACD;padding:10px;">
    © jackpush.com
</div>
<div data-options="region:'center',title:'Center'">
    <!-- 可编辑的表格 -->
    <div style="margin-bottom:20px">
        <a href="#" onclick="getSelected()">GetSelected</a>
        <a href="#" onclick="getSelections()">GetSelections</a>
    </div>
    <table id="tt" class="easyui-datagrid" title="Load Data" iconCls="icon-save" style="width:600px;height:auto;" singleSelect="true">
        <thead>
        <tr>
            <th field="itemid" width="200">分类编号</th>
            <th field="productid" width="200">代码类型</th>
            <th field="listprice" width="200">父级分类</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>音乐</td>
            <td>移动</td>
        </tr>
        </tbody>
    </table>
    <script>
        function getSelected(){
            var row = $('#tt').datagrid('getSelected');
            if (row){
                alert('Item ID:'+row.itemid+"\nPrice:"+row.listprice);
            }
        }
        function getSelections(){
            var ids = [];
            var rows = $('#tt').datagrid('getSelections');
            for(var i=0; i<rows.length; i++){
                ids.push(rows[i].itemid);
            }
            alert(ids.join('\n'));
        }
    </script>

    <!-- -->
</div>
</body>
</html>