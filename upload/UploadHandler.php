<?php
class UploadHandler{
    function __construct(){
        header("Content-type: text/html; charset=utf-8");
//不存在当前上传文件则上传
        $orderid = $_POST['orderid'];
        $orderid = $orderid. time();
        $file = $orderid. $_FILES['upload_file']['name'];
        $uploadDir = dirname($this->get_server_var('SCRIPT_FILENAME')).'/files/';
        $cardFile = $uploadDir.$file;
        if(!file_exists($cardFile))
            move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$cardFile));
//输出图片文件<img>标签
        $srcImg = "/idcard/upload/files/".$file;
        $imgid = "img-".$orderid;
        $buttonid = "button-".$orderid;
        $deletestr = "onclick='$(#$imgid).hide();return false;'";
        echo "
     <textarea><img width=100 height=100 src='$srcImg' id='$imgid'/>
      <button  class='btn btn-danger delete' id='$buttonid' onclick='$(\"#$imgid\").hide();$(\"#$buttonid\").hide();return false;'>
       <i class='glyphicon '></i>
        <span>删除</span>    </button>
        </textarea>";
    }

    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }
    protected function get_file_type($file_path) {
        switch (strtolower(pathinfo($file_path, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            default:
                return '';
        }
    }
}

//End_php