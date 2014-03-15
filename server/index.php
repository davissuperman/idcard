<?php
if(isset($_POST['getexist']) && $_POST['getexist']){
    //Load exists image
    $orderid = $_POST['orderid'];
    $dir =   dirname(get_server_var('SCRIPT_FILENAME')).'/tmp/'.$orderid;
    $fileArr = readFileArr($dir);
 //   print_r($fileArr);
    $return = "<textarea><table>";
    foreach($fileArr as $eachFile){
        $parts = explode('.', $eachFile);
        $timeStamp = $parts[0];
        $imgsrc = get_full_url()."/tmp/$orderid/".$eachFile;
        $imgid = "img-".$timeStamp;
        $trid = "tr-".$timeStamp;
        $buttonid = $eachFile;
        $return .= "
     <tr id='$trid'><td><img width=100 height=100 src='$imgsrc' id='$imgid'/></td>
      <td> <button  data-url='$imgsrc'   class='delete' id='$buttonid' >
      <i class='glyphicon '></i>
        <span>删除</span>    </button></td></tr>
       ";
    }
    $return .= "</table><script> $('.delete').click(function(){
            var id = this.id;
            var strinfo = new Array();
            strinfo = id.split('.');
            timestamp = strinfo[0];
              trid =  'tr-' + timestamp;
                  $('#'+trid).hide();
           $.ajax({
            url:'/idcard/server/index.php',
            type:'POST',
            data:  {orderid:$orderid,delete:true,imgid:id},
            success:function(data){
                  tableid =  'table-' + id;
                  $('#'+tableid).hide();
            }
        });
        });</script> </textarea>";
    echo $return;
    return;
}
if(isset($_POST['delete']) && $_POST['delete']){
    $orderid = $_POST['orderid'];
    $img =  $_POST['imgid'];
    $file =  get_upload_file($img,$orderid);
    echo @unlink($file);
    return;
}
show();
function show(){
    header("Content-type: text/html; charset=utf-8");
//不存在当前上传文件则上传
    $orderid = $_POST['orderid'];
    $file = $_FILES['upload_file']['name'];
    $time = time();
    $upload_dir = get_upload_path(null,$orderid);

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir,0755, true);
    }
    $serverFileName =  trim_file_name($time, $file);
    $upload_file = $upload_dir.$serverFileName;
    $imgsrc =get_full_url().get_upload_path($serverFileName,$orderid);;
    if(!file_exists($upload_file))
        move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$upload_file));
//输出图片文件<img>标签

    $imgid = "img-".$time;
    $tableid = "table-".$time;
    $buttonid = $serverFileName;
    $deletestr = "onclick='$(#$imgid).hide();return false;'";
    echo "
     <textarea><table id='$tableid'><tr><td><img width=100 height=100 src='$imgsrc' id='$imgid'/></td>
      <td> <button  class='delete' id='$buttonid' >
      <i class='glyphicon '></i>
        <span>删除</span>    </button></td></tr></table>
        <script> $('.delete').click(function(){
            var id = this.id;
            var strinfo = new Array();
            strinfo = id.split('.');
            timestamp = strinfo[0];
            tableid =  'table-' + timestamp;
            $('#'+tableid).hide();
              $.ajax({
            url:'/idcard/server/index.php',
            type:'POST',
            data:  {orderid:$orderid,delete:true,imgid:id},
            success:function(data){
                  tableid =  'table-' + id;
                  $('#'+tableid).hide();
            }
        });
        });</script> </textarea>";
}


function get_upload_file($file_name = null,$orderid=null, $version = null) {
    $file_name = $file_name ? $file_name : '';

    $version_dir = dirname(get_server_var('SCRIPT_FILENAME')).'/tmp/';
    return $version_dir.$orderid."/".$file_name;
}
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

function readFileArr($dir){
//PHP遍历文件夹下所有文件
    $handle=opendir($dir.".");
//定义用于存储文件名的数组
    $array_file = array();
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != "..") {
            $array_file[] = $file; //输出文件名
        }
    }
    closedir($handle);
    return $array_file;
}

function trim_file_name($time, $name) {
    // Remove path information and dots around the filename, to prevent uploading
    // into different directories or replacing hidden system files.
    // Also remove control characters and spaces (\x00..\x20) around the filename:
    $name = trim(basename(stripslashes($name)), ".\x00..\x20");
    // Use a timestamp for empty filenames:
    if (!$name) {
        $name = str_replace('.', '-', microtime(true));
    }

    $parts = explode('.', $name);
    $extIndex = count($parts) - 1;
    $ext = strtolower(@$parts[$extIndex]);
   return $time.".$ext";

}