<?php
// session_start();
require_once dirname(__FILE__)."./dbQuerry.php";

function getMemberGroupList()
{
    return getAll("select b.group_name,b.id from member_group a inner join `group` b on a.group_id = b.id where a.member_id =?", [getLogin()['mid']]);
}

function getMailList()
{
    return getAll("select id,`email` from `member` where id != ?", [getLogin()['mid']]);

}

function getInboxMessage()
{
    $sql = "select * from `mail` where receiver_id = ?";
    // to change with member id
    return getAll($sql, 2);
}

function getSentboxMessage()
{
    $sql = "select * from `mail` where sender_id = ?";
     // to change with member id
    return getAll($sql, 2);
}
?>