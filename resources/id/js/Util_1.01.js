/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function string_of_enum(enumname, value)
{
    for (var k in enumname)
    {
        if (k == value)
            return enumname[k];
    }
    return null;
}
var captcha2_url = "https://captcha2.zing.vn/captcha2";

/**
 * Request a new captcha.
 */
function refreshCaptcha() {

    zm.getJSON(captcha2_url + "/gettoken?publicKey=" + zidtouch.apikey, function (data) {
        zm("#sVerifyImg").attr("src", captcha2_url + "/getcaptcha?publicKey=" + zidtouch.apikey + "&token=" + data.token);
        zm("#tokenCaptcha").val(data.token);
        zm("#sVerifyCode").val("");
    });
}
function trim(str) {
    return str.replace(/^\s+|\s+$/g, '');
}
function checkImageSecurityChars(str, chkAll) {
    var re = /^[a-zA-Z0-9]*$/;
    if (chkAll) {
        re = /^[a-zA-Z0-9]*$/;
    }
    str = trim(str);
    if (str.length != 6) {
        return false;
    }
    var pos = str.search(re);
    if (pos === -1) {
        return false;
    }
    return true;
}
function checkSmsCodeChars(str, chkAll) {
    var re = /^[0-9]*$/;
    if (chkAll) {
        re = /^[0-9]*$/;
    }
    str = trim(str);
    if (str.length != 6) {
        return false;
    }
    var pos = str.search(re);
    if (pos === -1) {
        return false;
    }
    return true;
}
function Util() {

}
Util.addInputErr = function (id, errmes) {

    try {
        var classname = $("#" + id).attr("class");
        $("#" + id).attr("class", classname.replace("error", "") + " error");
        $('#' + id + ' .error_tipmsg').remove();
        var input = $('#' + id + ' input');
        if (input.attr("id") !== "sVerifyCode")
            input.focus();
        $("#" + id).append("<p class='error_tipmsg'>" + errmes + "</p>");
    }
    catch (e) {
    }
}

Util.hideError = function (id) {
    try {
        var classname = $("#" + id).attr("class");
        $("#" + id).attr("class", classname.replace("error", ""));
        $('.error_tipmsg').remove();
    }
    catch (e) {
    }

}
Util.isNotBlank = function (id) {
    var value = $('#' + id + ' .form_input').val();
    if (value === "") {
        Util.addInputErr(id, errMsg.require_err);
        return false;
    }
    return true;

}
Util.isAccountExist = function (acn) {
    var a = "https://id.zing.vn/checkaccount?ACC=" + acn + "&jsonp=Util.isAccountExistCb";
    zm.getJSON(a);
    return false;
}
Util.isAccountExistCb = function (json) {
    if (json['flag'] == 5) {
        return true;
    }
    return false;
}
Util.isNotBlank = function (id) {
    var value = $('#' + id + ' .form_input').val();
    if (value === "") {
        Util.addInputErr(id, errMsg.require_err);
        return false;
    }
    return true;

}
Util.validCaptcha = function () {
    if (zm('#sVerifyCode').val() != undefined)
    {
        var wrap_captcha_id = "wrap_captcha";
        var sVerifyCode = zm('#sVerifyCode').val();
        if (sVerifyCode == '') {
            Util.addInputErr(wrap_captcha_id, errMsg.require_err);
            return false;
        } else if (sVerifyCode.length != 6 || !checkImageSecurityChars(sVerifyCode, true)) {
            Util.addInputErr(wrap_captcha_id, errMsg.Captcha_invalid);
            return  false;
        }
        return true;

    }
    return true;


}