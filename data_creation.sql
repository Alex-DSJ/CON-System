USE lac353_2;
SET FOREIGN_KEY_CHECKS=0;

-- admin's data
INSERT INTO `admin` VALUES ('1', 'admin', 'admin', '1', DEFAULT, DEFAULT);
INSERT INTO `admin` VALUES ('2', 'kim', 'kim123', '1', DEFAULT, DEFAULT);
INSERT INTO `admin` VALUES ('3', 'alex', 'alex123', '1', DEFAULT, DEFAULT);
INSERT INTO `admin` VALUES ('4', 'saebom', 'saebom123', '1', DEFAULT, DEFAULT);
INSERT INTO `admin` VALUES ('5', 'shirley', 'shirley123', '1', DEFAULT, DEFAULT);

-- building's data id, building_name, address, description, area, create_time
INSERT INTO `building` VALUES ('1', 'building1', 'adress1', 'description1', '11.11', DEFAULT);
INSERT INTO `building` VALUES ('2', 'building2', 'adress2', 'description2', '22.22', DEFAULT);
INSERT INTO `building` VALUES ('3', 'building3', 'adress3', 'description3', '33.33', DEFAULT);
INSERT INTO `building` VALUES ('4', 'building4', 'adress4', 'description4', '44.44', DEFAULT);

-- admin_building: id, building_id, admin_id
INSERT INTO `admin_building` VALUES ('1', '1', '2');
INSERT INTO `admin_building` VALUES ('2', '2', '3');
INSERT INTO `admin_building` VALUES ('3', '3', '4');
INSERT INTO `admin_building` VALUES ('4', '4', '5');

