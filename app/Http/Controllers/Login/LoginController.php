<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/1/3
 * Time: 下午 03:55
 */

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserModel;

class LoginController extends Controller
{
    /*
        *用户登录
         * 2019年1月3日15:51:46
         * zhangqi
        */
    public function login_reg()
    {
        return view('users.login');
    }

    public function doLogin(Request $request)
    {
        echo '<pre>';print_r($_POST);echo '</pre>';

        $emial = $request->input('email');
        $pass = $request->input('pass');

        $u = UserModel::where(['email'=>$emial])->first();

        if($u){
            if( password_verify($pass,$u->pass) ){

                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                setcookie('uid',$u->uid,time()+86400,'/','shop.com',false,true);
                setcookie('token',$token,time()+86400,'/user','',false,true);

                $request->session()->put('u_token',$token);
                $request->session()->put('uid',$u->uid);

                header("Refresh:3;url=/user/center");
                echo "登录成功";
            }else{
                die("密码不正确");
            }
        }else{
            die("用户不存在");
        }

    }
}