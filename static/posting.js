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
                window.location.href = '../member/posting_tmpl.php?act=view&id=' + response.data;
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
    window.location.href = '../member/posting_tmpl.php?act=edit&id=' + id;
}

function detailPosting(e) {
    let id = e.parent().data('id');
    window.location.href = '../member/posting_tmpl.php?act=view&id=' + id;
}