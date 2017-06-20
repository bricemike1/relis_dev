-- TABLES
DROP TABLE IF EXISTS `admin_config`$$
CREATE TABLE IF NOT EXISTS `admin_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_label` varchar(100) NOT NULL,
  `config_value` varchar(100) NOT NULL,
  `config_description` varchar(500) DEFAULT NULL,
  `config_user` int(11) NOT NULL DEFAULT '0',
  `config_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;$$

DROP TABLE IF EXISTS `config`$$
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type` varchar(15) NOT NULL DEFAULT 'default',
  `project_title` varchar(500) DEFAULT NULL,
  `project_description` text,
  `default_lang` varchar(15) NOT NULL DEFAULT 'en',
  `creator` int(11) NOT NULL DEFAULT '1',
  `run_setup` int(1) NOT NULL DEFAULT '0',
  `rec_per_page` int(4) NOT NULL DEFAULT '30',
  `config_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1$$


INSERT INTO `config` (`config_id`, `config_type`, `project_title`, `project_description`, `default_lang`, `creator`, `run_setup`, `rec_per_page`, `config_active`) VALUES
(1, 'default', 'Admin', 'Admin project', 'en', 1, 0, 30, 1)$$



DROP TABLE IF EXISTS `log`$$
CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(20) NOT NULL,
  `log_event` text NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_ip_address` varchar(50) DEFAULT NULL,
  `log_user_id` int(11) DEFAULT NULL,
  `log_poste_id` int(11) DEFAULT NULL,
  `log_user_agent` varchar(150) DEFAULT NULL,
  `log_publish` int(1) NOT NULL DEFAULT '1',
  `log_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 $$



DROP TABLE IF EXISTS `projects`$$
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_label` varchar(100) NOT NULL,
  `project_title` varchar(250) NOT NULL,
  `project_description` varchar(1000) DEFAULT NULL,
  `project_creator` int(11) NOT NULL DEFAULT '1',
  `project_icon` blob,
  `project_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 $$



DROP TABLE IF EXISTS `str_management`$$
CREATE TABLE IF NOT EXISTS `str_management` (
  `str_id` int(11) NOT NULL AUTO_INCREMENT,
  `str_label` varchar(500) NOT NULL,
  `str_text` varchar(1000) NOT NULL,
  `str_category` varchar(20) NOT NULL DEFAULT 'default',
  `str_lang` varchar(3) NOT NULL DEFAULT 'en',
  `str_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`str_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 $$



DROP TABLE IF EXISTS `usergroup`$$
CREATE TABLE IF NOT EXISTS `usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_name` varchar(100) NOT NULL,
  `usergroup_description` varchar(100) DEFAULT NULL,
  `usergroup_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 $$


INSERT INTO `usergroup` (`usergroup_id`, `usergroup_name`, `usergroup_description`, `usergroup_active`) VALUES
(1, 'Super Admin', 'Super Admin', 1),
(2, 'Project Admin', 'Project Admin', 1),
(3, 'Reviewer', 'Reviewer', 1)$$


