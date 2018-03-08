#SIC Project
﻿
﻿Config SIC Project
  - Install Wordpress
  - open "install.php" and setting database config **PLEASE INSTALL IT**(From Someone in the world) 
  - create column permission at wp-users
      `ALTER TABLE  wp_users ADD  permission INT NOT NULL DEFAULT 0`;
  - edit value column 'permission' where admin' value
      `UPDATE wp_users SET permission = 2 where user_login = 'admin'`
  - edit school's information in admin.php
