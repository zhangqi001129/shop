@extends('layouts.bst')

@section('content')
    <h2 align="center">订单支付</h2>
    <input type="hidden" value="{{$code_url}}" id="code">
    <div id="qrcode" align="center"></div>
@endsection
@section('footer')
    @parent
    <script src="{{URL::asset('/qrcodejs-master/qrcode.js')}}"></script>
    <script>
        var code=$('#code').val()
        // 设置参数方式
        var qrcode = new QRCode('qrcode', {
            text:"{{$code_url}}" ,
            width: 100,
            height: 100,
            colorDark : '#000000',
            colorLight : '#ffffff',
            correctLevel : QRCode.CorrectLevel.H
        });
        // 使用 API
        qrcode.clear();
        qrcode.makeCode(code);
        setInterval(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/weixin/pay/success?order_id=' + "{{$order_id}}",
                type: 'get',
                dataType: 'json',
                success: function (a) {
                    //console.log(a.error)
                    if(a.error==0){
                        alert(a.msg);
                        location.href="/orderlist";
                    }
                }
            })
        },2000)
    </script>
@endsection