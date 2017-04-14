$(function() {
    $('.versionform').validate({
        event: "keyup",
        rules: {
            version_code: { required: true },
            version_apkname: { required: true },
            version_detail: { required: true },
            file: { required: true }
        },
        messages: {
            version_code: { required: "必填" },
            version_apkname: { required: "必填" },
            version_detail: { required: "必填" },
            file: { required: "必填" }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parent());
        }
    });

    $('.updateform').validate({
        event: "keyup",
        rules: {
            version_code: { required: true },
            version_detail: { required: true }
        },
        messages: {
            version_code: { required: "必填" },
            version_detail: { required: "必填" }
        },
        errorPlacement: function(error, element) {
            error.appendTo(element.parent());
        }
    });
});

function checkfile() {
    var obj = $("#apkfile");
    var filedir = obj.val();
    var fileext = filedir.substring(filedir.lastIndexOf('.')).toLowerCase();
    var filesize = obj.filesize;
    if (fileext !== ".apk") {
        alert('文件格式须为apk格式');
        obj.val('');
    }
}