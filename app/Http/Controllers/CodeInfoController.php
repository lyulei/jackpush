<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CodeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = Input::all();

        if(empty($input['status'])){
            $input['status'] = 0;
        } else {
            $input['status'] = 1;
        }
            $sqlstr = '';
            $sqlvalue ='';
            $sqlparam ='';
        foreach ($input as $k => $v){
            if($k != '_token'){
                $sqlstr .=$k.',';
                $sqlvalue .='"'.$v.'",';
                $sqlparam .='?,';
            }
        }
        $sqlstr = substr($sqlstr,0,strlen($sqlstr)-1);
        $sqlvalue = substr($sqlvalue,0,strlen($sqlvalue)-1);
        $sqlparam = substr($sqlparam,0,strlen($sqlparam)-1);
        $sql = 'insert into codeinfo ('.$sqlstr.') values ('.$sqlvalue.')';
        //dd($sql);
        $rules = [
            'gamename'=>'required',
        ];

        $message = [
            'gamename.required'=>'游戏名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $insert = DB::insert($sql);

            if($insert){
                $validator->errors()->add('errors','保存成功！');
                return back()->withErrors($validator);
            } else {
                $validator->errors()->add('errors','保存失败请稍后再试！');
                return back()->withErrors($validator);
            }
        } else {
            return back()->withErrors($validator);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inputstr = '<input type="hidden" name="codeid" value="'.$id.'">';
        $p = '';
        $tb = DB::table('parameter')
            ->where('codeid','=', $id)
            ->where('type','=', 1)
            ->get();
        //dd($tb);
        if($tb){
            foreach ($tb as $key => $value){
                //echo $key.'---';
                $inputstr .= '<label class="layui-inline">' . $value->remarks . ':</label>';
                $inputstr .= '<div class="layui-inline">';
                $inputstr .= '<input type="text" name="' . $value->name . '" required  lay-verify="required" placeholder="请输入' . $value->remarks . '" autocomplete="off" class="layui-input" ></div>';
                $p .= ','.$value->name;
                $title[$value->name] = $value->remarks;
            }
        }

        $title['gamenumber'] = '游戏编号';
        $title['gamename'] = '游戏名称';
        $title['status'] = '激活状态';
        $url = 'http://'.$_SERVER['HTTP_HOST'];

        $results = DB::select('select gamenumber,gamename'.$p.',`status` from codeinfo where codeid = :id', [':id'=>$id]);

        if($results) {
            $num = count($results);
            $i = 1;
            $tbstr = '<colgroup>';
            $thead = '<thead><tr>';
            $tr = '<tr>';
            foreach ($results as $kk =>$vv){
                $tbstr .= '<col width="150">';
                if($i++ == 1){
                    foreach ($vv as $kkk => $vvv){
                        $thead .= '<th>'.$title[$kkk].'</th>';
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConfig/'.$vv->gamenumber.'">配置</a> | <a href="'.$url.'/CodeInfo/'.$vv->gamenumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfo('.$vv->gamenumber.')">删除</a></th></tr>';
                } else {
                    foreach ($vv as $kkk => $vvv){
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConfig/'.$vv->gamenumber.'">配置</a> | <a href="'.$url.'/CodeInfo/'.$vv->gamenumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfo('.$vv->gamenumber.')">删除</a></th></tr>';
                }
            }
            $tbstr .='<col width="150"></colgroup>'.$thead.'<th>操作</th></tr></thead><tbody>'.$tr.'</tbody>';
       } else {
            $tbstr = '';
        }

        $turename = session('user')->truename;
        $str = session('str');
        return view('codeinfo',['str'=>$str,'turename'=>$turename,'inputstr'=>$inputstr,'tbstr'=>$tbstr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inputstr = '';
        $edit = DB::table('codeinfo')->where('gamenumber','=',$id)->get();

        foreach($edit as $key_a => $value_a){
            foreach($value_a as $key_b => $value_b){
                if($value_b != null){
                    $newedit[$key_b] = $value_b;
                }
            }
        }
        //dd($newedit);
        $inputstr .= '<label class="layui-inline">游戏名称:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="gamename" required  lay-verify="required" placeholder="请输入游戏名称" autocomplete="off" class="layui-input" value="'.$newedit['gamename'].'"></div>';

        $p = '';

        $tb = DB::table('parameter')
            ->where('codeid','=', $newedit['codeid'])
            ->where('type','=', 1)
            ->get();

        foreach ($tb as $key => $value){
            $inputstr .= '<label class="layui-inline">' . $value->remarks . ':</label>';
            $inputstr .= '<div class="layui-inline">';
            $inputstr .= '<input type="text" name="' . $value->name . '" required  lay-verify="required" placeholder="请输入' . $value->remarks . '" autocomplete="off" class="layui-input" value="'.$newedit[$value->name].'"></div>';
            $p .= ','.$value->name;
            $title[$value->name] = $value->remarks;
        }
        $title['gamenumber'] = '游戏编号';
        $title['gamename'] = '游戏名称';
        $title['status'] = '激活状态';
        $url = 'http://'.$_SERVER['HTTP_HOST'];

        $results = DB::select('select gamenumber,gamename'.$p.',`status` from codeinfo where codeid = :id', [':id'=>$newedit['codeid']]);

        if($results) {
            $num = count($results);
            $i = 1;
            $tbstr = '<colgroup>';
            $thead = '<thead><tr>';
            $tr = '<tr>';
            foreach ($results as $kk =>$vv){
                $tbstr .= '<col width="150">';
                if($i++ == 1){
                    foreach ($vv as $kkk => $vvv){
                        $thead .= '<th>'.$title[$kkk].'</th>';
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConfig/'.$vv->gamenumber.'">配置</a> | <a href="'.$url.'/CodeInfo/'.$vv->gamenumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfo('.$vv->gamenumber.')">删除</a></th></tr>';
                } else {
                    foreach ($vv as $kkk => $vvv){
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConfig/'.$vv->gamenumber.'">配置</a> | <a href="'.$url.'/CodeInfo/'.$vv->gamenumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfo('.$vv->gamenumber.')">删除</a></th></tr>';
                }
            }
            $tbstr .='<col width="150"></colgroup>'.$thead.'<th>操作</th></tr></thead><tbody>'.$tr.'</tbody>';
        } else {
            $tbstr = '';
        }

        $turename = session('user')->truename;
        $str = session('str');
        return view('codeinfoedit',['str'=>$str,'turename'=>$turename,'inputstr'=>$inputstr,'tbstr'=>$tbstr,'codeid'=>$newedit['codeid'],'gamenumber'=>$newedit['gamenumber']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Input::except('_token','_method');

        if(empty($input['status'])){
            $input['status'] = 0;
        } else {
            $input['status'] = 1;
        }
        $sql = '';
        foreach($input as $key => $value){
            $sql .= $key.'="'.$value.'",';
        }
        $sql = substr($sql,0,strlen($sql)-1);
        
        $rules = [
            'gamename'=>'required',
        ];

        $message = [
            'gamename.required'=>'游戏名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()) {
            $affected = DB::update('UPDATE `codeinfo` SET '.$sql.' WHERE (`gamenumber`="'.$id.'")');
            /*
            $affected = DB::table('codeinfo')
                ->where('codeid', $id)
                ->update(['codetypeid' => $input['codetypeid'], 'codename' => $input['codename'], 'display' => $input['display']]);
            */
            if ($affected) {
                $validator->errors()->add('errors', '编辑成功！');
                return redirect('CodeInfo/'.$input['codeid'])->withErrors($validator);
            } else {
                $validator->errors()->add('errors', '编辑失败请稍后再试！');
                return back()->withErrors($validator);
            }
        } else {
            return back()->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('codeinfo')->where('gamenumber', '=', $id)->delete();
        if($delete){
            $data = [
                'status' => 1,
                'message' => '删除成功！',
            ];
        } else {
            $data = [
                'status' => 0,
                'message' => '删除失败！',
            ];
        }
        return $data;
    }
}
