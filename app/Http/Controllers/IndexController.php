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
        $species[1] = '移动';
        $species[2] = '联通';
        $species[3] = '电信';
        $species[4] = '短信类型';

        if(session('user')){
            $results = DB::table('codetype')
                ->join('codespecies', 'codetype.codetypeid', '=', 'codespecies.codetypeid')
                ->where('codespecies.del', '=', 0)
                ->get();

            foreach($results as $k => $v){
                $result[$species[$v->speciesid]][$v->codetype][] = array('id'=>$v->codeid,'name'=>$v->codename);
            }
            //dd($result);
            //dd(Request::getRequestUri());
            $url = 'http://'.$_SERVER['HTTP_HOST'];
            $str = '';
            $num = 1;
            foreach($result as $kk => $vv){
                $num1 =1;
                $key = '2'.$num++;
                //dd($vv);
                if($str){
                    $str = substr($str,0,strlen($str)-3).'}]}, {';
                }
                $str .= 'name: "'.$kk.'",id: '.$key.',spread: true,children: [{';

                foreach ($vv as $kkk => $vvv){
                    $num2 =1;
                    $ii = $num1++;
                    $key1 = $key.$ii;
                    $o = count($vvv);

                    $str .='name: "'.$kkk.'",id: '.$key1.',children: [{';
                    foreach($vvv as $kkkk => $vvvv){
                        $i = $num2++;
                        $key2 = $key1.$i;
                        //echo $i ."=". $o;
                        if($i == $o){
                            $str .='name: "'.$vvvv['id'].'-'.$vvvv['name'].'",id: '.$key2.',href:"'.$url.'/CodeInfo/'.$vvvv['id'].'"}]},{';
                        } else {
                            $str .='name: "'.$vvvv['id'].'-'.$vvvv['name'].'",id: '.$key2.',href:"'.$url.'/CodeInfo/'.$vvvv['id'].'"},{';
                        }
                    }
                }
            }
            $str = substr($str,0,strlen($str)-2).']}]';

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

        //dd(Crypt::encrypt('123456'));

        return view('test');
    }
}
