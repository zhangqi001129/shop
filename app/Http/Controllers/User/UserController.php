<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\UserModel;

class UserController extends Controller
{
    //

    public function user($uid)
    {
        echo $uid;
    }

    public function test()
    {
        echo '<pre>';
        print_r($_GET);
        echo '</pre>';
    }

    public function add()
    {
        $data = [
            'username' => str_random(5),
            'pwd' => mt_rand(20, 99),
        ];

        $id = UserModel::insertGetId($data);
        var_dump($id);
    }


    /**
     * 用户注册
     * 2019年1月3日14:26:56
     * zhangqi
     */
    public function reg()
    {
        return view('users.reg');
    }

    public function doReg(Request $request)
    {

        $nick_name = $request->input('nick_name');

        $u = UserModel::where(['nick_name'=>$nick_name])->first();
        if($u){
            die("用户名已存在");
        }

        $pass1 = $request->input('password');
        $pass2 = $request->input('u_pass2');


        if($pass1 !== $pass2){
            die("密码不一致");
        }

        $pass = password_hash($pass1,PASSWORD_BCRYPT);

        $data = [
            'nick_name'  => $request->input('nick_name'),
            'email'  => $request->input('email'),
            'created_at'  => time(),
            'password'  => $pass
        ];

        $uid = UserModel::insertGetId($data);

        if($uid){
            setcookie('uid',$uid,time()+86400,'/','shop.com',false,true);
            header("Refresh:3;url=/user/center");
            echo '注册成功,正在跳转';
        }else{
            echo '注册失败';
        }
    }

    public function center(Request $request)
    {

        echo '欢迎回来';
    }
}