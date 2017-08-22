<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('user')->phonenumber){

            $data = array('yidong'=>
                        array('music'=>
                            array(
                                array('id'=>'100','name'=>'one'),
                                array('id'=>'101','name'=>'two'),
                                array('id'=>'102','name'=>'three'),
                                array('id'=>'103','name'=>'four'),
                                array('id'=>'104','name'=>'five')
                            )
                        )
            );

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
echo $bout;
                if($bout == $num){
                    $str .= '<li class="last"><div class="hitarea expandable-hitarea"></div><a href="#">'.$k.'</a><ul style="display: none;">';
                } else {
                    $str .= '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="#">'.$k.'</a><ul style="display: none;">';
                }

                foreach($v as $kk=>$vv){
                    $bout_one++;
                    $num_one = count($v);

                    if($bout_one == $num_one){
                        $bout_one = 0;
                        $str .= '<li class="last"><div class="hitarea expandable-hitarea"></div><a href="#">'.$kk.'</a><ul style="display: none;">';
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

            //dd($str);

            //dd($list);
            /*
            $v=end($data['yidong']);
            $k=key($data['yidong']);
            $i=0;
            $str="";

                       for($i;$i<count($v);$i++){
                            if($i == count($v)-1){
                                $str .='<li class="last"><a href="">'.$v[$i]["id"].'-'.$v[$i]["name"].'</a></li>';
                            } else {
                                $str .='<li><a href="">'.$v[$i]["id"].'-'.$v[$i]["name"].'</a></li>';
                            }
                        }
*/

            /*
                                  $str = '<ul style=\"display: none;\"><li class=\"expandable\"><div class=\"hitarea expandable-hitarea\"></div>';
                                   $i = 0;
                                   foreach($data as $key => $value ){
                                       $str .= '<a href="">'.$key.'</a><ul style="display: none;"><li class="expandable"><div class="hita expandable-hitarea"></div>';
                                           foreach($value as $k=>$v){
                       //echo count($v)."\n";

                                               $str .='<a href="">'.$k.'</a><ul style="display: none;">';
                                               for($i;$i<count($v);$i++){
                                                   if($i == count($v)-1){
                                                       $str .='<li class="last"><a href="">'.$v[$i]["id"].'-'.$v[$i]["name"].'</a></li></ul></li>';
                                                   } else {
                                                       $str .='<li><a href="">'.$v[$i]["id"].'-'.$v[$i]["name"].'</a></li>';
                                                   }
                                               }
                                           }

                                   }
            */
            //dd($str);
            //echo $str;
            return view('testtest')->with('str',$str);
            //return view('index');
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
            $user = User::first();
            if($user->phonenumber != $input['phonenumber'] or Crypt::decrypt($user->password) != $input['password']){
                //echo 'ok';
                return back()->with('msg','用户名或密码错误！');
            }
            session(['user'=>$user]);
            echo "ok";
        } else {
            return view('login');
        }
    }

    public function php(){
        dd(phpinfo());
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
