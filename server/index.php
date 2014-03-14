<?php
header("Content-type: text/html; charset=utf-8");
//不存在当前上传文件则上传
$orderid = $_POST['orderid'];
$file = $orderid. $_FILES['upload_file']['name'];
$upload_dir = get_upload_path(null,$orderid);
$upload_file = $upload_dir.$file;
if (!is_dir($upload_dir)) {
    mkdir($upload_dir,0755, true);
}

$imgsrc =get_full_url().get_upload_path($file,$orderid);;
if(!file_exists($upload_file))
    move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$upload_file));
//输出图片文件<img>标签

$imgid = "img-".$orderid;
$buttonid = "button-".$orderid;
$deletestr = "onclick='$(#$imgid).hide();return false;'";
echo "
     <textarea><img width=100 height=100 src='$imgsrc' id='$imgid'/>
      <button  class='btn btn-danger delete' id='$buttonid' onclick='$(\"#$imgid\").hide();$(\"#$buttonid\").hide();return false;'>
       <i class='glyphicon '></i>
        <span>删除</span>    </button>
        </textarea>";


function get_upload_path($file_name = null,$orderid=null, $version = null) {
    $file_name = $file_name ? $file_name : '';
    if($file_name){
        return "/tmp/".$orderid."/".$file_name;;
    }else{
        $version_dir = dirname(get_server_var('SCRIPT_FILENAME')).'/tmp/';
        if ($version_dir) {
            return $version_dir.$orderid."/".$file_name;
        }
    }
}
function get_server_var($id) {
    return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
}
function get_full_url() {
    $https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0;
    return
        ($https ? 'https://' : 'http://').
        (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
        substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
}