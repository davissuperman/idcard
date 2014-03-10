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
<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css">
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>-->
    <!--<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>

<div class="container"  id="main">
    <!-- Tab panes -->
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
	 <h2 class="form-signin-heading">请提交身份证信息</h2>
       <p class="text-danger"><strong>上传的照片只用于海关个人包裹报关</strong>详情请点击 <a href="#" target="_blank">天猫海关需知</a></p>
    <?php
        $orderInfo = Order ::getOrderInfo();
		$orderId = $orderInfo['orderid'];
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
        $shipPhone = $orderInfo['ShipPhone'];
        $shipZip = $orderInfo['ShipZip'];
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
                             <th colspan="2"> 用户详情 </th>
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
                             <td colspan="2"></td>
                         </tr>
<!--                         <tr>-->
<!--                             <td colspan="8">-->
<!--                                 <span class="">订单编号：</span>-->
<!--                                 <span class="order-num">558494912604315</span>-->
<!--                             </td>-->
<!--                         </tr>-->
                         <tr>
                             <td colspan="2">
                                 <span class="">订单成交时间：</span>
                                 <span class="trade-time"><?php echo $orderDate;?></span>
                             </td>
                         </tr>
                         </tbody>
                         <!-- 订单信息 -->
                         <tbody class="order">
                         <tr class="sep-row">
                             <td colspan="2"></td>
                         </tr>
                         <tr class="order-hd">
                             <th class="item">宝贝</th>
                             <th class="order-price last">商品总价(元)</th>
                         </tr>
                         <?php foreach($product as $each){
                                    $pName = $each['ProductName'];
                                    $price = $each['PricePerUnit'];
                                    echo <<<HTML
 <tr class="order-item">
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
                     <td><?php echo $shipName?> ，<?php echo $shipPhone;?> <?php echo $shipAddress?>，<?php echo $shipZip; ?></td>
                 </tr>
             </table>
         </div>
     </div>
       <div class="row fileupload-buttonbar">
           <div class="col-lg-7">
               <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>上传...</span>
                    <input type="file" name="files[]" multiple>
                    <input type="hidden" name="orderid" value="<?php echo $orderId; ?>" id="orderid">
                </span>
               <p class="upload_tips">
                   大小: 不超过2M,&nbsp;&nbsp;&nbsp;&nbsp;格式: bmp, png, jpeg, jpg, gif
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

</div> <!-- /container -->


<!-- The template to display files available for upload -->
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
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>删除</span>
                </button>
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


</div> <!-- /container -->
<script type="text/javascript">
    var loading_dom = document.createElement("div");
    with(loading_dom){
        style.width='100%';
        style.height = window.innerHeight+'px';
        loading_dom.style.position ='absolute';
        style.top ='0';
        style.zIndex ='999999';
        style.background ='#ffffff';
        addEventListener('touchstart',function(e){
            e.preventDefault();
        });
        addEventListener('touchmove',function(e){
            e.preventDefault();
        });
        addEventListener('touchend',function(e){
            e.preventDefault();
        });
        innerHTML = "<p style='text-align:center;margin-top:"+(window.innerHeight/2-50)+"px'><span class='icon icon-spinner5' style='font-size:24px;color:#444'></span><br />载入中..</p>";
    }
    document.body.appendChild(loading_dom);
    var loadedpage = function(){
        document.getElementById('main').style.visibility='visible';
        loading_dom.style.display = 'none';
        document.body.removeChild(loading_dom);
    };
    window.onload = loadedpage;
</script>
<script src="js/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<!--<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<!--<script src="js/jquery.fileupload-audio.js"></script>-->
<!-- The File Upload video preview plugin -->
<!--<script src="js/jquery.fileupload-video.js"></script>-->
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
</body>
</html>