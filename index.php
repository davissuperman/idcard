<?php
include "Order.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>-->
    <title>Sneakerhead 身份证上传</title>
    <link href="/card/css/tmall-verify.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="header">
   <?php
        $orderInstance = new Order();
        if($orderInstance->auth){
            $orderInfo = $orderInstance->getOrderInfo();
            $orderId = $orderInfo['orderid'];
            $orderInfo = $orderInfo['Order'];
            $orderDate = $orderInfo['OrderDate'];
            $wangwangName = $orderInfo['Name'];
            // $address = $orderInfo['Country'] ." ". $orderInfo['City']." ". $orderInfo['Address'];
            $email = $orderInfo['Email'];
            $phone = $orderInfo['Phone'];
            $product = $orderInfo['Product'];
            $orderDate =  $orderInfo['OrderDate'];

            //收货人相关信息
            $shipName = $orderInfo['ShipName'];
            $shipPhone = $orderInfo['ShipPhone'];
            $shipZip = $orderInfo['ShipZip'];
            $shipAddress = $orderInfo['ShipAddress2'] ;
        }

?>
    <div id="logo">
        <a href="http://sneakerhead-usa.tmall.hk/"><img src="http://img03.taobaocdn.com/L1/142/406133590/modules/tshop-um-MAINHEAD/assets/images/LOGO_index.png"></a>
    </div>

    <div id="main-nav" class="clearfix">
        <ul>
            <li id="main-nav-home"><a href="http://sneakerhead-usa.tmall.hk/">首页</a></li>
            <li id="main-nav-new"><a href="http://sneakerhead-usa.tmall.hk/p/new.htm?spm=a1z10.1.w7183964-3595196440.3.i6B3vI">新品上市</a></li>
            <li><a href="http://sneakerhead-usa.tmall.hk/p/man.htm?spm=a1z10.4.w7183964-3595196440.4.oXMTJW">男鞋</a></li>
            <li><a href="http://sneakerhead-usa.tmall.hk/p/woman.htm?spm=a1z10.4.w7183964-3595196440.5.DUYVA0">女鞋</a></li>
            <li><a href="http://sneakerhead-usa.tmall.hk/p/kodomo.htm?spm=a1z10.4.w7183964-3595196440.6.9lDb9v">幼童鞋</a></li>
            <li id="main-nav-accessory"><a href="http://sneakerhead-usa.tmall.hk/p/fuku.htm?spm=a1z10.4.w7183964-3595196440.7.F94NjR">服饰</a></li>
            <li id="main-nav-about"><a href="http://sneakerhead-usa.tmall.hk/p/about.htm?spm=a1z10.4.w7183964-3595196440.8.B3WxOk">关于我们</a></li>
        </ul>
    </div>

</div>


