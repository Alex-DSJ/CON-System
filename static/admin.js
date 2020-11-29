// This file is completed by shijun DENG-40084956 individually

var COMMON_API = '../func/api.php';

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