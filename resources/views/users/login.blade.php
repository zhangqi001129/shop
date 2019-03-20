{{-- 用户登录--}}

@extends('layouts.bst')

@section('content')
    <form class="form-signin" action="/userlogin" method="post">
        {{csrf_field()}}
        <h2 class="form-signin-heading">请登录</h2>
        <label for="inputEmail">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="@" required autofocus>
        <label for="inputPassword" >Password</label>
        <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="***" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <a href="https://open.weixin.qq.com/connect/qrconnect?appid=wxe24f70961302b5a5&redirect_uri=http://mall.77sc.com.cn/weixin.php?r1=http://zq.lixiaonitongxue.top/weixin/getcode&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect'">Login</a>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
@endsection




