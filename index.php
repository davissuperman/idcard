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
    <!-- Tab panes -->
   <form  role="form" method="post" action="save.php" >
	 <h2 class="form-signin-heading">请提交身份证信息</h2>
       <p class="text-danger"><strong>上传的照片只用于海关个人包裹报关</strong>详情请点击 <a href="#" target="_blank">天猫海关需知</a></p>
    <?php
        $orderInfo = Order ::getOrderInfo();
		$orderInfo = $orderInfo['Order'];
		$orderDate = $orderInfo['OrderDate'];
		$wangwangName = $orderInfo['Name'];
        $address = $orderInfo['Country'] ." ". $orderInfo['City']." ". $orderInfo['Address'];
        $email = $orderInfo['Email'];
        $phone = $orderInfo['Phone'];
        $product = $orderInfo['Product'];
        $orderDate =  $orderInfo['OrderDate'];

        //收货人相关信息
        $shipName = $orderInfo['ShipName'];
        $shipAddress =  $orderInfo['ShipCountry'] .$orderInfo['ShipCity'].$orderInfo['ShipAddress'].$orderInfo['ShipAddress2'] ;
//    var_dump($orderInfo);
    /*
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
    */
    ?>
     <!-- Nav tabs -->
     <ul class="nav nav-tabs">
         <li class="active"><a href="#home" data-toggle="tab">订单信息</a></li>
         <li><a href="#profile" data-toggle="tab">收货信息</a></li>
     </ul>
     <div class="tabs-panels tab-content">
         <div class="tab-pane active" id="home">
             <div class="info-box order-info ks-switchable-panel-internal9" style="display: block;">
                 <div class="bd">
                     <table>
                         <colgroup>
                             <col class="item">
                             <col class="sku">
                             <col class="status">
                             <col class="service">
                             <col class="price">
                             <col class="num">
                             <col class="discount">
                             <col class="order-price">
                         </colgroup>
                         <tbody class="contact-info">
                         <tr>
                             <th colspan="7"> 用户详情 </th>
                         </tr>
                         <tr>
                             <td colspan="2">
                                 昵称：
                                 <span class="nickname"><?php echo $wangwangName;?></span>
                             </td>
                             <td valign="top"  >邮件：<span><?php echo $email?></span>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2">所在地区：<span class="city"><?php echo $address?> </span></td>
                             <td class="contact" colspan="6">联系电话：<span class="tel"><?php echo $phone?></span></td>
                         </tr>
                         </tbody>
                         <tbody class="misc-info">
                         <tr class="sep-row">
                             <td colspan="8"></td>
                         </tr>
<!--                         <tr>-->
<!--                             <td colspan="8">-->
<!--                                 <span class="">订单编号：</span>-->
<!--                                 <span class="order-num">558494912604315</span>-->
<!--                             </td>-->
<!--                         </tr>-->
                         <tr>
                             <td colspan="8">
                                 <span class="">订单成交时间：</span>
                                 <span class="trade-time"><?php echo $orderDate;?></span>
                             </td>
                         </tr>
                         </tbody>
                         <!-- 订单信息 -->
                         <tbody class="order">
                         <tr class="sep-row">
                             <td colspan="8"></td>
                         </tr>
                         <tr class="order-hd">
                             <th class="item">宝贝</th>
                             <th class="order-price last">商品总价(元)</th>
                         </tr>
                         <?php foreach($product as $each){
                                    $pName = $each['ProductName'];
                                    $price = $each['PricePerUnit'];
                                    echo <<<HTML
 <tr class="">
                             <td class="item">
                                 <div class="pic-info">
                                 </div>
                                 <div class="txt-info">
                                     <div class="desc">
                                         <span class="name">
                                                $pName
                                         </span>
                                     </div>
                                 </div>
                             </td>
                             <td rowspan="1" class="order-price">
                                 $price
                             </td>
                         </tr>
HTML;

                            }
                        ?>
<!--                         <tr class="order-ft">-->
<!--                             <td colspan="8">-->
<!--                                 <div colspan="6" class="get-money">-->
<!--                                     <br>-->
<!--                                     实收款：-->
<!--                                     <strong>614.00</strong>元-->
<!--                                 </div>-->
<!--                             </td>-->
<!--                         </tr>-->
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="tab-pane" id="profile">
             <table class="simple-list logistics-info">
                 <tbody>
                 <tr>
                     <th>收货地址：</th>
                     <td><?php echo $shipName?> ，15075556657 <?php echo $shipAddress?>，063611</td>
                 </tr>
             </table>
         </div>
     </div>
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
            data.append('orderid', "123456");
            $.ajax({
                url:'submit_form_process.php',
                type:'POST',
                data:data,
                cache: false,
                contentType: false,    //不可缺
                processData: false,    //不可缺
                success:function(data){
                    data = $(data).html();
                    var innerhtml ="<div style='padding-bottom:10px;'>" + data.replace(/&lt;/g,'<').replace(/&gt;/g,'>') + "</div>";
                    if($("#feedback").children('img').length == 0) $("#feedback").append(innerhtml);
                    else $("#feedback").children('img').eq(0).before(innerhtml);
                  //  $("#deletebutton").show();
                }
            });
        });

//        $("#deletebutton").click(function(){
//            $("#feedback").html('');
//            $("#deletebutton").hide();
//        });
    });
</script>
</body>
</html>