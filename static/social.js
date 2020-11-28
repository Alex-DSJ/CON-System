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

function detailPosting(e) {
    let id = e.parent().data('id');
    window.location.href = '../member/posting_template.php?act=view&id=' + id;
}