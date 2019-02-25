<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/1/10
 * Time: 下午 02:34
 */

namespace App\Http\Controllers\Order;
use App\Model\CartModel;
use App\Model\GoodsModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function add(Request $request)
    {
        //查询购物车商品
        $cart_goods = CartModel::where(['uid'=>session()->get('uid')])->orderBy('id','desc')->get()->toArray();
        if(empty($cart_goods)){
            die("购物车中无商品");
        }
        $order_amount = 0;
        foreach($cart_goods as $k=>$v){
            $goods_info = GoodsModel::where(['goods_id'=>$v['goods_id']])->first()->toArray();
            $goods_info['num'] = $v['num'];
            $list[] = $goods_info;

            //计算订单价格 = 商品数量 * 单价
            $order_amount += $goods_info['price'] * $v['num'];
        }

        //生成订单号
        $order_sn = OrderModel::Ordernumber();
        $data = [
            'order_sn'      => $order_sn,
            'uid'           => session()->get('uid'),
            'add_time'      => time(),
            'order_amount'  => $order_amount
        ];

        $oid = OrderModel::insertGetId($data);
        if(!$oid){
            echo '生成订单失败';
        }else{
            header('Refresh:2;url=orderlist');
            echo '下单成功,订单号：'.$oid .' 跳转支付';
        } 



        //清空购物车
        CartModel::where(['uid'=>session()->get('uid')])->delete();
    }
    public function show(){
        $where=[
            'uid'=>session()->get('uid'),
            'is_pay'=>0
        ];
        $list = OrderModel::where($where)->orderBy('oid','desc')->get()->toArray();
        $data = [
            'list'  => $list
        ];
        return view('orders.list',$data);
    }
    //删除 订单
    public function del($oid){
        $rs=OrderModel::where(['oid'=>$oid])->delete();
        if($rs){
            header('refresh:2;url=/orderlist');
            echo '删除成功';
        }else{
            header('refresh:2;url=/orderlist');
            echo '删除失败';
        }
    }
    public function pay($oid){
        $where=[
            'oid'=>$oid
        ];
        $list=[
            'is_pay'=>1
        ];
       $rs= OrderModel::where($where)->update($list);
        if($rs){
            header('refresh:2;url=/orderlist');
            echo '支付成功';
        }else{
            header('refresh:2;url=/orderlist');
            echo '支付失败';
        }
    }
}