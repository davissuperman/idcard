<?php
include "Order.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>-->
    <title>Sneakerhead 身份证上传1</title>
    <link href="/idcard/css/tmall-verify.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/idcard/css/style.css">
    <link rel="stylesheet" href="/idcard/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/idcard/css/jquery.fileupload-ui.css">
    <style type="text/css">
        body {
            background-color: #FFFFFF;
            color: #FFFFFF;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px;
            line-height: 1.42857;
        }

    </style>
</head>
<body>

<div id="header">
    <?php
    $orderInstance = new Order();
    if($orderInstance->auth){
        $orderInfo = $orderInstance->getOrderInfo();
        $orderId = $orderInfo['orderid'];

        $orderInfo = $orderInfo['Order'];
        $auditStatus =  $orderInfo['AuditStatus'];
        $buttonUpload = false;
        $style = "";
        $imagesSelected = array();
        $cardVerifyText = '等待身份证上传';
        $cardVerifyImg = '';
        switch($auditStatus){
            case 0:
                //未上传，需要显示 上传按钮
                $buttonUpload = true;
                break;
            case 1:
                //等待审核,不显示上传按钮,只显示图片
                $buttonUpload = true;
                $cardVerifyText = '等待身份证审核';
                break;
            case 2:
                //审核通过，显示审核通过的指定的图片
                $style = "style='display:none'";
                $cardVerifyImg = '<img width=100 height=100 src="/idcard/img/mark.png"/>';
                $cardVerifyText = $cardVerifyImg;
                $imagesSelected = $orderInstance->getVerifiedImages();
                if(empty($imagesSelected)){
                    $cardVerifyImg = '';
                    $buttonUpload = true;
                    $cardVerifyText = '等待身份证审核';
                }
//                $orderInstance->display($imagesSelected);
                break;
            case 3:
                //审核未通过,需要显示上传按钮
                $cardVerifyText = '身份证图片不正确，请重新上传';
                $buttonUpload = true;
                break;

        }
        $orderDate = $orderInfo['OrderDate'];
        $wangwangName = $orderInfo['Name'];
        // $address = $orderInfo['Country'] ." ". $orderInfo['City']." ". $orderInfo['Address'];
        $email = $orderInfo['Email'];
        $phone = $orderInfo['Phone'];
        $product = $orderInfo['Product'];
        $orderDate =  $orderInfo['OrderDate'];

        //收货人相关信息
        $shipAddressState =  $orderInfo['ShipState'].$orderInfo['ShipCity'].$orderInfo['ShipAddress'];

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
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
        <div class="row fileupload-buttonbar">

            <div <?php echo $style;  ?>>
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                      <span>上传身份证</span>
                    <input type="file" name="files[]" multiple>
                    <input type="hidden" name="orderid" value="<?php echo $orderId; ?>" id="orderid">
                    <input type="hidden" name="auditstatus" value="<?php echo $auditStatus; ?>" id="auditstatus">
                </span>
                <p class="upload_tips">
                    大小: 不超过5M,&nbsp;&nbsp;&nbsp;&nbsp;格式: bmp, png, jpeg, jpg, gif
                </p>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>

            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
</form>
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
                    <p><?php echo $shipAddressState; ?></p>
                    <P><?php echo $shipAddress?>  邮编：<?php echo $shipZip; ?></P>
                </td>
                <td>
                    <p class="wait"><?php if($cardVerifyImg){ echo "审核通过";} else{echo $cardVerifyText;} ?></p>
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
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" >
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>保存</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% var selectArr = new Array();  %}
<?php  foreach($imagesSelected as $eachImage){ ?>
{%  selectArr.push("<?php echo$eachImage; ?>"); %}
<?php } ?>
{% for (var i=0, file; file=o.files[i]; i++) { %}
 {%
    if(selectArr.length>0){
        if ($.inArray(file.url,selectArr) >= 0) {
                        // alert(file.deleteUrl);
        }else{
            continue;
        }
    }

                %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            {% if (file.deleteUrl) {  %}
                <?php if($buttonUpload){ ?>
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>删除</span>
                </button>
                <?php }else{ echo ' <span class="cardverify">'.$cardVerifyText.'</span>';}?>
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<div id="footer">
    <p>Copyright 2001 - 2014 Sneakerhead.com. All Rights Reserved.</p>
</div>
<script src="/idcard/js/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="/idcard/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="/idcard/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="/idcard/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="/idcard/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="/idcard/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<!--<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="/idcard/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="/idcard/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="/idcard/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="/idcard/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<!--<script src="js/jquery.fileupload-audio.js"></script>-->
<!-- The File Upload video preview plugin -->
<!--<script src="js/jquery.fileupload-video.js"></script>-->
<!-- The File Upload validation plugin -->
<script src="/idcard/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="/idcard/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="/idcard/js/main.js"></script>
</body>
</html>