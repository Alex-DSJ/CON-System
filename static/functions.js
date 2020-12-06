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
function submitContractEdit() {
    let status = $("#status_edit option:selected").val()
    let title = $('#title_edit').val();
    let content = $('#content_edit').val();
    if (status == '') {
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data: {
            act: "update_contract",
            id: $('#id_edit').val(),
            title: title,
            content: content,
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
function delContract(e) {
    let id = e.parent().data('id');
    $.ajax({
        url:COMMON_API,
        data:{
            act:"del_contract",
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
function editContract(e) {

    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#id_edit').val(info.id)
    $('#title_edit').val(info.title)
    $('#status_edit').val(info.status)
    $('#content_edit').val(info.content)

    $('#modal-edit-message').modal('show')

}

/* --------********--------********--------********--------********--------********
Functions for the SUPER ADMIN ends here
author: Shijun Deng (40084956)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the CONDO starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */
function addCondo() {
    $('#modal-add-condo').modal('show')
}

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

/* --------********--------********--------********--------********--------********
Functions for the CONDO ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the GROUP start here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */
function addGroup() {
    $('#modal-add-group').modal('show')
}

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

function editGroup(e) {
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $('#name_edit').val(info.group_name)
    $('#desc_edit').val(info.description)
    $('#id_edit').val(info.id)
    $('#modal-edit-group').modal('show')
}

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
function handleApply(e,type)
{
    let info = e.parent().data('info')
    info = JSON.parse(decodeURIComponent(info))
    console.log(info)
    $.ajax({
        url:COMMON_API,
        data:{
            act:"handle_group_apply",
            id:info.id,
            type:type,
        },
        dataType:'json',
        type:'post',
        success:function (res) {
            if(res.success == true) {
                window.location.reload()
            } else {
                alert(res.msg)
                return false;
            }
        },
        error:function () {
            alert('server error')
        }
    })
}

/* --------********--------********--------********--------********--------********
Functions for the GROUP ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the MEMBER starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

function addMember() {
    $('#modal-add-member').modal('show')
}

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

/* --------********--------********--------********--------********--------********
Functions for the MEMBER ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the OWNER/LOGIN starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */
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

/* --------********--------********--------********--------********--------********
Functions for the OWNER/LOGIN ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the POSTING starts here
author: kimchhengheng (26809413)_saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */
function savePosting(act = 'add_posting') {
    let title = $('#title').val();
    let content = $('#content').val();
    let status = $('#status').val();

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
            content: content,
            status: status
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

function delPosting(e) {
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
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
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
function detailPostingGuest(e) {
    let id = e.parent().data('id');
    window.location.href = './posting_tmpl.php?act=view&id=' + id;
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
Functions for the POSTING ends here
author: kimchhengheng (26809413)_saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

//member
function member_login() {
    console.log('member_login')
    let username = $('#username').val();
    let password = $('#password').val();
    if(username == '' || password == '') {
        alert('input username and password first')
        return false;
    }
    $.ajax({
        url:COMMON_API,
        data:{
            "act": "member_login",
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
        error:function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText);
        }
    })
}

//social
function searchFriend()
{
    let friend_keyword = $('#friend_keyword').val()
    if (friend_keyword == '' ) {
        return false;
    }
    $.ajax({
        url: COMMON_API,
        data: {
            act: "friend_search",
            keyword: friend_keyword
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
            console.log(res)
            var t = ''
            $.each(res.data,function (k,item) {
                t += `<tr><td>${ item.id }</td><td>${ item.name }</td><td>${ item.email }</td><td data-id="${ item.id }"><button class="btn btn-primary apply-friend btn-sm">apply</button></td></tr>`
            })
            $('#friend-search-container').empty().append(t)
        },
        error: function () {
            alert('server error')
        }
    })
}

function searchPosting()
{
    let posting_keyword = $('#posting_keyword').val()
    if (posting_keyword == '' ) {
        return false;
    }
    $.ajax({
        url: COMMON_API,
        data: {
            act: "posting_search",
            keyword: posting_keyword
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
            var t = ''
            $.each(res.data,function (k,item) {
                t += `  <tr><td>${ item.id }</td><td>${ item.title }</td><td>${ item.name }</td><td>${ item.create_time }</td><td data-id="${ item.id }"><button class="btn btn-primary btn-sm" onclick="detailPosting($(this))">detail</button></td></tr>`
            })
            $('#posting-search-container').empty().append(t)
        },
        error: function () {
            alert('server error')
        }
    })
}
function searchGroup() {
    let group_keyword = $('#group_keyword').val()
    if (group_keyword == '' ) {
        return false;
    }
    $.ajax({
        url: COMMON_API,
        data: {
            act: "group_search",
            keyword: group_keyword
        },
        dataType: 'json',
        type: 'post',
        success: function (res) {
            console.log(res)
            var t = ''
            $.each(res.data,function (k,item) {
                t += `<tr><td>${ item.id }</td><td>${ item.group_name }</td><td>${ item.description }</td><td data-id="${ item.id }"><button class="btn btn-primary apply-group btn-sm">apply</button></td></tr>`
            })
            $('#group-search-container').empty().append(t)
        },
        error: function () {
            alert('server error')
        }
    })
}

//social

//message
function addMessage()
{
    $('#modal-add-message').modal('show')
    $(".selectpicker").selectpicker();
}
function submitMessage()
{
    let content = $('#content').val();
    let title = $('#title').val();
    let receiver = $('#receiver').val().split(":");
    let receiverId=receiver[0];
    let receiverEmail = receiver[1];
    alert(receiverId+"\t"+receiverEmail);
    if (content == '' || title == '' || receiver == '') {
        return false;
    }

    $.ajax({
        url: COMMON_API,
        data: {
            act: "add_message",
            id: $('#id').val(),
            content: content,
            title: title,
            receiverId: receiverId,
            receiverEmail:receiverEmail
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
//message

/* --------********--------********--------********--------********--------********
Functions for the Member End Here
--------********--------********--------********--------********--------******** */

function withdraw(e) {
    let id = e.parent().data('id')
    $.ajax({
        url: COMMON_API,
        data: {
            act: "withdraw_group",
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
function unfriend(e) {
    let id = e.parent().data('id');
    alert("unfriend");
    $.ajax({
        url: COMMON_API,
        data: {
            act: "unfriend",
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

$(function () {
    $('body').on('click', '.show-condos', function () {
        let id = $(this).data('id')
        console.log(id)
        var res = getCondos(id)
        var t = ''
        $.each(res, function (k, item) {
            t += `<tr><td>${item.name}</td></tr>`
        })
        $('#condos-contanier').empty().append(t)
        $('#modal-condos').modal('show')
    })

    $('body').on('click', '.show-groups', function () {
        let id = $(this).data('id')
        console.log(id)
        var res = getGroups(id)
        var t = ''
        $.each(res, function (k, item) {
            t += `<tr><td>${item.group_name}</td></tr>`
        })
        $('#condos-contanier').empty().append(t)
        $('#modal-condos').modal('show')
    })

    $('body').on('click', '.apply-friend', function () {
        let id = $(this).parent().data('id')
        console.log(id)
        $.ajax({
            url: COMMON_API,
            data: {
                act: "apply_friend",
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
    })

    $('body').on('click', '.apply-group',function () {
        let id = $(this).parent().data('id')
        $.ajax({
            url: COMMON_API,
            data: {
                act: "apply_group",
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
    })

    $('body').on('click','.comment',function () {
        let id = $(this).data('id')
        $('#id_comment_edit').val(id)
        $('#modal-add-comment').modal('show')
    })

    $('body').on('click','.disagree-friend',function () {
        let id = $(this).parent().data('id')
        $.ajax({
            url: COMMON_API,
            data: {
                act: "disagree_friend_apply",
                id: id,
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
    })

    $('body').on('click','.agree-friend',function () {
        let id = $(this).parent().data('id');
        $.ajax({
            url: COMMON_API,
            data: {
                act: "agree_friend_apply",
                id: id,
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
    })

})