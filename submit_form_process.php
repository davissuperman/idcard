<?php
	header("Content-type: text/html; charset=utf-8"); 
	//不存在当前上传文件则上传
    $orderid = $_POST['orderid'];
    $orderid = $orderid. time();
    $file = $orderid. $_FILES['upload_file']['name'];
    $cardFile = 'tmp/'.$file;
	if(!file_exists($cardFile))
        move_uploaded_file($_FILES['upload_file']['tmp_name'],iconv('utf-8','gb2312',$cardFile));
	//输出图片文件<img>标签

    $imgid = "img-".$orderid;
    $buttonid = "button-".$orderid;
    $deletestr = "onclick='$(#$imgid).hide();return false;'";
     echo "
     <textarea><img width=100 height=100 src='$cardFile' id='$imgid'/>
      <button  class='btn btn-danger delete' id='$buttonid' onclick='$(\"#$imgid\").hide();$(\"#$buttonid\").hide();return false;'>
       <i class='glyphicon '></i>
        <span>删除</span>    </button>
        </textarea>";

