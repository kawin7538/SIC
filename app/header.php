<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<script src="js/bootstrap.js"></script>
<div id="header">
<div class="navbar navbar-static-top navbar-inverse">
  <div class="navbar-inner dropdown">
    <a class="brand" href="index.php">SIC Project</a>
    <ul class="nav">
      <li id="indexnav"><a href="index.php"><i class="icon-home icon-white"></i> หน้าแรก</a></li>
      <li id="registernav" class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-pencil icon-white"></i> ลงทะเบียน<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="registry.php">ลงทะเบียนนักเรียน</a></li>
          <li><a href="regis_club.php">ลงทะเบียนชมรม</a></li>
          <li><a href="regis_sbj.php">ลงทะเบียนรายวิชาเสริม</a></li>
        </ul>
      </li>
      <?php if(GetPermission()){ ?>
        <li id="adminnav" class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench icon-white"></i> จัดการ<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="liststd.php">จัดการนักเรียน</a></li>
          <li class="divider"></li>
          <li><a href="liststd_club.php">รายชื่อนักเรียนของชมรม</a></li>
          <li><a href="manage_club.php">จัดการชมรม</a></li>
          <li><a href="add_club.php">เพิ่มชมรม</a></li>
          <li class="divider"></li>
          <li><a href="liststd_sbj.php">รายชื่อนักเรียนของวิชาเสริม</a></li>
          <li><a href="manage_sbj.php">จัดการวิชาเสริม</a></li>
          <li><a href="add_sbj.php">เพิ่มวิชาเสริม</a></li>
        </ul>
        </li>
      <?php } ?>
      <?php if(GetPermission() == 2){ ?>
          <li id="adminnav" class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> Admin<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li id="rootnav"><a href="admin.php">Control Panel</a></li>
            <li id="rootnav"><a href="check_log.php">Log File</a></li>
          </ul>
          </li>
      <?php } ?>
    </ul>
    <ul class="nav pull-right">
          <li><a href="<?php echo wp_logout_url(home_url());?>"><i class="icon-off icon-white"></i> Logout</a></li>
        </ul>
  </div>
</div>
</div>
<?php
  $get_url = $_SERVER['REQUEST_URI'];
  if($get_url == '/database_student/app/index.php'){ ?>
    <script>
      $('#indexnav').addClass('active');
      $('a[href$="/database_student/app/"]').attr('href', '#'); 
    </script>
<?php }
  else if($get_url == '/database_student/app/registry.php' || $get_url == '/database_student/app/regis_club.php'){ ?>
    <script>
      $('#registernav').addClass('active');
      $('a[href$="/database_student/app/"]').attr('href', '#'); 
    </script>
<?php }
  else if($get_url == '/database_student/app/liststd_club.php' || $get_url == '/database_student/app/liststd.php' || $get_url == '/database_student/app/manage_club.php' || $get_url == '/database_student/app/add_club.php'){ ?>
    <script>
      $('#adminnav').addClass('active');
      $('a[href$="/database_student/app/"]').attr('href', '#'); 
    </script>
<?php }
  else if($get_url == '/database_student/app/check_log.php'){ ?>
    <script>
      $('#rootnav').addClass('active');
      $('a[href$="/database_student/app/"]').attr('href', '#'); 
    </script>
<?php } ?>