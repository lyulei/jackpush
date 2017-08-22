<link rel="stylesheet" href="{{ URL::asset('css/jquery.treeview.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/screen.css') }}" />

<script src="{{ URL::asset('jquery/jquery.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('jquery/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('jquery/jquery.treeview.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $("#tree").treeview({
            collapsed: true,
            animated: "fast",
            control:"#sidetreecontrol",
            prerendered: true,
            persist: "location"
        });
    })
</script>

<style>
    a:link{text-decoration:none ; color:black ;}
    a:visited {text-decoration:none ; color:black;}
    a:hover {text-decoration:underline ; color:black;}
    a:active {text-decoration:none ; color:black;}
</style>

<body>
<h1 id="banner">Jackpush Demo</h1>

<div id="main"> <a href=".">Main Demo</a>
    <div id="sidetree">
        <div class="treeheader">&nbsp;</div>
        <div id="sidetreecontrol"> <a href="?#">全部折叠</a> | <a href="?#">全部展开</a> </div>
        <ul class="treeview" id="tree">
<!-- foreach start -->
{!! $str !!}
<!-- foreach sotp -->
        </ul>
    </div>
</div>
</body>