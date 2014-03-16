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
        if(!strstr($timeStamp,'thumbnail')){
            continue;
        }
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
            beforeSend:function(XMLHttpRequest){
                    $('#myShow').show();
                },
            success:function(data){
                  tableid =  'table-' + id;
                  $('#'+tableid).hide();
                  $('#myShow').hide();
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
    $type = $_FILES["upload_file"]["type"] ;
    if(!stristr($type,'image' )){
        echo " <textarea><font color='red'><div>文件类型错误，格式: bmp, png, jpeg, jpg, gif</div></font></textarea>";
        return;
    }
    $size = $_FILES['upload_file']['size']/1024;
    if($size > 5000){
        echo " <textarea><font color='red'><div>文件大于5M</div></font></textarea>";
        return;
    }
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
    //生成缩略图
    $thumbnailImg = 'thumbnail_'.$serverFileName;
    $thumbnailImgSrc =  $upload_dir.$thumbnailImg;
    img2thumb($upload_file,$thumbnailImgSrc);
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
             beforeSend:function(XMLHttpRequest){
                    $('#myShow').show();
                },
            data:  {orderid:$orderid,delete:true,imgid:id},
            success:function(data){
                  tableid =  'table-' + id;
                  $('#'+tableid).hide();
                  $('#myShow').hide();
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
        return "/tmp/".$orderid."/"."thumbnail_".$file_name;;
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
    $handle=opendir($dir);
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
function fileext($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}
function img2thumb($src_img, $dst_img, $width = 100, $height = 100, $cut = 0, $proportion = 0)
{
    if(!is_file($src_img))
    {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;

    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }

    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  //有宽无高
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  //有高无宽
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  //裁剪时无高
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  //裁剪时无宽
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }

    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);

    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}