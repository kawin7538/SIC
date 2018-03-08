#SIC Project
﻿
﻿Config SIC Project
  - Install Wordpress
  - Create database and link it using 'app/install.php'
  - create column permission at wp-users
      `ALTER TABLE  wp_users ADD  permission INT NOT NULL DEFAULT 0`;
  - edit value column 'permission' where admin' value
      `UPDATE wp_users SET permission = 2 where user_login = 'admin'`
  - edit school's information in admin.php

#1st Developer by Boonyarith Piriyothinkul (https://github.com/chin8628)

#2nd Developer by Kawin Chinpong (https://github.com/kawin7538), 2018
