<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(session('user'));
        if(session('user')){

            $list = array();
            $list['YD']['MUSIC']['0']['id']='100';
            $list['YD']['MUSIC']['0']['name']='one';
            $list['YD']['MUSIC']['1']['id']='101';
            $list['YD']['MUSIC']['1']['name']='two';
            $list['YD']['MUSIC']['2']['id']='102';
            $list['YD']['MUSIC']['2']['name']='three';
            $list['YD']['DDO']['0']['id']='106';
            $list['YD']['DDO']['0']['name']='ten';
            $list['YD']['DDO']['1']['id']='107';
            $list['YD']['DDO']['1']['name']='nice';

            $list['LT']['PDO']['0']['id']='103';
            $list['LT']['PDO']['0']['name']='four';
            $list['LT']['PDO']['1']['id']='104';
            $list['LT']['PDO']['1']['name']='five';
            $list['LT']['PDO']['2']['id']='105';
            $list['LT']['PDO']['2']['name']='six';
            $list['LT']['PC']['0']['id']='108';
            $list['LT']['PC']['0']['name']='good';
            $list['LT']['PC']['1']['id']='109';
            $list['LT']['PC']['1']['name']='hi';
            $list['LT']['PC']['2']['id']='110';
            $list['LT']['PC']['2']['name']='hello';
            //dd($list);

            $str = '';
            $bout= 0;
            $bout_one= 0;
            $bout_two= 0;

            foreach($list as $k=>$v){

                $bout++;
                $num = count($list);

                if($bout == $num){
                    $str .= '</ul></li><li class="expandable lastExpandable"><div class="hitarea expandable-hitarea lastExpandable-hitarea"></div><a href="#">'.$k.'</a><ul style="display: none;">';
                } else {
                    $str .= '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="#">'.$k.'</a><ul style="display: none;">';
                }

                foreach($v as $kk=>$vv){
                    $bout_one++;
                    $num_one = count($v);

                    if($bout_one == $num_one){
                        $bout_one = 0;
                        $str .= '<li class="expandable lastExpandable"><div class="hitarea expandable-hitarea lastExpandable-hitarea"></div><a href="#">'.$kk.'</a><ul style="display: none;">';
                    } else {
                        $str .= '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="#">'.$kk.'</a><ul style="display: none;">';
                    }

                    foreach($vv as $kkk=>$vvv){
                        $bout_two++;
                        $num_two = count($vv);

                        if($bout_two == $num_two){
                            $bout_two = 0;
                            $str .= '<li  class="last"><a href="code/'.$vvv['id'].'">'.$vvv['id'].'-'.$vvv['name'].'</a></li></ul></li>';
                        } else {
                            $str .= '<li><a href="code/'.$vvv['id'].'">'.$vvv['id'].'-'.$vvv['name'].'</a></li>';
                        }
                    }
                }

            }
            $str .='</ul></li>';

            $turename = session('user')->truename;
            session(['str' => $str]);

            return view('index',['str'=>$str,'turename'=>$turename]);
        } else {
            return redirect('/login')->with('msg', '请登录！');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Login()
    {
        if($input = Input::all()) {
            $users = DB::select('select * from users where phonenumber = ?', [$input['phonenumber']]);

            if ($users) {
                foreach ($users as $user)

                if ($user->phonenumber != $input['phonenumber'] or Crypt::decrypt($user->password) != $input['password']) {
                    return back()->with('msg', '用户名或密码错误！');
                }
                session(['user' => $user]);

                return redirect('/');
            } else {
                return back()->with('msg', '用户名不存在！');
            }
        } else {
            return view('login');
        }
    }

    public function logout(){
        session(['user'=>null]);

        return redirect('/');
    }


    public function code(Request $request){
        //echo date('Y-m-d H:i:s',time());
        dd($request->type);

        $turename = session('user')->truename;
        $str = session('str');

        return view('code',['str'=>$str,'turename'=>$turename]);
    }

    public function password(){
        if($input = Input::all()){
            $rules = [
                'password_old'=>'required|between:6,20',
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                'password_old.required'=>'原密码不能为空！',
                'password_old.between'=>'原密码必须在6-20位之间！',
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                $user = DB::table('users')->where('uid', session('user')->uid)->first();
                $password_old = Crypt::decrypt($user->password);

                if($input['password_old'] == $password_old){
                    $password = Crypt::encrypt($input['password']);

                    $update = DB::table('users')
                        ->where('uid', session('user')->uid)
                        ->update(['password' => $password]);

                    if($update){
                        //return redirect('/');
                        $validator->errors()->add('errors','密码修改成功！');
                        return back()->withErrors($validator);
                    } else {
                        $validator->errors()->add('errors','更新失败请稍后再试！');
                        return back()->withErrors($validator);
                    }
                } else {
                    $validator->errors()->add('errors','原密码错误！');
                    return back()->withErrors($validator);
                }
            } else {
                return back()->withErrors($validator);
            }
        } else {
            $turename = session('user')->truename;
            $str = session('str');

            return view('password',['str'=>$str,'turename'=>$turename]);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test(){




        return view('test');
    }
}
