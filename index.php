<?php
include "Order.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>sneakerhead身份证上传</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>-->
    <!--<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>

<div class="container">
   <form  role="form" method="post" action="save.php" >
	 <h2 class="form-signin-heading">请提交身份证信息</h2>
       <p class="text-danger"><strong>上传的照片只用于海关个人包裹报关</strong>详情请点击 <a href="#" target="_blank">天猫海关需知</a></p>
	<h4>用户详情</h4>
       用户名：
	<h4>订单详情</h4>

    <?php
        $orderInfo = Order ::getOrderInfo();
		$orderInfo = $orderInfo[0];
		$orderDate = $orderInfo['OrderDate'];
		$wangwangName = $orderInfo['Name'];
       echo  <<<HTML

           <div class="row">
               <div class="col-md-4">订单日期</div>
               <div class="col-md-8">$orderDate</div>
           </div>
           <div class="row">
               <div class="col-md-4">旺旺昵称</div>
               <div class="col-md-8">$wangwangName</div>
           </div>

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                         <h4 class="panel-title">  产品1</h4>

                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        产品名称：
                    </div>
                </div>
            </div>
        </div>
        <br/>
HTML;
    ?>
       <div>
           <!-- 点击图片添加文件方式 -->
           <span class="btn btn-success fileinput-button" onclick="getElementById('inputfile').click()" >
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>上传...</span>
           </span>
           <p class="upload_tips">
               大小: 不超过2M,&nbsp;&nbsp;&nbsp;&nbsp;格式: bmp, png, jpeg, jpg, gif
           </p>
           <input type="file" name="image" style="opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
       </div>
       <div id="feedback"></div>    <!-- 响应返回数据容器 -->
       <div class="form-group">
           <div class="col-sm-offset-6 col-sm-10">
               <button type="submit"  class="btn btn-primary btn-lg">保存</button>
           </div>
       </div>

   </form>

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>-->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#inputfile").change(function(){
            //创建FormData对象
            var data = new FormData();
            //为FormData对象添加数据
            //
            $.each($('#inputfile')[0].files, function(i, file) {
                data.append('upload_file', file);
            });
            $.ajax({
                url:'submit_form_process.php',
                type:'POST',
                data:data,
                cache: false,
                contentType: false,    //不可缺
                processData: false,    //不可缺
                success:function(data){
                    data = $(data).html();
                    if($("#feedback").children('img').length == 0) $("#feedback").append(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
                    else $("#feedback").children('img').eq(0).before(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
                }
            });
        });
    });
</script>
</body>
</html>