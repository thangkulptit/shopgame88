
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
function validateInput(input) {
    var re = /([0-9a-zA-Z_]){5,40}/;
    return re.test(String(input).toLowerCase());
}
function validateFullname(input) {
    var re = /^([0-9a-zA-Z_ĂƯÂằắẳẵặăâưàáảãạùúủũụìíỉĩịèéẻẽẹòóỏõọồốổỗộờớởỡợđầấẩẫậẰẮẲẴẶÀÁẢÃẠÙÚỦŨỤÌÍỈĨỊÈÉẺẼẸÒÓỎÕỌỒỐỔỖỘỜỚỞỠỢĐẦẤẨẪẬ ]){2,40}$/;
    return re.test(String(input).toLowerCase());
}

function validatePassword(password) {
    var re = /([0-9a-zA-Z_!@#$%^&*]){5,40}/;
    return re.test(String(password));
}

function rulesCard(input) {
    var re = /^([0-9a-zA-Z]){5,15}$/;
    return re.test(String(input));
}

$(document).ready(function () {

    $("#login-modal").click(function () {
        $("#my-modal-login-register").modal('show');
        $('.nav-tabs a:first').tab('show')
    });
    $("#register-modal").click(function () {
        $("#my-modal-login-register").modal('show');
        $('.nav-tabs a:last').tab('show');
    });
    //login
    $("#btnLogin").click(function () {
        logicLogin();
    });
    $('#password_login').bind('keypress', function(e) {
        if(e.keyCode==13){
            //enter
            logicLogin();
        }
    });

    //register
    $("#btnRegister").click(function () {
        const email = $('#email_register').val();
        const username = $('#username_register').val().toLowerCase();
        const password = $('#password_register').val();
        const fullname = $('#fullname_register').val();

        // if (!validateEmail(email)) {
        //     toastr.error('Lỗi định dạng email !!!', 'Failed');
        //     return;
        // }
        if (!validateInput(username)) {
            toastr.error('Tài khoản phải từ 5-40 ký tự !!!', 'Failed');
            return;
        }
        if (!validatePassword(password)) {
            toastr.error('Mật khẩu phải từ 5-40 ký tự !!!', 'Failed');
            return;
        }
        if (!validateFullname(fullname)) {
            toastr.error('Họ Tên phải từ 2-40 ký tự !!!', 'Failed');
            return;
        }
        ajaxSetup();
        $.ajax({
            url: '/front/register',
            type: 'POST',
            dataType: 'json',
            data: 
                {
                    'username_register': username,
                    'password_register': password,
                    'fullname_register': fullname,
                    'email_register': email,
                },
            success: function (res) {
                if (res.error) {
                    toastr.error(res.msg, 'Failed');
                } else {
                    toastr.success(res.msg);
                    $("#my-modal-login-register").modal('hide');
                    location.reload();
                }
            },
            error: function (res) {
                toastr.error(res.msg, 'Lỗi hệ thống');
            }
        });
    });
});

$(document).ready(function() {
    $('#btnComment').click(function() {
        $('html, body').animate({
            scrollTop: $(".inbox_chat").offset().top
        }, 800);
    })
});

function logicLogin() {
    const username = $('#username_login').val().toLowerCase();
    const password = $('#password_login').val();
    if (!validateInput(username) || !validatePassword(password)) {
        toastr.error('Tài khoản hoặc mật khẩu không đúng định dạng!', 'Lỗi');
        return;
    }
    ajaxSetup();
    $.ajax({
        url: '/front/login',
        type: 'POST',
        dataType: 'json',
        data: {
            'username_login': $('#username_login').val(),
            'password_login': $('#password_login').val()
        },
        success: function (res) {
            if (res.error) {
                toastr.error(res.msg, 'Lỗi');
            } else {
                toastr.success(res.msg);
            }
            if (res.status === 'success') {
                window.location.href = "/";
            }
        },
        error: function (res) {
            toastr.error(res.msg, 'Lỗi hệ thống');
        }
    });
}

function validateCard(type, seri, code) {
    if (!seri || !code || !type) {
        return false;
    }
    if (!rulesCard(seri) || !rulesCard(code)) {
        return false;
    }
    let isValid = false;
    switch(type) {
        case 'VIETTEL':
            if (seri.length === 11 && code.length === 13) {
                isValid = true;
            } else if (seri.length === 14 && code.length === 15) {
                isValid = true;
            }
            break;
        case 'VINAPHONE':
            if (seri.length === 14 && code.length === 12) {
                isValid = true;
            } else if (seri.length === 14 && code.length === 14) {
                isValid = true;
            }
            break;
        case 'ZING':
            isValid = true;
            break;
        case 'MOBIFONE':
            if (seri.length === 15 && code.length === 12) {
                isValid = true;
            } 
            break;
        case 'GATE':
            isValid = true;
            break;
    }
    return isValid;
}

var dblStop = false;

$(document).ready(function () {
    
    $('#submit-card').click(function(){
        if (dblStop == true) {
            return;
        }
        const type = $('#type_card').val();
        const amount = $('#amount').val();
        const seri = $('#seri').val();
        const code = $('#code').val();
        if (!validateCard(type, seri, code)) {
            toastr.warning('Thẻ không hợp lệ vui lòng kiểm tra lại thẻ!');
            return;
        }
        swal({
            title: "Bạn chắc chắn là đã đúng Mệnh Giá, Mã Thẻ, Seri ?",
            text: "Lời khuyên: Nên kiểm tra lại Mệnh Giá Thẻ lần cuối, vì sai mệnh giá sẽ bị mất thẻ.",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
          },
          function(){
            pushCardToServer(type, amount, seri, code);
            dblStop = true;
            setTimeout(function() {
                dblStop = false;
            }, 3000)
        });
    });
});


function pushCardToServer(type, amount, seri, code) {
    ajaxSetup();
    $.ajax({
        type: "POST",
        url: "/account/cardv1",
        data: {
            'type' : type,
            'amount': amount,
            'seri': seri,
            'code': code
        },
        dataType: "json",
        success: function (res) {
            if (!res.isLoggedIn) {
                toastr.error(res.msg);
                $("#my-modal-login-register").modal('show');
                $('.nav-tabs a:first').tab('show')
                return;
            } 
            if (res.error) {
                toastr.error(res.msg);
            }

            if (!res.error && res.status === 'success' && res.isLoggedIn) {
                swal({
                    title: 'Thông báo',
                    type: 'success',
                    text: 'Mệnh giá '+ res.amount + 'VNĐ đã được gửi lên ADMIN ! Vui lòng đợi duyệt thẻ khoảng 30 giây.'
                }, function() {
                    setTimeout(function() {
                        location.reload();
                    }, 5000)
                });

            } 
        }
    });
}
