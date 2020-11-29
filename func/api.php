<?php
require_once "./func.php";
require_once "./dbQuerry.php";
require_once "./posting_func.php";
require_once "./condo_func.php";
require_once "./admin_func.php";
require_once "./building_func.php";
require_once "./contract_func.php";

// call all other php func need 

global $inputs;
$inputs = array_merge($_GET,$_POST);

if (isset($inputs['act'])) {
    $act = $inputs['act'];
    switch ($act) {
        case 'login' : loginHandler($inputs);break;
        case 'add_posting' : addPostingHandler();break;
        case 'del_posting' : delPostingHandler();break;
        case 'edit_posting' : editPostingHandler();break;
        case 'detail_posting' : groupApplyHandler();break;
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
        case 'add_building' : addBuildingHandler();break;
        case 'del_building' : delBuildingHandler();break;
        case 'edit_building' : editBuildingHandler();break;
        case 'add_contract' : addContractHandler();break;
        case 'update_contract' : updateContractHandler();break;
        
        
        default :
            formatOutput(false, 'unknown action');
    }
} else {
    formatOutput(false, 'error');
}
?>