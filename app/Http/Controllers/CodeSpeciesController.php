<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CodeSpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::select('select * from codespecies where del = 0');
        if(session('user') == null){
            return redirect('login');
        } else {
            $turename = session('user')->truename;
            $str = session('str');
            return view('codespecies',['str'=>$str,'turename'=>$turename,'result'=>$result]);
        }
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
            'codetype'=>'required',
        ];

        $message = [
            'codetype.required'=>'代码类型不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $insert = DB::insert('insert into codespecies (codetype,speciesid) values (?, ?)',
                [$input['codetype'],$input['speciesid']]);
            if($insert){
                $validator->errors()->add('errors','新增成功！');
                return back()->withErrors($validator);
            } else {
                $validator->errors()->add('errors','新增失败请稍后再试！');
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
    public function edit($codetypeid)
    {
        $edit = DB::table('codespecies')->where('codetypeid', $codetypeid)->first();

        $result = DB::select('select * from codespecies where del = 0');

        $turename = session('user')->truename;

        return view('codespeciesedit',['turename'=>$turename,'result'=>$result,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codetypeid)
    {
        $input = Input::except('_token','_method');

        $rules = [
            'codetype'=>'required',
        ];

        $message = [
            'codetype.required'=>'代码类型不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        //dd($input);
        if($validator->passes()) {
            $affected = DB::table('codespecies')
                ->where('codetypeid', $codetypeid)
                ->update(['codetype' => $input['codetype'], 'speciesid' => $input['speciesid']]);
            if ($affected) {
                $validator->errors()->add('errors', '编辑成功！');
                return redirect('CodeSpecies')->withErrors($validator);
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
        $delete = DB::table('codespecies')->where('codetypeid', '=', $id)->delete();
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
