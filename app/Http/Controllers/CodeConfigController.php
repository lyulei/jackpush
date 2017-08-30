<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CodeConfigController extends Controller
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

        $rules = [
            'name'=>'required',
            'remarks'=>'required',
        ];

        $message = [
            'name.required'=>'字段名不能为空！',
            'remarks.required'=>'参数备注不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $insert = DB::insert('insert into parameter (codeid, type, name, remarks) values (?, ?, ?, ?)',
                [$input['codeid'],$input['type'],$input['name'],$input['remarks']]);
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
        $results = DB::table('codetype')
            ->join('codespecies', 'codetype.codetypeid', '=', 'codespecies.codetypeid')
            ->where('codespecies.del', '=', 0)
            ->where('codetype.codeid', '=', $id)
            ->get();

        $data = DB::table('parameter')
            ->where('codeid','=', $id)
            ->get();
        //dd($data);

        $turename = session('user')->truename;
        return view('codeconfig',['turename'=>$turename,'results'=>$results,'data'=>$data,'codeid'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $edit = DB::table('parameter')->where('id', $id)->first();

        $data = DB::table('parameter')
            ->where('codeid','=', $edit->codeid)
            ->get();

        $turename = session('user')->truename;
        return view('codeconfigedit',['turename'=>$turename,'edit'=>$edit,'data'=>$data]);
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

        $rules = [
            'name'=>'required',
            'remarks'=>'required',
        ];

        $message = [
            'name.required'=>'字段名不能为空！',
            'remarks.required'=>'参数备注不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()) {
            $affected = DB::table('parameter')
                ->where('id', $id)
                ->update(['type' => $input['type'], 'name' => $input['name'], 'remarks' => $input['remarks']]);
            if ($affected) {
                $validator->errors()->add('errors', '编辑成功！');
                return redirect('CodeConfig/'.$input['codeid'])->withErrors($validator);
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
        $delete = DB::table('parameter')->where('id', '=', $id)->delete();
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
