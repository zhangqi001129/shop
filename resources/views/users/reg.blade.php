{{-- 用户注册--}}

@extends('layouts.bst')

@section('content')
    <form class="form-signin" action="/userreg" method="post">
        {{csrf_field()}}
        <h2 class="form-signin-heading">用户注册</h2>
        <label for="inputNickName">Nickname</label>
        <input type="text" name="nick_name" id="inputNickName" class="form-control" placeholder="nickname" required autofocus>

        <label for="inputEmail">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="@" required autofocus>

        <label for="inputPassword" >密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="***" required>

        <label for="inputPassword2" >确认密码</label>
        <input type="password" name="u_pass2" id="inputPassword2" class="form-control" placeholder="***" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
    </form>
@endsection