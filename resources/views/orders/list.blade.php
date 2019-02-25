{{-- 购物车 --}}
@extends('layouts.bst')
@section('content')
    <table class="table table-hover" >
        <tr>
            <td>订单id</td>
            <td>订单号</td>
            <td>添加时间</td>
            <td>订单金额</td>
            <td>操作</td>
        </tr>
        @foreach($list as $k=>$v)
            <tr>
                <td class="active">{{$v['oid']}}</td>
                <td class="success">{{$v['order_sn']}}</td>
                <td class="warning">{{date('Y-m-d H:i:s',$v['add_time'])}}</td>
                <td class="danger">{{$v['order_amount']}}</td>
                <td class="danger">
                    @if($v['is_pay']=='0')
                        <a href="/Pay/{{$v['oid']}}" class="del_goods">付款</a>
                    @elseif($v['is_pay']=='1')
                        已付款
                    @endif
                </td>
                <td class="info"> <li class="btn"> <a href="/orderdel/{{$v['oid']}}" class="del_goods">移除订单</a></li></td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    @parent
@endsection
