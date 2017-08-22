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
                            $str .= '<li  class="last"><a href="#">'.$vvv['id'].'-'.$vvv['name'].'</a></li></ul></li>';
                        } else {
                            $str .= '<li><a href="#">'.$vvv['id'].'-'.$vvv['name'].'</a></li>';
                        }
                    }
                }

            }
            $str .='</ul></li>';
            //dd($str);
            //$user['truename'] = session('user')->truename;
            //$user['uid'] = session('user')->uid;
            //$user->toArray();
            //print_r($user);
            $turename = session('user')->truename;
            //echo $turename;
            //return view('index')->with('str',$str);
            return view('index',['str'=>$str,'turename'=>$turename]);
            //return view('index',compact(str,turename));
        } else {
            return redirect('/login')->with('msg', '请登录');
        }
        //dd(Request);

        //$users =  DB::select('select * from users where uid = ?', [1]);
        //dd($users);
        //return view('user.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Login()
    {
        if($input = Input::all()){
            $users = DB::select('select * from users where phonenumber = ?', [$input['phonenumber']]);

            foreach($users as $user)
                //dd($user->truename);

            //$user = User::first();
            if($user->phonenumber != $input['phonenumber'] or Crypt::decrypt($user->password) != $input['password']){
                //echo 'ok';
                return back()->with('msg','用户名或密码错误！');
            }
            session(['user'=>$user]);
            //echo "ok";
            //return view('index');
            return redirect('/');
        } else {
            return view('login');
        }
    }

    public function logout(){
        session(['user'=>null]);

        return redirect('/');
    }


    public function info(){
        //echo date('Y-m-d H:i:s',time());
        return view('info');
    }

    public function password(){
        if($input = Input::all()){
            $rules = [
                'password_old'=>'required|between:6,20',
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                'password_old.required'=>'原密码不能为空',
                'password_old.between'=>'原密码必须在6-20位之间',
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                echo 'yes';
            } else {
                //dd($validator->errors()->all());
                return back()->withErrors($validator);
            }

        } else {
            return view('password');
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
}
