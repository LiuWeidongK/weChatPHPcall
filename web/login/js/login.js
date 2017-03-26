/**
 * Created by Misaya on 2017/3/11.
 */
Messenger.options = {
    extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
    theme: 'air'
};

//register
$(document).ready(function () {
    //注册ajax
    $('#modalLRegBtn').click(function () {
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/registerServ.php',
            data: $('#registerForm').serialize(),
            success: function (data) {
                if(data=="true") {
                    Messenger().post({message: 'Success', type: 'success', showCloseButton: true});
                    $('#registerModal').modal('hide');
                }else Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
            }
        })
    });

    //登录ajax
    $('#signIn').click(function () {
        $.ajax({
            type: 'POST',
            url: '../../server/webServer/loginServ.php',
            data: $('#loginForm').serialize(),
            success: function (data) {
                if(data=="true") {
                    location.href = "../index/index.php";
                }else Messenger().post({message: 'Fail', type: 'error', showCloseButton: true});
            }
        })
    });
});
