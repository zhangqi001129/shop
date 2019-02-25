{{-- 购物车 --}}
@extends('layouts.bst')
@section('content')
    <table class="table table-hover" >
        <tr>
            <td>商品id</td>
            <td>购买数量</td>
            <td>添加时间</td>
            <td>添加用户</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td class="active">{{$v['goods_id']}}</td>
                <td class="success">{{$v['num']}}</td>
                <td class="warning">{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
                <td class="danger">{{$v['uid']}}</td>
                <td class="info"> <li class="btn"> <a href="/cartdel2/{{$v['id']}}" class="del_goods">删除</a></li></td>
            </tr>
        @endforeach
        <hd> <a href="/orderadd" id="submit_order" class="btn btn-info "> 提交订单 </a></hd>
    </table>

@endsection

@section('footer')
    @parent
@endsection
