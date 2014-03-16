<?php
class Order{
    public $orderid;
    public $auth = false;
    public $errorMessage;
    public function __construct(){
        $requestUri = trim( $_SERVER['REQUEST_URI'],'/');
        $arr = explode("/",$requestUri);
        if(count($arr)<2){
            $this->errorMessage = "订单号不能为空";
        }else if(count($arr)<4){
            $this->errorMessage = "订单号无此权限";
        }else{
            $this->orderid = $arr[2];
            $this->token = $arr[4];
            $str = $this->orderid."sneakerhead";
            if(md5($str) ==  $this->token){
                $this->auth = true;
            }else{
                $this->errorMessage = "订单号无此权限";
            }
        }

        //$this->auth = true;
//        echo trim( $_SERVER['REQUEST_URI'],'/');
//        $this->display($_SERVER);
    }
    public function getOrderInfo(){
        $orderId = $this->orderid ;
        if(!$orderId){
            $this->errorMessage = "订单号错误，不能为空";
            $this->auth = false;
        }
        if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            $url = "http://10.0.0.24:10009/Order.ashx?OrderID=$orderId";
        }else{
            $url = "http://116.247.69.238:10009/Order.ashx?OrderID=$orderId";
        }
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
    public function display($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}