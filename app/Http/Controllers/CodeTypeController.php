<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CodeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = DB::select('select * from codespecies where del=0');

        $results = DB::table('codetype')
            ->join('codespecies', 'codetype.codetypeid', '=', 'codespecies.codetypeid')
            ->where('codespecies.del', '=', 0)
            ->get();

        $turename = session('user')->truename;
        $str = session('str');

        return view('codetype',['str'=>$str,'turename'=>$turename,'results'=>$results,'lists'=>$lists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
        if(empty($input['display'])){
            $input['display'] = 0;
        } else {
            $input['display'] = 1;
        }
        //dd($input);
        $rules = [
            'codename'=>'required',
        ];

        $message = [
            'codename.required'=>'代码名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);
        //dd($input);
        if($validator->passes()){
            $insert = DB::insert('insert into codetype (codetypeid,codename, display) values (?, ?, ?)',
                [$input['codetype'],$input['codename'],$input['display']]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = DB::table('codetype')->where('codeid', $id)->first();

        $lists = DB::select('select * from codespecies where del=0');
        $list = '';
        foreach($lists as $k=>$v){
            $list .= '<option value="'.$v->codetypeid.'"';
            if($v->codetypeid == $edit->codetypeid){
                $list .='selected="selected" >'.$v->codetype.'</option>';
            } else {
                $list .= '>'.$v->codetype.'</option>';
            }
        }

        $results = DB::table('codetype')
            ->join('codespecies', 'codetype.codetypeid', '=', 'codespecies.codetypeid')
            ->where('codespecies.del', '=', 0)
            ->get();

        $turename = session('user')->truename;

        return view('codetypeedit',['turename'=>$turename,'results'=>$results,'edit'=>$edit,'list'=>$list]);
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
        $input = Input::all();
        //
        if(empty($input['display'])){
            $input['display'] = 0;
        } else {
            $input['display'] = 1;
        }

        $rules = [
            'codename'=>'required',
        ];

        $message = [
            'codename.required'=>'代码名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()) {
            $affected = DB::table('codetype')
                ->where('codeid', $id)
                ->update(['codetypeid' => $input['codetypeid'], 'codename' => $input['codename'], 'display' => $input['display']]);
            if ($affected) {
                $validator->errors()->add('errors', '编辑成功！');
                return redirect('CodeType')->withErrors($validator);
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
        $delete = DB::table('codetype')->where('codeid', '=', $id)->delete();
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
