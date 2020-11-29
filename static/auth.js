// login a user
function login() {
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
            "username" : username,
            "password" : password,
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

//logout a user
function logout(){
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
            "act" : "reset",
            "username" : username,
            "password" :password,
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