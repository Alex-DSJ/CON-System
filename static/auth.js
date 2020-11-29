// This file is completed by shijun DENG-40084956 individually

var COMMON_API = '../func/api.php'

// get the username and password
// route to api.php and invoke loginHandler() to verify them
// enter the index.php once it success
function login() {
    console.log('login')
    let username = $('#username').val();
    let password = $('#password').val();
    if(username == '' || password == '') {
        alert('input username and password first')
        return false;
    }
    $.ajax({
        url:COMMON_API,
        data:{
            "act": "login",
            "username": username,
            "password" :password,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                if (res.data.is_first_login*1  === 0) {
                    window.location.href = 'reset_info.php'
                } else {
                    window.location.href = 'index.php'
                }
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// change the password when the super admin login for the first time
// route to api.php and invoke resetHandler() to verify them
// enter the index.php once it success
function resetLoginInfo() {
    console.log('resetLoginInfo')
    let username = $('#username').val();
    let password = $('#password').val();
    if(username == '' || password == '') {
        alert('input username and password first')
        return false;
    }
    $.ajax({
        url:COMMON_API,
        data:{
            "act": "reset",
            "username" : username,
            "password" : password,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.href = 'index.php'
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// logout a user
// route to api.php and invoke logoutHandler() 
// enter the login.php once it success
function logout() {
    $.ajax({
        url:COMMON_API,
        data:{
            act:'logout'
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.href = 'index.php'
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}


