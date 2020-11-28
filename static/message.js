function addMessage()
{
    $('#modal-add-message').modal('show')
    $(".selectpicker").selectpicker();
}
function submitMessage()
{
    let content = $('#content').val()
    let title = $('#title').val()
    let receiver = $('#receiver').val()
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
            receiver: receiver,
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