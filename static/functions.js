// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

// path to the filter
var COMMON_API = '../func/api.php';

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

//show the popup form for adding an admin
function addAdmin(){
    $('#modal-add-admin').modal('show')
}

// update association admin information
// route to api.php and invoke editAdminHandler() to update the admin's info
// go back to the previous page with the updated info
function submitAdminEdit() {
    let admin_username = $('#admin_name_edit').val();
    let admin_password = $('#admin_password_edit').val();
    let admin_building = $('#admin_building_edit').val();
    let id_edit = $('#id_edit').val();

    if (admin_username == '' || admin_password == '' || admin_building == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"edit_admin",
            id:id_edit,
            admin_username:admin_username,
            admin_password:admin_password,
            admin_building:admin_building,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// add an association admin information
// route to api.php and invoke addAdminHandler() to add an admin
// go back to the previous page with the updated info
function submitAdmin() {
    let admin_username = $('#admin_name').val();
    let admin_password = $('#admin_password').val();
    let admin_building = $('#admin_building').val();

    if (admin_username == '' || admin_password == '' || admin_building == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"add_admin",
            admin_username:admin_username,
            admin_password:admin_password,
            admin_building:admin_building,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// delete an association admin information
// route to api.php and invoke delAdminHandler() to delete an admin
// go back to the previous page with the updated info
function delAdmin(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_admin",
            id:id
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// open the popup form for edit an associaiton admin
function editAdmin(e) {
    $('#admin_name_edit').val(e.parent().data('name'))
    $('#admin_password_edit').val(e.parent().data('pass'))
    $('#admin_building_edit').val(e.parent().data('building'))
    $('#id_edit').val(e.parent().data('id'))
    $('#modal-edit-admin').modal('show')
}

// This file is completed by shijun DENG-40084956 individually

var COMMON_API = '../func/api.php'

// invole the popup form for adding a building
function addBuilding(){
    $('#modal-add-building').modal('show')
}

// update the information of a building in the database
// e should include the information of the building's id
function editBuilding(e) {
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#name_edit').val(info.building_name)
    $('#desc_edit').val(info.description)
    $('#address_edit').val(info.address)
    $('#area_edit').val(info.area)
    $('#modal-edit-building').modal('show')
}

// delete a building from the database
// e should include the information of the building's id
function delBuilding(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_building",
            id:id
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// submit the form to add a building to the database
function submitBuilding() {
    let name = $('#name').val();
    let desc = $('#desc').val();
    let address = $('#address').val();
    let area = $('#area').val();

    if (name == '' || desc == '' || address == ''||area == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"add_building",
            name:name,
            desc:desc,
            address:address,
            area:area,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// update a building's information
// route to api.php and invoke editBuildingHandler() to update a bulding's info
// go back to the previous page with the updated info
function submitBuildingEdit() {
    let name = $('#name_edit').val();
    let desc = $('#desc_edit').val();
    let address = $('#address_edit').val();
    let area = $('#area_edit').val();

    if (name == '' || desc == '' || address == ''||area == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"edit_building",
            name:name,
            desc:desc,
            address:address,
            area:area,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            alert(res.msg)
            if(res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

// This file is completed by shijun DENG-40084956 individually

// display the popup form for adding contract
function addContract() {
    $('#modal-add-message').modal('show')
}

// TODO update the contract into the databse

function updateContract() {
    let status = $("#status option:selected").val()
    if (status == '') {
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data: {
            act: "update_contract",
            id: $('#edit_id').val(),
            status: status,
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
            alert(res.msg)
            if (res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error: function () {
            alert('server error')
        }
    })
}

function submitContract()
{
    let content = $('#content').val()
    let title = $('#title').val()
    let status = $("#status option:selected").val()
    if (content == '' || title == '' || status == '') {
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data: {
            act: "add_contract",
            content: content,
            title: title,
            status: status,
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
            alert(res.msg)
            if (res.success == true) {
                window.location.reload()
            } else {
                return false;
            }
        },
        error: function () {
            alert('server error')
        }
    })
}

/* --------********--------********--------********--------********--------********
Functions for the SUPER ADMIN ends here
author: Shijun Deng (40084956)
--------********--------********--------********--------********--------******** */