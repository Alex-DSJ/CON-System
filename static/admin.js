//show the popup form for adding an admin
function addAdmin(){
    $('#modal-add-admin').modal('show')
}

function submitAdmin(){
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