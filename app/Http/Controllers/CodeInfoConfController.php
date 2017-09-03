<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CodeInfoConfController extends Controller
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
        $input = Input::all();
        //dd($input);
        if(empty($input['status'])){
            $input['status'] = 0;
        } else {
            $input['status'] = 1;
        }

        $rules = [
            'itemname'=>'required',
        ];

        $message = [
            'itemname.required'=>'道具名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $num = DB::select('select count(*) as num from iteminfo where gamenumber ='.$input['gamenumber']);

            foreach($num as $value)
                $input['itemnumber'] = $input['gamenumber']*1000+$value->num+1;

            //dd($input);
            $sqlstr = '';
            $sqlvalue ='';

            foreach ($input as $k => $v){
                if($k != '_token'){
                    $sqlstr .=$k.',';
                    $sqlvalue .='"'.$v.'",';
                }
            }

            $sqlstr = substr($sqlstr,0,strlen($sqlstr)-1);
            $sqlvalue = substr($sqlvalue,0,strlen($sqlvalue)-1);
            //dd($number);
            $sql = 'insert into iteminfo ('.$sqlstr.') values ('.$sqlvalue.')';
            //dd($sql);
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
        //获取codeinfo信息
        $info = DB::table('codeinfo')->where('gamenumber','=',$id)->first();
        //dd($info);
        //获取道具参数
        $tb = DB::table('parameter')
            ->where('codeid','=', $info->codeid)
            ->where('type','=',2)
            ->get();

        //dd($tb);
        $p = '';
        $inputstr = '<input type="hidden" name="gamenumber" value="'.$id.'">';

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
        //dd($title);
        $title['itemnumber'] = '道具编号';
        $title['itemname'] = '道具名称';
        $title['fee'] = '资费（分）';
        $title['begindate'] = '开始日期';
        $title['enddate'] = '结束日期';
        $title['feelimit'] = '计费上限（分）';
        $title['status'] = '激活状态';
        $url = 'http://'.$_SERVER['HTTP_HOST'];
        //dd($title);

        $results = DB::select('select itemnumber,itemname'.$p.',`fee`,`begindate`,`enddate`,`feelimit`,`status` from iteminfo where gamenumber = :id', [':id'=>$id]);
//dd($results);
        if($results){
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
                    $tr .= '<th><a href="'.$url.'/CodeInfoConf/'.$vv->itemnumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfoConf('.$vv->itemnumber.')">删除</a></th></tr>';
                } else {
                    foreach ($vv as $kkk => $vvv){
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConf/'.$vv->itemnumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfoConf('.$vv->itemnumber.')">删除</a></th></tr>';
                }
            }
            $tbstr .='<col width="150"></colgroup>'.$thead.'<th>操作</th></tr></thead><tbody>'.$tr.'</tbody>';
        } else {
            $tbstr = '';
        }

        $turename = session('user')->truename;
        $str = session('str');
        return view('codeinfoconf',['str'=>$str,'turename'=>$turename,'inputstr'=>$inputstr,'tbstr'=>$tbstr]);
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
        $title['itemnumber'] = '道具编号';
        $title['itemname'] = '道具名称';
        $title['fee'] = '资费（分）';
        $title['begindate'] = '开始日期';
        $title['enddate'] = '结束日期';
        $title['feelimit'] = '计费上限（分）';
        $title['status'] = '激活状态';
        $url = 'http://'.$_SERVER['HTTP_HOST'];

        $edit = DB::table('iteminfo')->where('itemnumber','=',$id)->get();
        //dd($edit);
        foreach($edit as $key_a => $value_a){
            foreach($value_a as $key_b => $value_b){
                if($value_b != null){
                    $newedit[$key_b] = $value_b;
                }
            }
        }
        //dd($inputstr);
        $inputstr .= '<label class="layui-inline">道具名称:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="itemname" required  lay-verify="required" placeholder="请输入道具名称" autocomplete="off" class="layui-input" value="'.$newedit['itemname'].'"></div>';
        //dd($inputstr);
        $p = '';
        $codeid = DB::select('select codeid from codeinfo where gamenumber = '.$newedit['gamenumber']);
        $codeid = DB::table('codeinfo')
            ->where('gamenumber','=',$newedit['gamenumber'])
            ->pluck('codeid');

        $tb = DB::table('parameter')
            ->where('codeid','=', $codeid)
            ->where('type','=', 2)
            ->get();

        foreach ($tb as $key => $value){
            $inputstr .= '<label class="layui-inline">' . $value->remarks . ':</label>';
            $inputstr .= '<div class="layui-inline">';
            $inputstr .= '<input type="text" name="' . $value->name . '" required  lay-verify="required" placeholder="请输入' . $value->remarks . '" autocomplete="off" class="layui-input" value="'.$newedit[$value->name].'"></div>';
            $p .= ','.$value->name;
            $title[$value->name] = $value->remarks;
        }

        $inputstr .= '<label class="layui-inline">资费（分）:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="fee" required  lay-verify="required" placeholder="请输入开始日期" autocomplete="off" class="layui-input" value="'.$newedit['fee'].'"></div>';
        $inputstr .= '<label class="layui-inline">开始日期:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="begindate" required  lay-verify="required" placeholder="请输入道具名称" autocomplete="off" class="layui-input" value="'.$newedit['begindate'].'"></div>';
        $inputstr .= '<label class="layui-inline">结束日期:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="enddate" required  lay-verify="required" placeholder="请输入道具名称" autocomplete="off" class="layui-input" value="'.$newedit['enddate'].'"></div>';
        $inputstr .= '<label class="layui-inline">计费上限:</label>';
        $inputstr .= '<div class="layui-inline">';
        $inputstr .= '<input type="text" name="feelimit" required  lay-verify="required" placeholder="请输入道具名称" autocomplete="off" class="layui-input" value="'.$newedit['feelimit'].'"></div>';

        $results = DB::select('select itemnumber,itemname'.$p.',`fee`,`begindate`,`enddate`,`feelimit`,`status` from iteminfo where itemnumber = :id', [':id'=>$id]);
        //dd($results);
        if($results){
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
                    $tr .= '<th><a href="'.$url.'/CodeInfoConf/'.$vv->itemnumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfoConf('.$vv->itemnumber.')">删除</a></th></tr>';
                } else {
                    foreach ($vv as $kkk => $vvv){
                        $tr .= '<th>'.$vvv.'</th>';
                    }
                    $tr .= '<th><a href="'.$url.'/CodeInfoConf/'.$vv->itemnumber.'/edit">编辑</a> | <a href="javascript:;" onclick="delCodeInfoConf('.$vv->itemnumber.')">删除</a></th></tr>';
                }
            }
            $tbstr .='<col width="150"></colgroup>'.$thead.'<th>操作</th></tr></thead><tbody>'.$tr.'</tbody>';
        } else {
            $tbstr = '';
        }

        $turename = session('user')->truename;
        $str = session('str');
        return view('codeinfoconfedit',['str'=>$str,'turename'=>$turename,'inputstr'=>$inputstr,'newedit'=>$newedit,'tbstr'=>$tbstr]);
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
        //dd(Input::all());
        $input_temp= Input::all();
        $input = Input::except('_token','_method','gamenumber');
        //dd($input);
        if(empty($input['status'])){
            $input['status'] = 0;
        } else {
            $input['status'] = 1;
        }

        $rules = [
            'itemname'=>'required',
        ];

        $message = [
            'itemname.required'=>'道具名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $sql = '';
            foreach($input as $key => $value){
                $sql .= $key.'="'.$value.'",';
            }
            $sql = substr($sql,0,strlen($sql)-1);

            //dd($sql);
            $affected = DB::update('UPDATE `iteminfo` SET '.$sql.' WHERE (`itemnumber`="'.$id.'")');

            if($affected){
                $validator->errors()->add('errors','编辑成功！');
                return redirect('CodeInfoConf/'.$input_temp['gamenumber'])->withErrors($validator);
            } else {
                $validator->errors()->add('errors','编辑失败请稍后再试！');
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
        $delete = DB::table('iteminfo')->where('itemnumber', '=', $id)->delete();
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
