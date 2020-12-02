// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

// path to the filter
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
    $('#id_edit').val(info.id)
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
    let id = $('#id').val();
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
            id: id,
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
        error:function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        }
    })
}

// update a building's information
// route to api.php and invoke editBuildingHandler() to update a bulding's info
// go back to the previous page with the updated info
function submitBuildingEdit() {
    let id = $('#id_edit').val();
    let name = $('#name_edit').val();
    let desc = $('#desc_edit').val();
    let address = $('#address_edit').val();
    let area = $('#area_edit').val();

    if (name == '' || desc == '' || address == ''||area == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data:{
            act:"edit_building",
            id: id,
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
        error:function (jqXHR, textStatus, errorThrown) {
            // error detail
            alert(jqXHR.responseText);
            // alert(jqXHR.status);
            // alert(jqXHR.readyState);
            // alert(jqXHR.statusText);
            // alert(textStatus);
            // alert(errorThrown);
        }
    })
}

function submitBuildingEdit1() {
    let id = $('#id_edit').val();;
    let name = $('#name_edit').val();
    let desc = $('#desc_edit').val();
    let address = $('#address_edit').val();
    let area = $('#area_edit').val();

    if (name == '' || desc == '' || address == ''||area == '') {
        alert('params err');
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data:{
            act:"edit_building",
            id: id,
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
        error:function (jqXHR, textStatus, errorThrown) {
            // error detail
            alert(jqXHR.responseText);
            // alert(jqXHR.status);
            // alert(jqXHR.readyState);
            // alert(jqXHR.statusText);
            // alert(textStatus);
            // alert(errorThrown);
        }
    })
}

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
/*posting related functionalities are seperated by POSTING section following*/
/* --------********--------********--------********--------********--------********
Functions for the OWNER/ADMIN ends here
author: saebom SHIN-40054234
--------********--------********--------********--------********--------******** */

// --------********--------********--------********--------********--------********
// Functions for POSTING starts here
// author: saebom SHIN-40054234 / kimchhengheng-26809413
// --------********--------********--------********--------********--------********

function savePosting(act = 'add_posting') {
    let title = $('#title').val();
    let content = $('#content').val()

    if (title == '' || content == '') {
        alert('params err')
        return false;
    }

    $.ajaxFileUpload({
        url: COMMON_API,
        secureuri: false,
        data: {
            act: act,
            id: $('#id_edit').val(),
            title: title,
            content: content
        },
        fileElementId: 'fileToUpload',
        dataType: 'json',
        success: function (response) {
            console.log(response)

            if (response.success == false) {
                return false;
            } else {
                window.location.href = '../member/posting_templ.php?act=view&id=' + response.data;
            }
        },
        error: function (data, status, e) {
            alert(e);
        }
    })
}

function delPosting() {
    let id = e.parent().data('id');
    $.ajax({
        url: COMMON_API,
        data: {
            act: "del_posting",
            id: id
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

function editPosting(e) {
    let id = e.parent().data('id');
    window.location.href = '../member/posting_templ.php?act=edit&id=' + id;
}

function detailPosting(e) {
    let id = e.parent().data('id');
    window.location.href = '../member/posting_templ.php?act=view&id=' + id;
}

function detailPostingOwner(e) {
    let id = e.parent().data('id');
    window.location.href = '../owner/posting_tmpl.php?act=view&id=' + id;
}

function submitComment()
{
    let content = $('#comment_content').val();
    let posting_id = $('#id_comment_edit').val();
    $.ajax({
        url: COMMON_API,
        data: {
            act: "add_comment",
            content: content,
            id: posting_id,
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
           alert(res.msg)
            window.location.reload()
        },
        error: function () {
            alert('server error')
        }
    })
}

/* --------********--------********--------********--------********--------********
Functions for the OWNER/ADMIN ends here
author: saebom SHIN-40054234 / kimchhengheng-26809413
--------********--------********--------********--------********--------******** */