DROP TABLE IF EXISTS `userproject`$$
CREATE TABLE IF NOT EXISTS `userproject` (
  `userproject_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL ,
  `project_id` int(11) NOT NULL,
  `user_role` varchar(50) NOT NULL DEFAULT 'Reviewer',
  `added_by` int(11) NOT NULL DEFAULT '1',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userproject_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userproject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 $$


DROP TABLE IF EXISTS `users`$$
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_mail` varchar(100) DEFAULT NULL,
  `user_usergroup` int(11) DEFAULT NULL,
  `user_picture` varchar(300) DEFAULT NULL,
  `created_by` int(11) DEFAULT 0,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(1) NOT NULL DEFAULT '1',
  `user_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 $$

-- INSERT INTO `users` (`user_id`, `user_name`, `user_username`, `user_password`, `user_mail`, `user_usergroup`, `user_picture`, `user_status`, `user_active`) VALUES
-- (1, 'Brice', 'admin', '0192023a7bbd73250516f069df18b500', 'bbigendako@gmail.com', 1, '', 1, 1),
-- (2, 'Eugene', 'uj', '6026e5d1d4ee04c873dd28f245312908', 'bbigendako@gmail.com', 1, '', 1, 1)$$

-- stored procedures

DROP PROCEDURE IF EXISTS `add_config`$$
CREATE   PROCEDURE `add_config`(_config_id INT , _project_title  VARCHAR(405) , _project_description  VARCHAR(1005) , _default_lang  VARCHAR(16) , _creator INT , _run_setup  VARCHAR(6))
BEGIN
START TRANSACTION;
INSERT INTO config (project_title , project_description , default_lang , creator , run_setup) VALUES (_project_title , _project_description , _default_lang , _creator , _run_setup);
SELECT config_id AS id_value FROM config WHERE config_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `add_logs`$$
CREATE   PROCEDURE `add_logs`(_log_id INT , _log_type  VARCHAR(55) , _log_user_id INT , _log_event  VARCHAR(205) , _log_time  VARCHAR(205) , _log_ip_address  VARCHAR(205))
BEGIN
START TRANSACTION;
INSERT INTO log (log_type , log_user_id , log_event , log_time , log_ip_address) VALUES (_log_type , _log_user_id , _log_event , _log_time , _log_ip_address);
SELECT log_id AS id_value FROM log WHERE log_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `add_str_mng`$$
CREATE   PROCEDURE `add_str_mng`(_str_id INT , _str_label  VARCHAR(405) , _str_text  VARCHAR(805) , _str_lang  VARCHAR(8) , _str_category  VARCHAR(23))
BEGIN
START TRANSACTION;
INSERT INTO str_management (str_label , str_text , str_lang , str_category) VALUES (_str_label , _str_text , _str_lang , _str_category);
SELECT str_id AS id_value FROM str_management WHERE str_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `add_usergroup`$$
CREATE   PROCEDURE `add_usergroup`(_usergroup_id INT , _usergroup_name  VARCHAR(25) , _usergroup_description  VARCHAR(55))
BEGIN
START TRANSACTION;
INSERT INTO usergroup (usergroup_name , usergroup_description) VALUES (_usergroup_name , _usergroup_description);
SELECT usergroup_id AS id_value FROM usergroup WHERE usergroup_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `add_users`$$
CREATE   PROCEDURE `add_users`(_user_id INT , _user_name  VARCHAR(55) , _user_username  VARCHAR(25) , _user_mail  VARCHAR(55) , _user_usergroup INT , _user_password  VARCHAR(40) , _user_picture  VARCHAR(205), _created_by  VARCHAR(5))
BEGIN
START TRANSACTION;
INSERT INTO users (user_name , user_username , user_mail , user_usergroup , user_password , user_picture,created_by) VALUES (_user_name , _user_username , _user_mail , _user_usergroup , _user_password , _user_picture,_created_by);
SELECT user_id AS id_value FROM users WHERE user_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `add_user_project`$$
CREATE   PROCEDURE `add_user_project`(_userproject_id INT , _user_id INT , _project_id INT)
BEGIN START TRANSACTION; INSERT INTO userproject (user_id , project_id) VALUES (_user_id , _project_id); SELECT userproject_id AS id_value FROM userproject WHERE userproject_id = LAST_INSERT_ID(); COMMIT; END$$

DROP PROCEDURE IF EXISTS `check_login`$$
CREATE   PROCEDURE `check_login`(IN _login VARCHAR(20))
BEGIN
START TRANSACTION;
SELECT COUNT(user_id)  AS number 
FROM users
WHERE user_active=1 AND user_username = _login  ;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `check_user_credentials`$$
CREATE   PROCEDURE `check_user_credentials`(_username VARCHAR(100), _password VARCHAR(100))
BEGIN
START TRANSACTION;
	SELECT * FROM users 
	WHERE (users.user_username = _username)
    AND (users.user_password = _password);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `count_list`$$
CREATE   PROCEDURE `count_list`(IN source varchar(200),IN condition_stat VARCHAR(1000))
BEGIN
SET @query = CONCAT('Select count(*) as nombre from  ',source ,'   WHERE 1=1  ', condition_stat );
PREPARE stmt FROM @query;
EXECUTE stmt; -- execute statement
DEALLOCATE PREPARE stmt; -- release the statement memory.
END$$

DROP PROCEDURE IF EXISTS `get_detail_config`$$
CREATE   PROCEDURE `get_detail_config`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM config
WHERE config_id= _row_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_logs`$$
CREATE   PROCEDURE `get_detail_logs`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM log
WHERE log_id= _row_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_str_mng`$$
CREATE   PROCEDURE `get_detail_str_mng`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM str_management
WHERE str_id= _row_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_usergroup`$$
CREATE   PROCEDURE `get_detail_usergroup`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM usergroup
WHERE usergroup_id= _row_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_users`$$
CREATE   PROCEDURE `get_detail_users`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM users
WHERE user_id= _row_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_user_project`$$
CREATE   PROCEDURE `get_detail_user_project`(IN _row_id INT)
BEGIN START TRANSACTION; SELECT * FROM userproject WHERE userproject_id= _row_id; COMMIT; END$$

DROP PROCEDURE IF EXISTS `get_list`$$
CREATE   PROCEDURE `get_list`(IN _source varchar(100),IN _fields varchar(1000),IN _condition_stat VARCHAR(1000))
BEGIN
SET @query = CONCAT('Select ',_fields,' from  ',_source ,'   WHERE 1=1   ', _condition_stat );
 PREPARE stmt FROM @query;
 EXECUTE stmt; -- execute statement
 DEALLOCATE PREPARE stmt; -- release the statement memory.
END$$

DROP PROCEDURE IF EXISTS `get_list_config`$$
CREATE   PROCEDURE `get_list_config`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN
START TRANSACTION;
IF _range < 1 THEN
SELECT  * FROM config
WHERE config_active=1   ORDER BY config_id ASC;
ELSE
SELECT  * FROM config
WHERE config_active=1   ORDER BY config_id ASC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_list_logs`$$
CREATE   PROCEDURE `get_list_logs`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN
START TRANSACTION;
SET @search_log_user_id := CONCAT('%',TRIM(_search),'%') ; 
IF _range < 1 THEN
SELECT  log_id , log_user_id , log_event , log_time FROM log
WHERE log_active=1   AND (  (log_user_id LIKE  @search_log_user_id)  )  ORDER BY log_id DESC ;
ELSE
SELECT  log_id , log_user_id , log_event , log_time FROM log
WHERE log_active=1   AND (  (log_user_id LIKE  @search_log_user_id)  )  ORDER BY log_id DESC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$



DROP PROCEDURE IF EXISTS `get_list_str_mng`$$
CREATE   PROCEDURE `get_list_str_mng`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500) ,IN _lang VARCHAR(3))
BEGIN
START TRANSACTION;
SET @search_str_text := CONCAT('%',TRIM(_search),'%') ; 
IF _range < 1 THEN
SELECT  * FROM str_management
WHERE str_active=1  AND str_lang = _lang   AND (  (str_text LIKE  @search_str_text)  )  ORDER BY str_text ASC ;
ELSE
SELECT  * FROM str_management
WHERE str_active=1  AND str_lang = _lang   AND (  (str_text LIKE  @search_str_text)  )  ORDER BY str_text ASC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_list_usergroup`$$
CREATE   PROCEDURE `get_list_usergroup`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN
START TRANSACTION;
SET @search_usergroup_name := CONCAT('%',TRIM(_search),'%') ; 
IF _range < 1 THEN
SELECT  * FROM usergroup
WHERE usergroup_active=1   AND (  (usergroup_name LIKE  @search_usergroup_name)  )  ORDER BY usergroup_name ASC;
ELSE
SELECT  * FROM usergroup
WHERE usergroup_active=1   AND (  (usergroup_name LIKE  @search_usergroup_name)  )  ORDER BY usergroup_name ASC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_list_users`$$
CREATE   PROCEDURE `get_list_users`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN
START TRANSACTION;
SET @search_user_name := CONCAT('%',TRIM(_search),'%') ; 
IF _range < 1 THEN
SELECT  * FROM users
WHERE user_active=1   AND (  (user_name LIKE  @search_user_name)  )  ORDER BY user_name ASC ;
ELSE
SELECT  * FROM users
WHERE user_active=1   AND (  (user_name LIKE  @search_user_name)  )  ORDER BY user_name ASC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_list_users_all`$$
CREATE   PROCEDURE `get_list_users_all`()
BEGIN
START TRANSACTION;
SELECT  U.*,G.usergroup_name FROM users U
INNER JOIN usergroup G ON (U.user_usergroup  = G.usergroup_id)
WHERE U.user_active = 1 AND G.usergroup_active;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_list_user_project`$$
CREATE   PROCEDURE `get_list_user_project`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN 
START TRANSACTION;
IF _range < 1 THEN 
SELECT * FROM userproject WHERE userproject_active=1 ORDER BY userproject_id ASC; 
ELSE
SELECT * FROM userproject WHERE userproject_active=1 ORDER BY userproject_id ASC LIMIT _start_by , _range; 
END IF; 
COMMIT; 
END$$

DROP PROCEDURE IF EXISTS `get_list_project`$$
CREATE   PROCEDURE `get_list_project`(IN _start_by INT,IN _range INT, IN _search VARCHAR(500))
BEGIN
START TRANSACTION;
SET @search_project_title := CONCAT('%',TRIM(_search),'%') ;  SET @search_project_description := CONCAT('%',TRIM(_search),'%') ; 
IF _range < 1 THEN
SELECT  * FROM projects
WHERE project_active=1   AND (  (project_title LIKE  @search_project_title)  OR (project_description LIKE  @search_project_description)  )  ORDER BY project_id ASC;
ELSE
SELECT  * FROM projects
WHERE project_active=1   AND (  (project_title LIKE  @search_project_title)  OR (project_description LIKE  @search_project_description)  )  ORDER BY project_id ASC  LIMIT _start_by , _range;
END IF;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_row`$$
CREATE   PROCEDURE `get_row`(IN source varchar(100),IN source_id VARCHAR(100),IN id_value VARCHAR(100))
BEGIN
SET @query = CONCAT("Select * from  ",source ,"  WHERE ", source_id ," = '",id_value,"'");
 PREPARE stmt FROM @query;
 EXECUTE stmt; -- execute statement
 DEALLOCATE PREPARE stmt; -- release the statement memory.
END$$

DROP PROCEDURE IF EXISTS `get_string`$$
CREATE   PROCEDURE `get_string`(IN _text VARCHAR(500),IN _category VARCHAR(30),IN _lang VARCHAR(3))
BEGIN
START TRANSACTION;
SELECT str_id, str_text 
FROM str_management
WHERE str_active=1 AND str_label = _text AND str_category = _category AND str_lang = _lang ;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_config`$$
CREATE   PROCEDURE `remove_config`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE config SET config_active=0
WHERE config_id= _element_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_logs`$$
CREATE   PROCEDURE `remove_logs`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE log SET log_active=0
WHERE log_id= _element_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_str_mng`$$
CREATE   PROCEDURE `remove_str_mng`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE str_management SET str_active=0
WHERE str_id= _element_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_usergroup`$$
CREATE   PROCEDURE `remove_usergroup`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE usergroup SET usergroup_active=0
WHERE usergroup_id= _element_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_users`$$
CREATE   PROCEDURE `remove_users`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE users SET user_active=0
WHERE user_id= _element_id;
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_user_project`$$
CREATE   PROCEDURE `remove_user_project`(IN _element_id INT)
BEGIN START TRANSACTION; UPDATE userproject SET userproject_active=0 WHERE userproject_id= _element_id; COMMIT; END$$

DROP PROCEDURE IF EXISTS `update_config`$$
CREATE   PROCEDURE `update_config`(_element_id INT , _config_id INT , _project_description  VARCHAR(1005) , _default_lang  VARCHAR(16) , _creator INT , _run_setup  VARCHAR(6))
BEGIN
START TRANSACTION;
UPDATE  config SET config_id = _config_id , project_description = _project_description , default_lang = _default_lang , creator = _creator , run_setup = _run_setup
WHERE (config_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `update_logs`$$
CREATE   PROCEDURE `update_logs`(_element_id INT , _log_id INT , _log_user_id INT , _log_time  VARCHAR(205))
BEGIN
START TRANSACTION;
UPDATE  log SET log_id = _log_id , log_user_id = _log_user_id , log_time = _log_time
WHERE (log_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `update_str_mng`$$
CREATE   PROCEDURE `update_str_mng`(_element_id INT , _str_id INT , _str_text  VARCHAR(805))
BEGIN
START TRANSACTION;
UPDATE  str_management SET str_id = _str_id , str_text = _str_text
WHERE (str_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `update_usergroup`$$
CREATE   PROCEDURE `update_usergroup`(_element_id INT , _usergroup_id INT , _usergroup_name  VARCHAR(25) , _usergroup_description  VARCHAR(55))
BEGIN
START TRANSACTION;
UPDATE  usergroup SET usergroup_id = _usergroup_id , usergroup_name = _usergroup_name , usergroup_description = _usergroup_description
WHERE (usergroup_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `update_users`$$
CREATE   PROCEDURE `update_users`(_element_id INT , _user_id INT , _user_name  VARCHAR(55) , _user_mail  VARCHAR(55) , _user_usergroup INT , _user_password  VARCHAR(40) , _user_picture  VARCHAR(205))
BEGIN
START TRANSACTION;
UPDATE  users SET user_id = _user_id , user_name = _user_name , user_mail = _user_mail , user_usergroup = _user_usergroup , user_password = _user_password , user_picture = _user_picture
WHERE (user_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `update_user_project`$$
CREATE   PROCEDURE `update_user_project`(_element_id INT , _userproject_id INT , _user_id INT , _project_id INT, _user_role VARCHAR(55))
BEGIN START TRANSACTION; UPDATE userproject SET userproject_id = _userproject_id , user_id = _user_id , project_id = _project_id , user_role=_user_role WHERE (userproject_id = _element_id); COMMIT; END$$

DROP PROCEDURE IF EXISTS`add_project`$$
CREATE   PROCEDURE `add_project`(_project_id INT , _project_label  VARCHAR(105) , _project_title  VARCHAR(255) , _project_description  VARCHAR(1005) , _project_creator INT , _project_icon  VARCHAR(205))
BEGIN
START TRANSACTION;
INSERT INTO projects (project_label , project_title , project_description , project_creator , project_icon) VALUES (_project_label , _project_title , _project_description , _project_creator , _project_icon);
SELECT project_id AS id_value FROM projects WHERE project_id = LAST_INSERT_ID();
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `get_detail_project`$$
CREATE   PROCEDURE `get_detail_project`(IN _row_id INT)
BEGIN
START TRANSACTION;
SELECT * FROM projects
WHERE project_id= _row_id;
COMMIT;
END$$



DROP PROCEDURE IF EXISTS `update_project`$$
CREATE   PROCEDURE `update_project`(_element_id INT , _project_id INT , _project_label  VARCHAR(105) , _project_title  VARCHAR(255) , _project_description  VARCHAR(1005) , _project_creator INT , _project_icon  VARCHAR(205))
BEGIN
START TRANSACTION;
UPDATE  projects SET project_id = _project_id , project_label = _project_label , project_title = _project_title , project_description = _project_description , project_creator = _project_creator , project_icon = _project_icon
WHERE (project_id = _element_id);
COMMIT;
END$$

DROP PROCEDURE IF EXISTS `remove_project`$$
CREATE   PROCEDURE `remove_project`(IN _element_id INT)
BEGIN
START TRANSACTION;
UPDATE projects SET project_active=0
WHERE project_id= _element_id;
COMMIT;
END$$


DROP PROCEDURE IF EXISTS  get_reference_value $$
CREATE   PROCEDURE  get_reference_value  (IN  _table  VARCHAR(100), IN  _id  VARCHAR(100), IN  _field  VARCHAR(100), IN  _table_id  VARCHAR(100))  BEGIN
SET @query = CONCAT('Select ',_field,' from  ',_table ,'   WHERE ', _table_id, ' = ', _id );
PREPARE stmt FROM @query;
EXECUTE stmt; -- execute statement
DEALLOCATE PREPARE stmt; -- release the statement memory.
END$$