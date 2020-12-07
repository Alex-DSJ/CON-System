<?php
require_once "./func.php";
require_once "./dbQuerry.php";

// call all other php func need 

global $inputs;
$inputs = array_merge($_GET,$_POST);

if (isset($inputs['act'])) {
    $act = $inputs['act'];
    switch ($act) {
        // additional related APIs
        case 'login' : loginHandler($inputs);break;
        case 'member_login' : memberLoginHandler($inputs);break;

        case 'apply_friend' : friendApplyHandler();break;
        case 'apply_group' : friendGroupHandler();break;
        case 'friend_search' : friendSearchHandler();break;
        case 'posting_search' : postingSearchHandler();break;
        case 'group_search' : groupSearchHandler();break;
        case 'disagree_friend_apply' : disAgreeFriendHandler();break;
        case 'agree_friend_apply' : agreeFriendHandler();break;
        case 'add_message' : addMessageHandler();break;
       
        //member related APIs
        case 'add_member' : addMemberHandler();break;
        case 'edit_member' : editMemberHandler();break;
        case 'del_member' : delMemberHandler();break;
        case 'member_condos' : memberCondosHandler();break;
        case 'member_groups' : getMemberGroupInfo();break;
        case 'handle_group_apply' : groupApplyHandler();break;

        // member & owner related APIs
        case 'add_posting' : addPostingHandler();break;
        case 'del_posting' : delPostingHandler();break;
        case 'edit_posting' : editPostingHandler();break;
//        case 'detail_posting' : groupApplyHandler();break;
        case 'add_comment' : addCommentHandler();break;

        // owner(admin) related APIs
        case 'add_condo' : addCondoHandler();break;
        case 'del_condo' : delCondoHandler();break;
        case 'edit_condo' : editCondoHandler();break;
        case 'add_group' : addGroupHandler();break;
        case 'del_group' : delGroupHandler();break;
        case 'edit_group' : editGroupHandler();break;

        // super admin related APIs
        case 'admin_login' : loginHandler($inputs);break;
        case 'logout' : logoutHandler($inputs);break;
        case 'reset' : resetHandler($inputs);break;
        case 'add_admin' : addAdminHandler();break;
        case 'del_admin' : delAdminHandler();break;
        case 'edit_admin' : editAdminHandler();break;
        case 'asg_admin' : assignAdminHandler();break;
        case 'add_building' : addBuildingHandler();break;
        case 'asg_admin' : assignAdminHandler();break;
        case 'del_building' : delBuildingHandler();break;
        case 'edit_building' : editBuildingHandler();break;

        case 'add_contract' : addContractHandler();break;
        case 'update_contract' : updateContractHandler();break;
        case 'del_contract' : delContractHandler();break;
        case 'edit_contract' : editContractHandler();break;

        case 'withdraw_group': withdrawGroupHandler();break;
        case 'unfriend': unfriendHandle();break;
        
        default :
            formatOutput(false, 'unknown action');
    }
} else {
    formatOutput(false, 'error');
}
?>