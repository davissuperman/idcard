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
		$orderInfo = $orderInfo[0];
		$orderDate = $orderInfo['OrderDate'];
		$wangwangName = $orderInfo['Name'];
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
                             <th colspan="7"><h4>用户详情</h4></th>
                         </tr>
                         <tr>
                             <td colspan="2">
                                 昵称：
                                 <span class="nickname">静听秋雨2011</span>
                                 <span data-display="inline" data-nick="静听秋雨2011" class="ww-light ww-large"><a target="_blank" href="http://www.taobao.com/webww/?ver=1&amp;&amp;touid=cntaobao%E9%9D%99%E5%90%AC%E7%A7%8B%E9%9B%A82011&amp;siteid=cntaobao&amp;status=1&amp;portalId=&amp;gid=&amp;itemsId=" class="ww-inline ww-offline"><span>旺旺离线</span></a></span>
                             </td>
                             <td colspan="6">
                                 真实姓名：
                                 <span class="name"></span>

                             </td>
                         </tr>
                         <tr>
                             <td colspan="2">所在地区：<span class="city"> </span></td>
                             <td class="contact" colspan="6">联系电话：<span class="tel"></span></td>
                         </tr>
                         <tr>
                             <td valign="top" colspan="2">邮件：<span>***</span>
                                 <a href="http://member1.taobao.com/message/add_private_msg.htm?recipient_nickname=%BE%B2%CC%FD%C7%EF%D3%EA2011" target="_blank">发送站内信</a>
                             </td>
                             <td colspan="6"><div style="position:absolute;">支<span style="padding: 0.5em">付</span>宝：</div><div style="padding-left:5em;">1***</div></td>
                         </tr>
                         </tbody>

                         <!-- 订单信息 -->
                         <tbody class="order">
                         <tr class="sep-row">
                             <td colspan="8"></td>
                         </tr>
                         <tr class="order-hd">
                             <th class="item">宝贝</th>
                             <th class="sku">宝贝属性</th>
                             <th class="status">状态</th>
                             <th class="service">服务</th>
                             <th class="price">单价(元)</th>
                             <th class="num">数量</th>
                             <th class="discount">优惠</th>
                             <th class="order-price last">商品总价(元)</th>
                         </tr>
                         <tr class="order-item">
                             <td class="item">
                                 <div class="pic-info">
                                 </div>
                                 <div class="txt-info">
                                     <div class="desc">
                                         <span class="name"><a target="_blank" title="Nike FS Lite Run 耐尔新款男鞋 黑红软底跑步鞋616514-004" href="http://trade.taobao.com/trade/detail/trade_snap.htm?trade_id=558494912604315">Nike FS Lite Run 耐尔新款男鞋 黑红软底跑步鞋616514-004</a></span>
                                         <br>

                                         <a style="vertical-align: middle;" target="_blank" href="http://trade.taobao.com/trade/security/security_card.htm?bizOrderId=558494912604315" title="保障卡">
                                             <img src="http://img02.taobaocdn.com/tps/i2/T1S4ysXh8pXXXXXXXX-52-16.png">
                                         </a>


                                     </div>
                                 </div>
                             </td>
                             <td class="sku">

                                 <div class="props"><span>颜色分类: 616514-004</span><span>鞋码: 46美国现货</span></div>
                             </td>
                             <td class="status">

                                 已取消 <a title="取消原因：我不想买了" href="#" class="refund-reason J_ViewReason"><img src="http://a.tbcdn.cn/app/trade/img/view_reason.png"></a>
                             </td>
                             <td class="service">
                             </td>
                             <td class="price">614.00</td>
                             <td class="num">1</td>
                             <td class="discount">
                                 -
                             </td>
                             <td rowspan="1" class="order-price">
                                 614.00



                                 <li>(快递

                                     : 0.00
                                     )</li>

                             </td>
                         </tr>
                         <tr class="order-ft">
                             <td colspan="8">
                                 <div colspan="6" class="get-money">
                                     <br>
                                     实收款：
                                     <strong>614.00</strong>元
                                 </div>
                             </td>
                         </tr>
                         </tbody>
                         <!-- 其它信息 -->
                         <tbody class="misc-info">
                         <tr class="sep-row">
                             <td colspan="8"></td>
                         </tr>
                         <tr>
                             <td colspan="8">
                                 <span class="label">订单编号：</span>
                                 <span class="order-num">558494912604315</span>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="8">
                                 <span class="label">支付宝交易号：</span>
                                 <span class="alilay-num">2014030611001001080034273004</span>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="8">
                                 <span class="label">成交时间：</span>
                                 <span class="trade-time">2014-03-06 21:51:09</span>
                             </td>
                         </tr>
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
                     <td>史东岳 ，15075556657 ， ，河北省 唐山市 其它区 海港开发区国投中煤同煤京唐港口有限公司 ，063611</td>
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