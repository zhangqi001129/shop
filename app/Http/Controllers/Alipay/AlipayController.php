<?php
namespace App\Http\Controllers\Alipay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
class AlipayController extends Controller
{
    public function test(){
        echo '111';
        $url = 'http://order.com';
        $client = new Client([
            'base_uri'=>$url,
            'timeout'=>2.0
        ]);
        $response = $client->request('GET','/index.php');
        echo $response->getBody();
    }
}