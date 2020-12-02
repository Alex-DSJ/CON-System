<?php
// session_start();
require_once dirname(__FILE__)."./dbQuerry.php";

function getSuggestFriend()
{
    return getAll("select a.name,a.email from member a 
where a.id != ? and a.id not in (select apply_member_id from member_friend_apply where status = 0)
limit 5",
        [getLogin()['mid']]
    );
}
function getSuggestPosting()
{
    return getAll("select a.*,c.name from posting a 
inner join member_posting b on a.id = b.posting_id
inner join member c on c.id = b.member_id
limit 5");
}


function friendSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.name,a.email from member a 
where a.name like '%$keyword%' and a.id not in (select apply_member_id from member_friend_apply where status = 0)"
    );
    formatOutput(true, 'success',$res);
}

function postingSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.*,c.name from posting a 
inner join member_posting b on a.id = b.posting_id
inner join member c on c.id = b.member_id where a.title like '%$keyword%' or a.content like '%$keyword%'");
    formatOutput(true, 'success',$res);
}

function groupSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select * from `group` where group_name like '%$keyword%' or description like '%$keyword%'");
    formatOutput(true, 'success',$res);
}

?>
