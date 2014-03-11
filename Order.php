<?php
class Order{
    static function getOrderInfo(){
        $orderId = trim($_GET['orderid']);
        if(!$orderId){
            echo"订单号错误，不能为空";die;
        }
        $url = "http://116.247.69.238:10009/Order.ashx?OrderID=$orderId";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查，0表示阻止对证书的合法性的检查。
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);

        $result = json_decode ($r ,true);
        $result['orderid'] = $orderId;
        return $result;
    }
}