// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

// path to the filter
var COMMON_API = '../func/api.php'

// login a user
function login() {
  console.log('login')
  let username = $('#username').val();
  let password = $('#password').val();
  if(username == '' || password == '') {
    alert('input username and password first');
    return false;
  }
  if(username != "admin"){
    alert('Super Admin authorization only');
    return false;
  }

  $.ajax({
    url:COMMON_API,
    data:{
        "act": "login",
        "username": username,
        "password" :password,
    },
    dataType:'JSON',
    type:'POST',
    success:function (res) {
      alert(res.msg)
      if(res.success == true) {
        if (res.data.is_first_login*1  === 0) {
          window.location.href = 'reset_info.php'
        } 
        else {
          window.location.href = 'index.php'
        }
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

// change the password when the super admin login for the first time
function resetLoginInfo() {
  console.log('resetLoginInfo')
  let username = $('#username').val();
  let password = $('#password').val();
  if(username == '' || password == '') {
    alert('input username and password first')
    return false;
  }

  $.ajax({
    url:COMMON_API,
    data:{
        "act": "reset",
        "username" : username,
        "password" : password,
    },
    dataType:'json',
    type:'post',
    success:function (res) {
      alert(res.msg)
      if(res.success == true) {
        window.location.href = 'index.php'
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

// logout a user
function logout() {
  $.ajax({
    url:COMMON_API,
    data:{
      act:'logout'
    },
    dataType:'json',
    type:'post',
    success:function (res) {
      alert(res.msg)
      if(res.success == true) {
        window.location.href = 'index.php'
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

//show the popup form for adding an admin
function addAdmin(){
    $('#modal-add-admin').modal('show')
}

// update association admin information
function submitAdminEdit() {
  let admin_username = $('#admin_name_edit').val();
  let admin_password = $('#admin_password_edit').val();
  let admin_building = $('#admin_building_edit').val();
  let id_edit = $('#id_edit').val();

  if (admin_username == '' || admin_password == '' || admin_building == '') {
      alert('ERROR! All parameters need to be filled.');
      return false;
  }

  $.ajax({
    url:COMMON_API,
    data:{
        act:"edit_admin",
        id:id_edit,
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
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

// add an association admin information
function submitAdmin() {
  let admin_username = $('#admin_name').val();
  let admin_password = $('#admin_password').val();
  let admin_building = $('#admin_building').val();

  if (admin_username == '' || admin_password == '' || admin_building == '') {
    alert('ERROR! All parameters need to be filled.');
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
    dataType:'JSON',
    type:'POST',
    success:function (res) {
        alert(res.msg)
        if(res.success == true) {
            window.location.reload()
        } else {
            return false;
        }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

// delete an association admin information
function delAdmin(e) {
  let id = e.parent().data('id');
  $.ajax({      url:COMMON_API,
    data:{
        act:"del_admin",
        id:id
    },
    dataType:'JSON',
    type:'POST',
    success:function (res) {
        alert(res.msg)
        if(res.success == true) {
            window.location.reload()
        } else {
            return false;
        }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  });
}

// open the popup form for edit an associaiton admin
function editAdmin(e) {
  $('#admin_name_edit').val(e.parent().data('name'))
  $('#admin_password_edit').val(e.parent().data('pass'))
  $('#admin_building_edit').val(e.parent().data('building'))
  $('#id_edit').val(e.parent().data('id'))
  $('#modal-edit-admin').modal('show')
}

// invoke the popup form for adding a building
function addBuilding(){
  $('#modal-add-building').modal('show')
}

//invoke the popup form for assign an admin
function assignAdmin(e){
  let info = e.parent().data('info')
  info = JSON.parse(decodeURIComponent(info))
  $('#id_asg').val(info.id)
  $('#name_asg').val(info.building_name)    
  $('#modal-assign-admin').modal('show')
}


// update the information of a building in the database
function editBuilding(e) {
  let info = e.parent().data('info')
  info = JSON.parse(decodeURIComponent(info))
  $('#id_edit').val(info.id)
  $('#name_edit').val(info.building_name)
  $('#desc_edit').val(info.description)
  $('#address_edit').val(info.address)
  $('#area_edit').val(info.area)
  $('#modal-edit-building').modal('show')
}

// delete a building from the database
// e should include the information of the building's id
function delBuilding(e) {
  console.log(e);
  let id = e.parent().data('id');
  $.ajax({
    url:COMMON_API,
    data:{
        act:"del_building",
        id:id
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
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
  }
  })
}

// submit the form to add a building to the database
function submitBuilding() {
  let id = $('#id').val();
  let name = $('#name').val();
  let desc = $('#desc').val();
  let address = $('#address').val();
  let area = $('#area').val();

  if (name == '' || desc == '' || address == ''||area == '') {
    alert('params err');
    return false;
  }

  $.ajax({
    url:COMMON_API,
    data:{
        act:"add_building",
        id: id,
        name:name,
        desc:desc,
        address:address,
        area:area,
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
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

// assign a building to an admin
function submitAdminAssignment(e){
  let selectTag = document.getElementsByClassName('form-control')[6];
  let selectedIndex = document.getElementsByClassName('form-control')[6].selectedIndex;
  let admin_id = selectTag.options[selectedIndex].value;
  let building_id = $('#id_asg').val();

  if (admin_id == ''){
    alert('No admin is selected, operation cancelled.');
    return false;
  }

  $.ajax({
    url:COMMON_API,
    data:{
        act:"asg_admin",
        building: building_id,
        admin : admin_id
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
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

// update a building's information
function submitBuildingEdit() {
  let id = $('#id_edit').val();
  let name = $('#name_edit').val();
  let desc = $('#desc_edit').val();
  let address = $('#address_edit').val();
  let area = $('#area_edit').val();

  if (name == '' || desc == '' || address == ''||area == '') {
    alert('params err');
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data:{
        act:"edit_building",
        id: id,
        name:name,
        desc:desc,
        address:address,
        area:area,
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
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

// display the popup form for adding contract
function addContract() {
    $('#modal-add-contract').modal('show')
}

// add a contract to the database by the super admin
function submitContractBySA() {
  let content = $('#content').val()
  let title = $('#title').val()
  let status = $("#status option:selected").val()
  let role = $("#creator :selected").parent().attr('label');
  let name = $("#creator :selected").text();
  let id = $("#creator :selected").val();
  
  if (content == '' || title == '' || status == '') {
    alert("ERROR! All parameters need to be filled.");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
        act: "sadmin_add_contract",
        content: content,
        title: title,
        status: status,
        role: role,
        name: name,
        id: id,
    },
    dataType: 'JSON',
    type: 'POST',
    success: function (res) {
        alert(res.msg)
        if (res.success == true) {
            window.location.reload()
        } else {
            return false;
        }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// display the popup form for editing contract from the super admin
function editContractBySA(e) {
  let info = e.parent().data('info')
  info = JSON.parse(decodeURIComponent(info))
  $('#id_edit').val(info.id)
  $('#title_edit').val(info.title)
  $('#status_edit').val(info.status)
  $('#content_edit').val(info.content)
  $('#modal-edit-contract').modal('show')
}

// update a contract by the super admin
function updateContractBySA() {
  let content = $('#content_edit').val()
  let title = $('#title_edit').val()
  let status = $("#status_edit option:selected").val()
  let role = $("#creator_edit :selected").parent().attr('label');
  let creator_id = $("#creator_edit :selected").val();
  let id = $('#id_edit').val()

  $.ajax({
    url: COMMON_API,
    data: {
        act: "sadmin_update_contract",
        id: id,
        title: title,
        content: content,
        status: status,
        creator_id: creator_id,
        role: role,
    },
    dataType: 'JSON',
    type: 'POST',
    success: function (res) {
      alert(res.msg)
      if (res.success == true) {
        window.location.reload()
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

// add condo information with associated building
function submitCondo1() {
  let selectTag = document.getElementById('building');
  let sIndex = selectTag.selectedIndex;
  let building_id = parseInt(selectTag.options[sIndex].value);
  let name = $("#name").val();
  let area = $("#area").val();
  let cost = $("#cost").val();

  if (name == "" || area == "" || cost == "") {
    alert("ERROR! All parameters need to be filled.");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_add_condo",
      building_id: building_id,
      name: name,
      cost: cost,
      area: area,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// add condo information which is edited.
function submitCondoEdit1() {
  let buildingTag = document.getElementById('building_edit');
  let sIndex = buildingTag.selectedIndex;
  let idString = buildingTag.options[sIndex].value;
  let building_id = parseInt(idString);
  let id = $("#id_edit").val();
  let name = $("#name_edit").val();
  let area = $("#area_edit").val();
  let cost = $("#cost_edit").val();

  if (building == "" || name == "" || area == "" || cost == "") {
    alert("ERROR! All parameters are needed to be filled.");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_edit_condo",
      id: id, 
      building_id : building_id,
      name: name,
      cost: cost,
      area: area,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// add a member to the database by the super admin
function submitMemberBySA() {
  let name = $("#name").val();
  let password = $("#password").val();
  let address = $("#address").val();
  let email = name + "@con.com";
  let family = $("#family").val();
  let colleagues = $("#colleagues").val();
  let privilege = $("#privilege").val();
  let status = $("#status").val();
  let condo_id = $("#condo option:selected").val();

  if (name == "" || password == "" || address == "" || condo_id == "") {
    alert("ERROR! All * parameters need to be filled");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_add_member",
      name: name,
      password: password,
      address: address,
      email: email,
      family: family,
      colleagues: colleagues,
      privilege: privilege,
      status: status,
      condo_id: condo_id,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// update a member by the super admin
function submitMemberEditBySA() {
  let id = $("#id_edit").val();
  let name = $("#name_edit").val();
  let password = $("#password_edit").val();
  let address = $("#address_edit").val();
  let email = name + "@con.com";
  let family = $("#family_edit").val();
  let colleagues = $("#colleagues_edit").val();
  let privilege = $("#privilege_edit").val();
  let status = $("#status_edit").val();
  let condo_id = $("#condos_edit option:selected").val();

  if (name == "" || password == "" || address == "" || email == "") {
    alert("ERROR! All * parameters need to be filled");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_edit_member",
      id: id,
      password: password,
      name: name,
      address: address,
      email: email,
      family: family,
      colleagues: colleagues,
      privilege: privilege,
      status: status,
      condo_id: condo_id
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// delete a condo for a member by the super admin
function delMemberCondo(id) {
  $.ajax({
    url: COMMON_API,
    data: {
      act: "del_member_condo",
      id: id,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// show all the information of posting of the member
function detailPostingSA(e) {
  let id = e.parent().data("id");
  window.location.href = "../admin/posting_templ.php?act=view&id=" + id;
}

// display the popup form for display members of the group
function displayMembers(e){
  let id = e.data('id');
  var out;

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_member_group",
      id: id,
    },
    dataType: "json",
    type: "post",
    async: false,
    success: function (res) {
      if (res.success == true) {
        out = res.data;
      }
      else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
  }
  });

  //generate the table
  var tableTag = document.getElementById('members-container');
  $('#members-container').empty();
  out.forEach(item => {
    var member_group_id = item['id'];
    var memberName = item['name'];
    var trTag = document.createElement('tr');
    var tdID = document.createElement('td');
    var idText = document.createTextNode(member_group_id);
    tdID.appendChild(idText);
    tdID.setAttribute('hidden', '');
    var tdName = document.createElement('td');
    var nameText = document.createTextNode(memberName);
    tdName.appendChild(nameText);
    var aButton = document.createElement('button');
    var tdButton = document.createElement('td');
    aButton.setAttribute('class', 'btn btn-danger btn-sm');
    aButton.innerHTML = 'Del';
    tdButton.addEventListener('click', function(){
      console.log(member_group_id);
      delMemberGroup1(member_group_id);
    });
    tdButton.appendChild(aButton)
    trTag.appendChild(tdID);
    trTag.appendChild(tdName);
    trTag.appendChild(tdButton);
    tableTag.appendChild(trTag);
  });

  $('#modal-members').modal('show');
}

// delete a member-group relation in the database by the super admin
function delMemberGroup1(id){
  $.ajax({
    url: COMMON_API,
    data: {
      act: "withdraw_group",
      id: id,
    },
    dataType: "JSON",
    type: "POST",
    async: false,
   success: function (res) {
      if (res.success == true) {
        window.location.reload();
      }
      else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  });

  $('#modal-members').modal('hide');
}

// update group info by the super admin
function submitGroupEditBySA() {
  let id = $("#id_edit").val();
  let name = $("#name_edit").val();
  let desc = $("#desc_edit").val();

  if (name == "" || desc == "") {
    alert("params err");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_edit_group",
      id: id,
      name: name,
      desc: desc,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
  }
  });
}

// group apply handler by the super admin
function handleApplyBySA(e, type) {
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  let member_id = info.member_id;
  let group_id = info.group_id;
  let id = info.id;

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_handle_group_apply",
      id: id,
      member_id: member_id,
      group_id: group_id,
      type: type,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      if (res.success == true) {
        window.location.reload();
      }
      else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// display the popup form to add an email
function addEmail(){
  $('#modal-add-email').modal('show');
}

// add an email to the database by the super admin
function submitEmail(){
  let title = $('#title').val();
  let sender_id = $('#sender option:selected').val();
  let sender_name = $('#sender option:selected').text();
  let receiver_id = $('#receiver option:selected').val();
  let receiver_name = $('#receiver option:selected').text();
  let content = $('#content').val();

  if (title == '' || sender == '' || receiver == '' || content == '') {
    alert("ERROR! All parameters need to be filled.");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_add_email",
      content: content,
      title: title,
      sender_id: sender_id,
      sender_name: sender_name,
      receiver_id: receiver_id,
      receiver_name: receiver_name
    },
    dataType: 'JSON',
    type: 'POST',
    success: function (res) {
      alert(res.msg)
      if (res.success == true) {
          window.location.reload()
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// display the popup form for editing an email by the super admin
function editEmail(e){
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  $('#id_edit').val(info.id);
  $('#title_edit').val(info.title);
  $('#sender_edit').val(info.sender_id);
  $('#receiver_edit').val(info.receiver_id);
  $('#content_edit').val(info.content);
  
  $('#modal-edit-email').modal('show');
}

// update edited email to the database by the super admin
function submitEmailEdit(){
  let id = $('#id_edit').val();
  let title = $('#title_edit').val();
  let sender_id = $('#sender_edit option:selected').val();
  let sender_name = $('#sender_edit option:selected').text();
  let receiver_id = $('#receiver_edit option:selected').val();
  let receiver_name = $('#receiver_edit option:selected').text();
  let content = $('#content_edit').val();

  if (title == '' || sender_id == '' || receiver_id == '' || content == '') {
    alert("ERROR! All parameters need to be filled.");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "sadmin_edit_email",
      id: id,
      content: content,
      title: title,
      sender_id: sender_id,
      sender_name: sender_name,
      receiver_id: receiver_id,
      receiver_name: receiver_name
    },
    dataType: 'JSON',
    type: 'POST',
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
          window.location.reload();
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }  
  });
}

// delete an email by the super admin
function delEmail(e){
  let id = e.parent().data("id");

  $.ajax({
    url:COMMON_API,
    data:{
        act:"sadmin_del_email",
        id:id
    },
    dataType:'JSON',
    type:'POST',
    success:function (res) {
      alert(res.msg)
      if(res.success == true) {
        window.location.reload()
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  });
}

// display the condo list of a member
function showCondoSA(id){
  var res = getCondos(id);
  var t = "";

  $.each(res, function (k, item) {
    t += `<tr><td hidden>${item.id}</td><td>${item.name}</td><td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>"><button class="btn btn-danger btn-sm" onclick="delMemberCondo(${item.id})">Del</button></td></tr>`;
  });

  $("#condos-contanier").empty().append(t);

  $("#modal-condos").modal("show");
}

/* --------********--------********--------********--------********--------********
Functions for the SUPER ADMIN ends here
author: Shijun Deng (40084956)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the CONDO starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */
// show the popup form for adding a condo
function addCondo() {
  $("#modal-add-condo").modal("show");
}

// delete information of condo
function delCondo(e) {
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "del_condo",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } 
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    } 
  });
}

// open the popup form from the condo edit
function editCondo(e) {
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  console.log(info);
  $("#id_edit").val(info.id);
  $("#name_edit").val(info.name);
  $("#area_edit").val(info.area);
  $("#cost_edit").val(info.cost);
  $("#modal-edit-condo").modal("show");
}

// add condo information
function submitCondo() {	
  let name = $("#name").val();	
  let area = $("#area").val();	
  let cost = $("#cost").val();

  if (name == "" || area == "" || cost == "") {	
    alert("params err");	
    return false;	
  }	

  $.ajax({	
    url: COMMON_API,	
    data: {	
      act: "add_condo",	
      name: name,	
      cost: cost,	
      area: area,	
    },	
    dataType: "json",	
    type: "post",	
    success: function (res) {	
      alert(res.msg);	
      if (res.success == true) {	
        window.location.reload();	
      }
      else {	
        return false;	
      }	
    },	
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    } 	
  });	
}

// add condo information which is edited.
function submitCondoEdit() {	
  let name = $("#name_edit").val();	
  let area = $("#area_edit").val();	
  let cost = $("#cost_edit").val();	

  if (name == "" || area == "" || cost == "") {	
    alert("params err");	
    return false;	
  }	

  $.ajax({	
    url: COMMON_API,	
    data: {	
      act: "edit_condo",	
      id: $("#id_edit").val(),	
      name: name,	
      cost: cost,	
      area: area,	
    },	
    dataType: "json",	
    type: "post",	
    success: function (res) {	
      alert(res.msg);	
      if (res.success == true) {	
        window.location.reload();	
      }
      else {	
        return false;	
      }	
    },	
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    } 	
  });	
}

/* --------********--------********--------********--------********--------********
Functions for the CONDO ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the GROUP start here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

// show the popup form for adding a group
function addGroup() {
  $("#modal-add-group").modal("show");
}

// delete the group
function delGroup(e) {
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "del_group",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    } 	
  });
}

// open the opoup form for edit the group information.
function editGroup(e) {
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  console.log(info);
  $("#name_edit").val(info.group_name);
  $("#desc_edit").val(info.description);
  $("#id_edit").val(info.id);
  $("#modal-edit-group").modal("show");
}

// submit the form to add a group to the database
function submitGroup() {
  let name = $("#name").val();
  let desc = $("#desc").val();

  if (name == "" || desc == "") {
    alert("params err");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "add_group",
      name: name,
      desc: desc,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// submit the from to add a edited group info to the database
function submitGroupEdit() {
  let id = $("#id_edit").val();
  let name = $("#name_edit").val();
  let desc = $("#desc_edit").val();

  if (name == "" || desc == "") {
    alert("params err");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "edit_group",
      id: id,
      name: name,
      desc: desc,
    },
    dataType: "JSON",
    type: "POST",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// group apply handler
function handleApply(e, type) {
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  
  $.ajax({
    url: COMMON_API,
    data: {
      act: "handle_group_apply",
      id: info.id,
      type: type,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      if (res.success == true) {
        window.location.reload();
      } else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

//get member group
function getGroupMember(id) {
  var out;

  $.ajax({
    url: COMMON_API,
    data: {
        act: "member_within_groups",
        id: id,
    },
    dataType: "json",
    type: "post",
    async: false,
    success: function (res) {
        if (res.success == true) {
            out = res.data;
        }
        else {
            alert(res.msg);
            return false;
        }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
  return out;
}

// display the member list of a group
function detailGroupMember(id){
  var res = getGroupMember(id);

  var t = "";
  $.each(res, function (k, item) {
      t += `<tr><td id="delete_id">${item.member_groupId}</td><td>${item.name}</td><td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>"><button class="btn btn-danger btn-sm" onclick="delMemberGroup()">Del</button></td></tr>`;
  });

  if(t == ""){
      $("#GroupMember-contanier").empty().append("no member yet");
  }
  else {
      $("#GroupMember-contanier").empty().append(t);
  }
  
  $("#modal-GroupMember").modal("show");
}
/* --------********--------********--------********--------********--------********
Functions for the GROUP ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the MEMBER starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

// show the popup form for adding member.
function addMember() {
  $("#modal-add-member").modal("show");
}

// open the popup form for edit member
function editMember(e) {
  let info = e.parent().data("info");
  info = JSON.parse(decodeURIComponent(info));
  console.log(info);
  $("#id_edit").val(info.id);
  $("#name_edit").val(info.name);
  $("#password_edit").val(info.password);
  $("#address_edit").val(info.address);
  $("#email_edit").val(info.email);
  $("#family_edit").val(info.family);
  $("#colleagues_edit").val(info.colleagues);
  $("#privilege_edit").val(info.privilege);
  $("#status_edit").val(info.status);

  let condos = getCondos(info.id);
  if (condos) {
      var selectCondos = [];
      $.each(condos, function (k, item) {
          selectCondos.push(item.id);
      });
      $("#condos_edit").val(selectCondos);
  }

  $("#modal-edit-member").modal("show");
}

// delete member
function delMember(e) {
  let id = e.parent().data("id");
  $.ajax({
    url: COMMON_API,
    data: {
        act: "del_member",
        id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
        alert(res.msg);
        if (res.success == true) {
            window.location.reload();
        }
        else {
            return false;
        }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// add members information
function submitMember() {
  let name = $("#name").val();
  let password = $("#password").val();
  let address = $("#address").val();
  let email = name+"@con.com";
  let family = $("#family").val();
  let colleagues = $("#colleagues").val();
  let privilege = $("#privilege").val();
  let status = $("#status").val();
  let condos = $("#condos").val();

  if (name == "" || password == "" || address == "" || email == "" || !condos || condos ==="") {
    alert("params err");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "add_member",
      name: name,
      password: password,
      address: address,
      email: email,
      family: family,
      colleagues: colleagues,
      privilege: privilege,
      status: status,
      condos: condos,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
          window.location.reload();
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// update the edit member's information
function submitMemberEdit() {
  let name = $("#name_edit").val();
  let password = $("#password_edit").val();
  let address = $("#address_edit").val();
  let email = name+"@con.com";
  let family = $("#family_edit").val();
  let colleagues = $("#colleagues_edit").val();
  let privilege = $("#privilege_edit").val();
  let status = $("#status_edit").val();
  let condos = $("#condos_edit").val();

  if (name == "" || password == "" || address == "" || email == "") {
    alert("params err");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "edit_member",
      id: $("#id_edit").val(),
      password: password,
      name: name,
      address: address,
      email: email,
      family: family,
      colleagues: colleagues,
      privilege: privilege,
      status: status,
      condos: condos,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
          window.location.reload();
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

/* --------********--------********--------********--------********--------********
Functions for the MEMBER ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the OWNER/LOGIN starts here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

// login an admin
function admin_login() {
  let username = $("#username").val();
  let password = $("#password").val();

  if (username == "" || password == "") {
    alert("input username and password first");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "admin_login",
      username: username,
      password: password,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.href = "index.php";
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// get the groups of a member by id
function getGroups(id) {
  var out;

  $.ajax({
    url: COMMON_API,
    data: {
      act: "member_groups",
      id: id,
    },
    dataType: "json",
    type: "post",
    async: false,
    success: function (res) {
      if (res.success == true) {
        out = res.data;
      }
      else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });

  return out;
}

// get the condo list of a member by id 
function getCondos(id) {
  var out;

  $.ajax({
    url: COMMON_API,
    data: {
      act: "member_condos",
      id: id,
    },
    dataType: "json",
    type: "post",
    async: false,
    success: function (res) {
      if (res.success == true) {
        out = res.data;
      }
      else {
        alert(res.msg);
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });

  return out;
}

// dispaly condos of a member
function showCondo(id){
  console.log(id);
  var res = getCondos(id);
  var t = "";
  $.each(res, function (k, item) {
      t += `<tr><td>${item.name}</td></tr>`;
  });
  $("#condos-contanier").empty().append(t);
  $("#modal-condos").modal("show");
}

// idpaly groups of a member
function showGroup(id){
  var res = getGroups(id);
  var t = "";
  $.each(res, function (k, item) {
      t += `<tr><td>${item.group_name}</td></tr>`;
  });
  $("#condos-contanier").empty().append(t);
  $("#modal-condos").modal("show");
}

/* --------********--------********--------********--------********--------********
Functions for the OWNER/LOGIN ends here
author: saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the POSTING starts here
author: kimchhengheng (26809413)_saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

// sava a posting with the pictures to the database
function savePosting(act = "add_posting") {
  let title = $("#title").val();
  let content = $("#content").val();
  let status = $("#status").val();

  if (title == "" || content == "") {
    alert("params err");
    return false;
  }

  $.ajaxFileUpload({
    url: COMMON_API,
    secureuri: false,
    data: {
      act: act,
      id: $("#id_edit").val(),
      title: title,
      content: content,
      status: status,
    },
    fileElementId: "fileToUpload",
    dataType: "json",
    success: function (response) {
      console.log(response);

      if (response.success == false) {
        return false;
      }
      else {
        window.location.href =
          "../member/posting_templ.php?act=view&id=" + response.data;
      }
    },
    error: function (data, status, e) {
      alert(e);
    },
  });
}

// delete the posting
function delPosting(e) {
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "del_posting",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    },
  });
}

// show the modal to allow user edit posting
function editPosting(e) {
  let id = e.parent().data("id");
  window.location.href = "../member/posting_templ.php?act=edit&id=" + id;
}

// show all the information of the posting
function detailPosting(e) {
  let id = e.parent().data("id");
  window.location.href = "../member/posting_templ.php?act=view&id=" + id;
}

// show all the information of posting of the member
function detailPostingOwner(e) {
  let id = e.parent().data("id");
  window.location.href = "../owner/posting_templ.php?act=view&id=" + id;
}

// submit the comment
function submitComment() {
  let content = $("#comment_content").val();
  let posting_id = $("#id_comment_edit").val();

  $.ajax({
    url: COMMON_API,
    data: {
      act: "add_comment",
      content: content,
      id: posting_id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      window.location.reload();
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// redirect the page to view the detail of a posting
function detailGroupPostingMember(id) {
    window.location.href = "../member/groupPosting.php?id=" + id;

}

// redirect the page to view the detail of a posting by an admin
function detailGroupPostingOwner(id) {
    window.location.href = "../owner/groupPosting.php?id=" + id;
}

/* --------********--------********--------********--------********--------********
Functions for the POSTING ends here
author: kimchhengheng (26809413)_saebom SHIN (40054234)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the Member ends here
author: kimchhengheng (26809413) Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */

// handle login of member is clicked
function member_login() {
  console.log("member_login");
  let username = $("#username").val();
  let password = $("#password").val();

  if (username == "" || password == "") {
    alert("input username and password first");
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "member_login",
      username: username,
      password: password,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.href = "index.php";
      }
      else {
        return false;
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    },
  });
}

/* --------********--------********--------********--------********--------********
Functions for the Member ends here
author: kimchhengheng (26809413) Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */
/* --------********--------********--------********--------********--------********
Functions for the Contract starts here
author: Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */

// delete a contract from the database
function delContract(e) {
  let id = e.parent().data('id');
  $.ajax({
    url:COMMON_API,
    data:{
      act:"del_contract",
      id:id
    },
    dataType:'JSON',
    type:'POST',
    success:function (res) {
      alert(res.msg)
      if(res.success == true) {
        window.location.reload()
      } else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

//edit contract
function editContract(e) {
  let info = e.parent().data('info')
  info = JSON.parse(decodeURIComponent(info))
  console.log(info)
  $('#id_edit').val(info.id)
  $('#title_edit').val(info.title)
  $('#status_edit').val(info.status)
  $('#content_edit').val(info.content)
  $('#modal-edit-contract').modal('show')
}

// update a contract into the database
function submitContractEdit() {
  let status = $("#status_edit option:selected").val()
  let title = $('#title_edit').val();
  let content = $('#content_edit').val();
  
  if (status == '') {
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "update_contract",
      id: $('#id_edit').val(),
      title: title,
      content: content,
      status: status,
    },
    dataType: 'json',
    type: 'post',
    success: function (res) {
      alert(res.msg)
      if (res.success == true) {
          window.location.reload()
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  })
}

// add a new contract into the database
function submitContract() {
  let content = $('#content').val()
  let title = $('#title').val()
  let status = $("#status option:selected").val()
  if (content == '' || title == '' || status == '') {
    alert("ERROR! All parameters need to be filled.");
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
    dataType: 'JSON',
    type: 'post',
    success: function (res) {
      alert(res.msg)
      if (res.success == true) {
          window.location.reload()
      }
      else {
          return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText);
    }
  })
}

/* --------********--------********--------********--------********--------********
Functions for the Contract starts here
author: Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the SOCIAL start here
author: kimchhengheng (26809413)
--------********--------********--------********--------********--------******** */

// search a friend of a member in his/her friend list 
function searchFriend() {

  let friend_keyword = $("#friend_keyword").val();

  if (friend_keyword == "") {
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "friend_search",
      keyword: friend_keyword,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      console.log(res);
      var t = "";
      $.each(res.data, function (k, item) {
        t += `<tr><td>${item.name}</td><td>${item.email}</td><td data-id="${item.id}"><button class="btn btn-primary apply-friend btn-sm">apply</button></td></tr>`;
      });
      $("#friend-search-container").empty().append(t);
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// search a posting of a member
function searchPosting() {
  let posting_keyword = $("#posting_keyword").val();

  if (posting_keyword == "") {
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "posting_search",
      keyword: posting_keyword,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      var t = "";
      $.each(res.data, function (k, item) {
        t += `  <tr><td id="delete_id">${item.id}</td><td>${item.title}</td><td>${item.name}</td><td>${item.create_time}</td><td><button class="btn btn-primary btn-sm" onclick="detailPosting($(this))">detail</button></td></tr>`;
      });
      $("#posting-search-container").empty().append(t);
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}
// search a group for a member
function searchGroup() {
  let group_keyword = $("#group_keyword").val();

  if (group_keyword == "") {
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "group_search",
      keyword: group_keyword,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      console.log(res);
      var t = "";
      $.each(res.data, function (k, item) {
        t += `<tr><td>${item.group_name}</td><td>${item.description}</td><td data-id="${item.id}"><button class="btn btn-primary apply-group btn-sm">apply</button></td></tr>`;
      });
      $("#group-search-container").empty().append(t);
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// send a friend apply for a member
function applyFriend(e){
  let id = e.parent().data("id");
  console.log(id);
  $.ajax({
    url: COMMON_API,
    data: {
      act: "apply_friend",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// send a group applu for a member
function applyGroup(e){
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "apply_group",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
         window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}
/* --------********--------********--------********--------********--------********
Functions for the SOCIAL start here
author: kimchhengheng (26809413)
--------********--------********--------********--------********--------******** */
/* --------********--------********--------********--------********--------********
Functions for the MESSAGE start here
author: kimchhengheng (26809413)
--------********--------********--------********--------********--------******** */

// show modal message
function addMessage() {
  $("#modal-add-message").modal("show");
  $(".selectpicker").selectpicker();
}

// create an email
function submitMessage() {
  let content = $("#content").val();
  let title = $("#title").val();
  let receiver = $("#receiver").val().split(":");
  let receiverId = receiver[0];
  let receiverEmail = receiver[1];

  if (content == "" || title == "" || receiver == "") {
    return false;
  }

  $.ajax({
    url: COMMON_API,
    data: {
      act: "add_message",
      id: $("#id").val(),
      content: content,
      title: title,
      receiverId: receiverId,
      receiverEmail: receiverEmail,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

/* --------********--------********--------********--------********--------********
Functions for the MESSAGE start here
author: kimchhengheng (26809413)
--------********--------********--------********--------********--------******** */

/* --------********--------********--------********--------********--------********
Functions for the BASE_INFO start here
author: Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */

// withdraw a member from a group
function withdraw(e) {
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "withdraw_group",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// withdraw a member from a friend
function unfriend(e) {
  let id = e.parent().data("id");

  alert(id);
  $.ajax({
    url: COMMON_API,
    data: {
      act: "unfriend",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      if (res.success == true) {
        window.location.reload();
      }
      else {
        return false;
      }
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// display the popup form for comment
function comment(id){
  $("#id_comment_edit").val(id);
  $("#modal-add-comment").modal("show");
}
// accept a friend apply
function agreeFriend(e){
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "agree_friend_apply",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      window.location.reload();
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

// reject a friend apply
function disagreeFriend(e){
  let id = e.parent().data("id");

  $.ajax({
    url: COMMON_API,
    data: {
      act: "disagree_friend_apply",
      id: id,
    },
    dataType: "json",
    type: "post",
    success: function (res) {
      alert(res.msg);
      window.location.reload();
    },
    error:function (jqXHR, textStatus, errorThrown) {
      alert(jqXHR.responseText);
    }
  });
}

/* --------********--------********--------********--------********--------********
Functions for the BASE_INFO start here
author: Yuxin Wang-40024855
--------********--------********--------********--------********--------******** */