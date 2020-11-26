<?php
require_once dirname(__FILE__)."./dbQuerry.php";
function getPostingList()
{
    // dynamic member id after [getLogin()['mid']]
    return getAll("select b.* from member_posting a inner join posting b on a.posting_id = b.id  where a.member_id = ?", [3]);
}

function getPostingInfo($id = 0)
{
    // dynamic posting id after 
    return getOne("select b.* from member_posting a inner join posting b on a.posting_id = b.id  where a.posting_id = ?", [7]);
}


function delPostingHandler()
{
    global $inputs;
    $sql = "delete from `posting` where id = " . 7;
    execSql($sql);
    formatOutput(true, 'delete success');
}

function addPostingHandler()
{
    global $inputs;

    $src = uploadFile();

    $lastId = insert('posting',[
        'pic' => $src,
        'title' => $inputs['title'],
        'content' => $inputs['content'],
    ]);

    insert('member_posting', [
        'posting_id' => $lastId,
        'member_id' => 3
    ]);

    formatOutput(true, 'add success',$lastId);
}

function editPostingHandler()
{
    global $inputs;

    if (!empty($_FILES) && $_FILES['fileToUpload']['name']) {
        $src = uploadFile();
        $lastId = updateDb('posting',[
            'pic' => $src,
            'title' => $inputs['title'],
            'content' => 3
        ], [
            "id" => $inputs['id']
        ]);
    } else {
        $lastId = updateDb('posting',[
            'title' => $inputs['title'],
            'content' => $inputs['content'],
        ], [
            "id" => $inputs['id']
        ]);
    }

    formatOutput(true, 'update success',$inputs['id']);
}
?>