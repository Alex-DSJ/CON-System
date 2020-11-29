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