-- condo's data: id, name, area, cost, create_time, last_update_time
INSERT INTO `condo` VALUES ('1', 'condo1-1', '11.11', '100100', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('2', 'condo1-2', '22.22', '100200', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('3', 'condo1-3', '33.33', '100300', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('4', 'condo2-1', '44.44', '200100', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('5', 'condo2-2', '55.55', '200200', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('6', 'condo2-3', '66.66', '200300', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('7', 'condo3-1', '77.77', '300100', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('8', 'condo3-2', '88.88', '300200', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('9', 'condo3-3', '99.99', '300300', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('10', 'condo4-1', '10.10', '400100', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('11', 'condo4-2', '11.11', '400200', DEFAULT, DEFAULT);
INSERT INTO `condo` VALUES ('12', 'condo4-3', '12.12', '400300', DEFAULT, DEFAULT);

-- condo_building's data: id, building_id, condo_id
INSERT INTO `condo_building` VALUES ('1', '1', '1');
INSERT INTO `condo_building` VALUES ('2', '1', '2');
INSERT INTO `condo_building` VALUES ('3', '1', '3');
INSERT INTO `condo_building` VALUES ('4', '2', '4');
INSERT INTO `condo_building` VALUES ('5', '2', '5');
INSERT INTO `condo_building` VALUES ('6', '2', '6');
INSERT INTO `condo_building` VALUES ('7', '3', '7');
INSERT INTO `condo_building` VALUES ('8', '3', '8');
INSERT INTO `condo_building` VALUES ('9', '3', '9');
INSERT INTO `condo_building` VALUES ('10', '4', '10');
INSERT INTO `condo_building` VALUES ('11', '4', '11');
INSERT INTO `condo_building` VALUES ('12', '4', '12');

-- Records of contract's data: id, title, status, content, create_time
INSERT INTO `contract` VALUES ('1', 'contract1', 'normal', 'content1', DEFAULT);
INSERT INTO `contract` VALUES ('2', 'contract2', 'urgent', 'content2', DEFAULT);
INSERT INTO `contract` VALUES ('3', 'contract3', 'normal', 'content3', DEFAULT);
INSERT INTO `contract` VALUES ('4', 'contract4', 'normal', 'content4', DEFAULT);
INSERT INTO `contract` VALUES ('5', 'contract5', 'urgent', 'content5', DEFAULT);
INSERT INTO `contract` VALUES ('6', 'contract6', 'urgent', 'content6', DEFAULT);
INSERT INTO `contract` VALUES ('7', 'contract7', 'urgent', 'content7', DEFAULT);
INSERT INTO `contract` VALUES ('8', 'contract8', 'urgent', 'content8', DEFAULT);
INSERT INTO `contract` VALUES ('9', 'contract9', 'normal', 'content9', DEFAULT);

-- Records of user_contract's data: id, user_type('Super Admin', 'Admin', 'Member'), uid, contract_id
INSERT INTO `user_contract` VALUES ('1', 'Super Admin', '1', '1');
INSERT INTO `user_contract` VALUES ('2', 'Admin', '2', '2');
INSERT INTO `user_contract` VALUES ('3', 'Admin', '3', '3');
INSERT INTO `user_contract` VALUES ('4', 'Admin', '4', '4');
INSERT INTO `user_contract` VALUES ('5', 'Admin', '5', '5');
INSERT INTO `user_contract` VALUES ('6', 'Member', '1', '6');
INSERT INTO `user_contract` VALUES ('7', 'Member', '2', '7');
INSERT INTO `user_contract` VALUES ('8', 'Member', '3', '8');
INSERT INTO `user_contract` VALUES ('9', 'Member', '4', '9');

-- Records of group's data: id, admin_id, group_name, description, create_time, last_update_time
INSERT INTO `group` VALUES ('1', '2', 'group1', 'description1', DEFAULT, DEFAULT);
INSERT INTO `group` VALUES ('2', '3', 'group2', 'description2', DEFAULT, DEFAULT);
INSERT INTO `group` VALUES ('3', '4', 'group3', 'description3', DEFAULT, DEFAULT);
INSERT INTO `group` VALUES ('4', '5', 'group4', 'description4', DEFAULT, DEFAULT);

-- member's data: id, name, password, address, email, family, colleagues, privilege, status, create_time, last_update_time
INSERT INTO `member` VALUES ('1', 'member1', '111111', 'address1', 'member1@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'low', 'inactive', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('2', 'member2', '222222', 'address2', 'member2@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'normal', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('3', 'member3', '333333', 'address3', 'member3@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'high', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('4', 'member4', '444444', 'address4', 'member4@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'normal', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('5', 'member5', '555555', 'address5', 'member5@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'low', 'inactive', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('6', 'member6', '666666', 'address6', 'member6@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'normal', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('7', 'member7', '777777', 'address7', 'member7@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'normal', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('8', 'member8', '888888', 'address8', 'member8@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'normal', 'active', DEFAULT, DEFAULT);
INSERT INTO `member` VALUES ('9', 'member9', '999999', 'address9', 'member9@con.com', 'father, mother, kids', 'colleague1, colleague2, ...', 'low', 'inactive', DEFAULT, DEFAULT);

-- Records of mail's data: id, title, content, receiver_id(member id), receiver, sender_id(member id), sender, is_read, create_time
INSERT INTO `mail` VALUES ('1', 'email1', 'email content1', '2', 'member2', '1', 'member1', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('2', 'email2', 'email content2', '3', 'member3', '2', 'member2', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('3', 'email3', 'email content3', '4', 'member4', '3', 'member3', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('4', 'email4', 'email content4', '5', 'member5', '4', 'member4', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('5', 'email5', 'email content5', '6', 'member6', '5', 'member5', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('6', 'email6', 'email content6', '7', 'member7', '6', 'member6', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('7', 'email7', 'email content7', '8', 'member8', '7', 'member7', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('8', 'email8', 'email content8', '9', 'member9', '8', 'member8', 'unread', DEFAULT);
INSERT INTO `mail` VALUES ('9', 'email9', 'email content8', '1', 'member2', '9', 'member9', 'unread', DEFAULT);

-- Records of member_condo's data: id, member_id, condo_id
INSERT INTO `member_condo` VALUES ('1', '1', '1');
INSERT INTO `member_condo` VALUES ('2', '2', '2');
INSERT INTO `member_condo` VALUES ('3', '3', '3');
INSERT INTO `member_condo` VALUES ('4', '4', '4');
INSERT INTO `member_condo` VALUES ('5', '5', '5');
INSERT INTO `member_condo` VALUES ('6', '6', '6');
INSERT INTO `member_condo` VALUES ('7', '7', '7');
INSERT INTO `member_condo` VALUES ('8', '8', '8');
INSERT INTO `member_condo` VALUES ('9', '9', '9');
INSERT INTO `member_condo` VALUES ('10', '1', '10');
INSERT INTO `member_condo` VALUES ('11', '1', '11');
INSERT INTO `member_condo` VALUES ('12', '1', '12');

-- Records of member_friend's data: id, member_id, friend_id
INSERT INTO `member_friend` VALUES('1', '1', '2');
INSERT INTO `member_friend` VALUES('2', '2', '3');
INSERT INTO `member_friend` VALUES('3', '3', '4');
INSERT INTO `member_friend` VALUES('4', '4', '5');
INSERT INTO `member_friend` VALUES('5', '5', '6');
INSERT INTO `member_friend` VALUES('6', '6', '7');
INSERT INTO `member_friend` VALUES('7', '7', '8');
INSERT INTO `member_friend` VALUES('8', '8', '9');
INSERT INTO `member_friend` VALUES('9', '9', '1');

-- Records of member_friend_apply's data: id, member_id, apply_member_id, status('', 'agree', 'disagree'), create_time
-- ----------------------------
INSERT INTO `member_friend_apply` VALUES('1', '1', '3', '', DEFAULT);

-- member_group's data: id, member_id, group_id
INSERT INTO `member_group` VALUES ('1', '1', '1');
INSERT INTO `member_group` VALUES ('2', '2', '1');
INSERT INTO `member_group` VALUES ('3', '3', '2');
INSERT INTO `member_group` VALUES ('4', '4', '2');
INSERT INTO `member_group` VALUES ('5', '5', '3');
INSERT INTO `member_group` VALUES ('6', '6', '3');
INSERT INTO `member_group` VALUES ('7', '7', '4');
INSERT INTO `member_group` VALUES ('8', '8', '4');
INSERT INTO `member_group` VALUES ('9', '9', '4');
INSERT INTO `member_group` VALUES ('10', '1', '2');

-- member_group_apply's data: id, member_id, group_id, status('agree' or 'disagree'), create_time, handle_time
INSERT INTO `member_group_apply` VALUES ('1', '1', '2', 'agree', DEFAULT, DEFAULT);

-- Records of posting's data: id, title, pic, content, status, create_time, last_update_time
INSERT INTO `posting` VALUES ('3', 'posting3', '202011140320002.jpg', 'posting content3', DEFAULT, '2020-11-14 15:20:00', '2020-11-14 15:20:00');
INSERT INTO `posting` VALUES ('4', 'posting4', '202011140320232.jpg', 'posting content4', DEFAULT, '2020-11-14 15:20:23', '2020-11-14 15:20:23');
INSERT INTO `posting` VALUES ('5', 'posting5', '202011140320362.jpg', 'posting content5', DEFAULT, '2020-11-14 15:20:36', '2020-11-14 15:20:36');
INSERT INTO `posting` VALUES ('6', 'posting6', '202011140320442.jpg', 'posting content6', DEFAULT, '2020-11-14 15:20:44', '2020-11-14 15:20:44');
INSERT INTO `posting` VALUES ('7', 'posting7', '202011140321162.jpg', 'posting content7', DEFAULT, '2020-11-14 15:21:16', '2020-11-14 15:21:16');
INSERT INTO `posting` VALUES ('8', 'posting8', '202011140323502.jpg', 'posting content8', DEFAULT, '2020-11-14 15:23:50', '2020-11-14 15:23:50');
INSERT INTO `posting` VALUES ('9', 'posting9', 'default/demo-default.jpg', 'posting content9', DEFAULT, '2020-11-14 15:28:36', '2020-11-14 15:28:36');
INSERT INTO `posting` VALUES ('10', 'posting10', '202011140329272.jpg', 'posting content10', DEFAULT, '2020-11-14 15:29:27', '2020-11-14 15:29:27');
INSERT INTO `posting` VALUES ('11', 'posting11', '202011140330012.jpg', 'posting content11', DEFAULT, '2020-11-14 15:30:01', '2020-11-14 15:30:01');
INSERT INTO `posting` VALUES ('12', 'posting12', '202011140332132.jpg', 'posting content12', DEFAULT, '2020-11-14 15:32:13', '2020-11-14 15:32:13');
INSERT INTO `posting` VALUES ('13', 'posting13', '202011140333312.jpg', 'posting content13', DEFAULT, '2020-11-14 15:33:31', '2020-11-14 15:33:31');
INSERT INTO `posting` VALUES ('14', 'posting14', '202011140333372.jpg', 'posting content14', DEFAULT, '2020-11-14 15:33:37', '2020-11-14 15:33:37');
INSERT INTO `posting` VALUES ('15', 'posting15', '202011140334202.jpg', 'posting content15', DEFAULT, '2020-11-14 15:34:20', '2020-11-14 15:34:20');
INSERT INTO `posting` VALUES ('16', 'posting16', '202011140337252.jpg', 'posting content1', DEFAULT, '2020-11-14 15:37:25', '2020-11-14 15:37:25');
INSERT INTO `posting` VALUES ('17', 'posting17', 'default/demo-default.jpg', 'posting content17', DEFAULT, '2020-11-14 15:37:45', '2020-11-14 15:37:45');
INSERT INTO `posting` VALUES ('18', 'posting18', 'default/demo-default.jpg', 'posting content18', DEFAULT, '2020-11-14 15:38:09', '2020-11-14 15:38:09');
INSERT INTO `posting` VALUES ('19', 'posting19', 'default/demo-default.jpg', 'posting content19', DEFAULT, '2020-11-14 15:42:17', '2020-11-14 15:55:10');

-- Records of member_posting's data: id, posting_id, member_id
INSERT INTO `member_posting` VALUES ('1', '7', '1');
INSERT INTO `member_posting` VALUES ('2', '8', '2');
INSERT INTO `member_posting` VALUES ('3', '9', '3');
INSERT INTO `member_posting` VALUES ('4', '10', '4');
INSERT INTO `member_posting` VALUES ('5', '11', '5');
INSERT INTO `member_posting` VALUES ('6', '12', '6');
INSERT INTO `member_posting` VALUES ('7', '13', '7');
INSERT INTO `member_posting` VALUES ('8', '14', '8');
INSERT INTO `member_posting` VALUES ('9', '15', '9');
INSERT INTO `member_posting` VALUES ('10', '16', '1');
INSERT INTO `member_posting` VALUES ('11', '17', '2');
INSERT INTO `member_posting` VALUES ('12', '18', '3');
INSERT INTO `member_posting` VALUES ('13', '19', '4');
INSERT INTO `member_posting` VALUES ('14', '3', '5');
INSERT INTO `member_posting` VALUES ('15', '4', '6');
INSERT INTO `member_posting` VALUES ('16', '5', '7');
INSERT INTO `member_posting` VALUES ('17', '6', '8');

-- Records of reply's data: id, content, create_time, last_update_time
INSERT INTO `reply` VALUES('1', 'reply1 to posting 3', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('2', 'reply2 to posting 4', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('3', 'reply3 to posting 5', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('4', 'reply4 to posting 6', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('5', 'reply5 to posting 7', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('6', 'reply6 to posting 8', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('7', 'reply7 to posting 9', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('8', 'reply8 to posting 10', DEFAULT, DEFAULT);
INSERT INTO `reply` VALUES('9', 'reply9 to posting 11', DEFAULT, DEFAULT);

-- Records of posting_reply's data: id, posting_id, reply_id
INSERT INTO `posting_reply` VALUES('1', '3', '1');
INSERT INTO `posting_reply` VALUES('2', '4', '2');
INSERT INTO `posting_reply` VALUES('3', '5', '3');
INSERT INTO `posting_reply` VALUES('4', '6', '4');
INSERT INTO `posting_reply` VALUES('5', '7', '5');
INSERT INTO `posting_reply` VALUES('6', '8', '6');
INSERT INTO `posting_reply` VALUES('7', '9', '7');
INSERT INTO `posting_reply` VALUES('8', '10', '8');
INSERT INTO `posting_reply` VALUES('9', '11', '9');

-- Records of member_reply's data: id, member_id, reply_id
INSERT INTO `member_reply` VALUES('1', '1', '1');
INSERT INTO `member_reply` VALUES('2', '2', '2');
INSERT INTO `member_reply` VALUES('3', '3', '3');
INSERT INTO `member_reply` VALUES('4', '4', '4');
INSERT INTO `member_reply` VALUES('5', '5', '5');
INSERT INTO `member_reply` VALUES('6', '6', '6');
INSERT INTO `member_reply` VALUES('7', '7', '7');
INSERT INTO `member_reply` VALUES('8', '8', '8');
INSERT INTO `member_reply` VALUES('9', '9', '9');
