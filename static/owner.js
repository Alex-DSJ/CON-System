// --------********--------********--------********--------********--------********
// Functions for the OWNER/ADMIN starts here
// author: saebom SHIN-40054234
// --------********--------********--------********--------********--------********

// function log in/out for owner page shares with functions.js file.

//show the popup form for adding a condo
function addCondo() {
    $('#modal-add-condo').modal('show')
}

// delete an condo information
// route to api.php and invoke delCondoHandler() to delete a condo
// go back to the previous page with the updated info
function delCondo(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_condo",
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

// open the popup form for edit a condo
function editCondo(e) {
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#id_edit').val(info.id)
    $('#name_edit').val(info.name)
    $('#area_edit').val(info.area)
    $('#cost_edit').val(info.cost)
    $('#modal-edit-condo').modal('show')
}

// submit the form to add condo information to the database
function submitCondo() {
    let name = $('#name').val();
    let area = $('#area').val();
    let cost = $('#cost').val();

    if (name == '' || area == '' || cost == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"add_condo",
            name:name,
            cost:cost,
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

function submitCondoEdit() {
    let name = $('#name_edit').val();
    let area = $('#area_edit').val();
    let cost = $('#cost_edit').val();

    if (name == '' || area == '' || cost == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"edit_condo",
            id:$('#id_edit').val(),
            name:name,
            cost:cost,
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

/* group category*/
//show the popup form for adding a group of owner
function addGroup() {
    $('#modal-add-group').modal('show')
}

// delete a group from the database
// e should include the information of the group's id
function delGroup(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_group",
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

// open the popup form for edit a group
function editGroup(e) {
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#name_edit').val(info.group_name)
    $('#desc_edit').val(info.description)
    $('#id_edit').val(info.id)
    $('#modal-edit-group').modal('show')
}

// submit the form to add a group to the database
function submitGroup() {
    let name = $('#name').val();
    let desc = $('#desc').val();

    if (name == '' || desc == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"add_group",
            name:name,
            desc:desc,
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

// update a group's information
// route to api.php and invoke editGroupHandler() to update a group's info
// go back to the previous page with the updated info
function submitGroupEdit() {
    let name = $('#name_edit').val();
    let desc = $('#desc_edit').val();

    if (name == '' || desc == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"edit_group",
            id: $('#id_edit').val(),
            name:name,
            desc:desc,
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
/*index*/
//show the popup form for adding a member of owner
function addMember() {
    $('#modal-add-member').modal('show')
}

// delete a member of the owner from the database
// e should include the information of the member's id
function delMember(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_member",
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

// edit a member info
function editMember(e) {
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#id_edit').val(info.id)
    $('#name_edit').val(info.name)
    $('#password_edit').val(info.password)
    $('#address_edit').val(info.address)
    $('#email_edit').val(info.email)
    $('#family_edit').val(info.family)
    $('#colleagues_edit').val(info.colleagues)
    $('#privilege_edit').val(info.privilege)
    $('#status_edit').val(info.status)

    let condos = getCondos(info.id)
    if (condos) {
        var selectCondos = []
        $.each(condos,function (k,item) {
            selectCondos.push(item.id)
        })
        $('#condos_edit').val(selectCondos)
    }

    $('#modal-edit-member').modal('show')
}

// submit the form to add member of owners to the database
function submitMember() {
    let name = $('#name').val();
    let password = $('#password').val();
    let address = $('#address').val();
    let email = $('#email').val();
    let family = $('#family').val();
    let colleagues = $('#colleagues').val();
    let privilege = $('#privilege').val();
    let status = $('#status').val();
    let condos = $('#condos').val();

    if (name == '' || password == '' || address == '' || email == '' || !condos) {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"add_member",
            name:name,
            password:password,
            address:address,
            email:email,
            family:family,
            colleagues:colleagues,
            privilege:privilege,
            status:status,
            condos:condos,
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

// update a member's information
// route to api.php and invoke editMemberHandler() to update a member's info
// go back to the previous page with the updated info
function submitMemberEdit() {
    let name = $('#name_edit').val();
    let password = $('#password_edit').val();
    let address = $('#address_edit').val();
    let email = $('#email_edit').val();
    let family = $('#family_edit').val();
    let colleagues = $('#colleagues_edit').val();
    let privilege = $('#privilege_edit').val();
    let status = $('#status_edit').val();
    let condos = $('#condos_edit').val();

    if (name == '' || password == '' || address == '' || email == '' ) {
        alert('params err');
        return false;
    }

    $.ajax({
        url:COMMON_API,
        data:{
            act:"edit_member",
            id:$('#id_edit').val(),
            password:password,
            name:name,
            address:address,
            email:email,
            family:family,
            colleagues:colleagues,
            privilege:privilege,
            status:status,
            condos:condos,
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

/*login*/
// get the username and password
// route to api.php and invoke loginHandler() to verify them
// enter the index.php once it success
function admin_login() {
    console.log('admin_login')
    let username = $('#username').val();
    let password = $('#password').val();
    if(username == '' || password == '') {
        alert('input username and password first')
        return false;
    }
    $.ajax({
        url:COMMON_API,
        data:{
            "act": "admin_login",
            "username": username,
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
/*posting related functionalities are seperated by the its name*/
/* --------********--------********--------********--------********--------********
Functions for the OWNER/ADMIN ends here
author: saebom SHIN-40054234
--------********--------********--------********--------********--------******** */