<div id="wrapper">

    <h1>SNEAKERHEAD旗舰店发货提示</h1>


    <h2>亲爱的顾客您好</h2>
    <p>
        送老婆 送妈妈 爱她就送她最好的 1 彼岸花原创正品 选女王包 请认准彼岸花品牌 只此一家 别无分号 2 采用高档浅金五金 性价比超高 3 品牌包装 吊牌齐全 自己用 有品味 送朋友 有面子！！！！
        柔美设计，以童话故事中白雪公主为原型 百褶裙设计 华美异常 2 进口复合材质 女包材质之王3：品牌包装 吊牌齐全 自己用 有品味 送朋友 有面子
    </p>
    <p>
        送老婆 送妈妈 爱她就送她最好的 1 彼岸花原创正品 选女王包 请认准彼岸花品牌 只此一家 别无分号 2 采用高档浅金五金 性价比超高 3 品牌包装 吊牌齐全 自己用 有品味 送朋友 有面子！！！！
        柔美设计，以童话故事中白雪公主为原型 百褶裙设计 华美异常 2 进口复合材质 女包材质之王3：品牌包装 吊牌齐全 自己用 有品味 送朋友 有面子
    </p>
    <?php
    if($orderInstance->auth){
    ?>
    <div id="upload">
<!--        <form id="" action="">-->
            <button  onclick="getElementById('inputfile').click()">上传身份证</button>
            <p id="upload_tips">
                大小: 不超过2M,&nbsp;&nbsp;&nbsp;&nbsp;格式: bmp, png, jpeg, jpg, gif
            </p>
            <input type="file" name="image" style="opacity:0;filter:alpha(opacity=0);" id="inputfile"/>
            <input type="hidden" name="orderid"  id="orderid"  value="<?php echo $orderId; ?>">
<!--        </form>-->
            <div id="feedback"></div>    <!-- 响应返回数据容器 -->
    </div>



    <h2>物流讯息</h2>
    <table id="table-shipping">
        <thead>
        <tr>
            <td>
                快递收件讯息
            </td>
            <td>
                订单处理进度
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <h3><?php echo $shipName?> (女士/先生)</h3>
<!--                <p>浙江省 杭州市 余杭区 文一西路969号3号小邮局 (天猫 收) 邮编：311121</p>-->
                <P><?php echo $shipAddress?>  邮编：<?php echo $shipZip; ?></P>
            </td>
            <td>
                <p class="wait">等待身份证上传</p>
            </td>
        </tr>
        </tbody>
    </table>

    <h2>订单明细</h2>
    <table>
        <tbody>
        <?php
        if(isset($product['ProductName'])){
            $product = array($product);
        }
        foreach($product as $each){
            $pName = $each['ProductName'];
            $pSrc =  $each['ImageUrl'];
            $eursize = $each['Eursize'];
            if(strtolower($each['Gender']) == "men"){
                $sex = "男子";
            }else if(strtolower($each['Gender']) == "woman"){
                $sex = "女子";
            }
        ?>
        <tr>
            <td class="order-img">
                <a href="#"><img src="<?php echo $pSrc?>"></a>
            </td>
            <td>
                <p class="order-info"><?php echo $pName;?></p>
                <p class="order-info">鞋码: 男子<?php echo $eursize;?>码</p>
            </td>
        </tr>
        <?php } ?>
        </tbody>

    </table>
    <?php
    }else{
        echo "<font color='red'>".$orderInstance->errorMessage."</font>";
    }
    ?>


</div>

<div id="footer">
    <p>Copyright 2001 - 2014 Sneakerhead.com. All Rights Reserved.</p>
</div>
<script src="/card/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var orderid = $("#orderid").val();
        $("#inputfile").change(function(){
            //创建FormData对象
            var data = new FormData();
            //为FormData对象添加数据
            //
            $.each($('#inputfile')[0].files, function(i, file) {
                data.append('upload_file', file);
            });
            data.append('orderid',orderid);
            $.ajax({
                url:'server/index.php',
                type:'POST',
                data:data,
                cache: false,
                contentType: false,    //不可缺
                processData: false,    //不可缺
                beforeSend:function(XMLHttpRequest){
                    $("#myShow").css({display:"",top:"50%",left:"50%",position:"absolute"});
                },
                success:function(data){
                    data = $(data).html();
                    var innerhtml ="<div style='padding-bottom:10px;'>" + data.replace(/&lt;/g,'<').replace(/&gt;/g,'>') + "</div>";
                    if($("#feedback").children('img').length == 0) $("#feedback").append(innerhtml);
                    else $("#feedback").children('img').eq(0).before(innerhtml);
                    $("#myShow").hide();
                    //  $("#deletebutton").show();
                }
            });
        });

        // Load existing files:
        $.ajax({
            url:'server/index.php',
            type:'POST',
            data:  {orderid:orderid,getexist:true},
            success:function(data){
                data = $(data).html();
                var innerhtml ="<div style='padding-bottom:10px;'>" + data.replace(/&lt;/g,'<').replace(/&gt;/g,'>') + "</div>";
                if($("#feedback").children('img').length == 0) $("#feedback").append(innerhtml);
                else $("#feedback").children('img').eq(0).before(innerhtml);
                $("#myShow").hide();
            }
        });


    });
</script>
</body>
</html>