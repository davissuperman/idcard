/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
        maxFileSize: 2000000, // 2MB
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        dataType: 'json',
        autoUpload: true,
        user_dirs:true,
        url: '/idcard/server/php/index.php?orderid='+$("#orderid").val(),
        change: function (e, data) {
            $(".wait").html('等待身份证审核');
        }
    });

//    if($(".preview").html())

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
                if(result['files'] != ''){
                    $(".wait").html("等待身份证审核");
                }

            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });

//    if($(".files").html() != ''){
//        $(".wait").html("here");
//    }
});
