#SIC Project
﻿
﻿Config SIC Project
  - Install Wordpress
  - Create database and link it using 'app/install.php'
  - create column permission at wp-users
      `ALTER TABLE  wp_users ADD  permission INT NOT NULL DEFAULT 0`;
  - edit value column 'permission' where admin' value
      `UPDATE wp_users SET permission = 2 where user_login = 'admin'`;
  - add query `ALTER TABLE `data_club` CHANGE `condition_m` `condition_m` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;`
  - edit school's information in admin.php

#1st Developer by Boonyarith Piriyothinkul (https://github.com/chin8628)

#2nd Developer by Kawin Chinpong (https://github.com/kawin7538), 2018
