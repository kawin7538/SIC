<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php
	require 'plugin.php';
	GetRoot();
	require '../wp-includes/pluggable.php'; 
?>
</head>

<body>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
	<legend><div class="header">Control Panel</div></legend>
	
	<!-- Row 1 -->
	<div class="row">
		<div class="span">
			<p><h4>จัดการสิทธิครู</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<input type="text" name="userGetPerm"></input><br>
					<button name="add" value='yes' type="submit" class="btn btn-primary">เพิ่มสิทธิ์</button>
					<button name="del" value='yes' type="submit" class="btn btn-inverse">ลบสิทธิ์</button>
				</form>
			</div>
		</div>
		<div class="span">
			<p><h4>จำนวนนักเรียน</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<input type="text" name="num_student" value="<?php echo $studentAll; ?>"></input><br>
					<button name="add_num_student" value='yes' type="submit" class="btn btn-primary">บันทึก</button>
				</form>
			</div>
		</div>
		<div class="span">
			<p><h4>ชมรมที่สมัครได้สูงสุดต่อนักเรียนหนึ่งคน</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<input type="text" name="max_club" value="<?php echo $max_club; ?>"></input><br>
					<button name="add_max_club" value='yes' type="submit" class="btn btn-primary">บันทึก</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Row 2 -->
	<div class="row">
		<div class="span">
			<p><h4>วิชาที่สมัครได้สูงสุดต่อนักเรียนหนึ่งคน</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<input type="text" name="max_sbj" value="<?php echo $max_sbj; ?>"></input><br>
					<button name="add_max_sbj" value='yes' type="submit" class="btn btn-primary">บันทึก</button>
				</form>
			</div>
		</div>
		<div class="span">
			<p><h4>เปิด-ปิด การลงทะเบียนชมรม</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<?php 
						if($club_maintenance_mode == 0) echo '<button name="club_maintenance_button" value="on" type="submit" class="btn btn-danger">ปิดการลงทะเบียนชมรม</button>';
						else if($club_maintenance_mode == 1) echo '<button name="club_maintenance_button" value="off" type="submit" class="btn btn-success">เปิดการลงทะเบียนชมรม</button>';
					?>
				</form>
			</div>
		</div>
		<div class="span">
			<p><h4>เปิด-ปิด การลงทะเบียนวิชาเสริม</h4></p>
			<div class="well">
				<form method="post" onsubmit="return confirm('โปรดเช็คให้มั่นใจ')">
					<?php 
						if($subject_maintenance_mode == 0) echo '<button name="subject_maintenance_button" value="on" type="submit" class="btn btn-danger">ปิดการลงทะเบียนวิชาเสริม</button>';
						else if($subject_maintenance_mode == 1) echo '<button name="subject_maintenance_button" value="off" type="submit" class="btn btn-success">เปิดการลงทะเบียนวิชาเสริม</button>';
					?>
				</form>
			</div>
		</div>
	</div>

	<!-- Row 3 -->
	<div class="row">
		<div class="span">
			<p><h4>จัดการฐานข้อมูล</h4></p>
			<div class="well">
				<a href="#myModal" role="button" class="btn btn-danger" data-toggle="modal">Clear Database.</a>
			</div>
		</div>
	</div>

	<!-- MODAL verify user to clear DB -->

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    	<h3 id="myModalLabel">ยืนยันรหัสผ่าน</h3>
	  	</div>
	  	<div class="modal-body">
		  	<div class="alert alert-error">
			 	คุณจะไม่สามารถกู้คืนข้อมูลที่ถูกล้างนี้ได้ โปรดเช็คให้มั่นใจ
			</div>
			    <p>โปรดใส่รหัสผ่านสำหรับผู้ดูแลระบบเพื่อล้างฐานข้อมูลนักเรียนทั้งหมด นี้เป็นขั้นตอนเพื่อความโปรดภัย</p>
			    <form method="post" name"drop" onsubmit="return confirm('คุณต้องการที่จะลบข้อมูลหรือไม่');">
			    Password: <input type="password" name="pass"></input>
		  	</div>
		  	<div class="modal-footer">
		  		<button type="submit" class="btn btn-primary">ตกลง</button>
			    <button class="btn" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
		    	</form>
		 	</div>
		</div>
	</div>

	<!-- END : MODAL verify user to clear DB : END-->

	<?php require 'footer.php';  ?>
</div>
<?php require 'header.php'; ?>
</body>
</html>
<script type="text/javascript">
	function entsub(dr) {
  		if (window.event && window.event.keyCode == 13)
    		drop.submit();
  		else
	    	return true;
	}
</script>
<?php
$user = get_user_by( 'login', 'admin');
$password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
if($password != NULL){
	if($user && wp_check_password( $password , $user->data->user_pass)){
		mysqli_query($status,"TRUNCATE log_file") or die("Error Sql Database!");
		mysqli_query($status,"TRUNCATE data_std") or die("Error Sql Database!");
		mysqli_query($status,"TRUNCATE data_sbj") or die("Error Sql Database!");
		mysqli_query($status,"TRUNCATE data_club") or die("Error Sql Database!");
		mysqli_query($status,"TRUNCATE clubenrollment") or dide("Error Sql Database!");
		mysqli_query($status,"TRUNCATE sbjenrollment") or die("Error Sql Database!");
		echo '<script>alert("ล้างข้อมูลสำเร็จแล้ว");</script>';
	}
	else{
		echo '<script>alert("รหัสผิดพลาด โปรดใส่รหัสอีกครั้ง.");</script>';	
	}
}

if($_POST['userGetPerm'] != NULL){
	$userGet = htmlspecialchars($_POST['userGetPerm'], ENT_QUOTES);
	if($_POST['add'] == 'yes'){
		$query = "update wp_users set permission='1' where user_login='".$userGet."'";
		mysqli_query($status,$query);
		echo '<script>alert("เพิ่มสิทธิ์สำเร็จแล้ว");</script>';
	}
	else if($_POST['del'] == 'yes'){
		$query = "update wp_users set permission='0' where user_login='".$userGet."'";
		mysqli_query($status,$query);
		echo '<script>alert("ลบสิทธิ์สำเร็จแล้ว");</script>';
	}
}

if($_POST['num_student'] != NULL){
	if($_POST['add_num_student'] == 'yes'){
		$num_student = htmlspecialchars($_POST['num_student'], ENT_QUOTES);
		$query = "update sic_options set num_student='".$num_student."'";
		mysqli_query($status,$query);
		echo '<script>alert("แก้ไขจำนวนนักเรียนสำเร็จแล้ว");</script>';
		echo '<script>window.location.href="admin.php"</script>';
	}
}

if($_POST['max_club'] != NULL){
	if($_POST['add_max_club'] == 'yes'){
		//It has var's name 'max_club' already in plugins.php
		$limit_club = htmlspecialchars($_POST['max_club'], ENT_QUOTES);
		$query = "update sic_options set max_club='".$limit_club."'";
		mysqli_query($status,$query);
		echo '<script>alert("แก้ไขจำนวนชมรมสูงสุดที่นักเรียนจะสมัครได้สำเร็จแล้ว");</script>';
		echo '<script>window.location.href="admin.php"</script>';
	}
}

if($_POST['max_sbj'] != NULL){
	if($_POST['add_max_sbj'] == 'yes'){
		//It has var's name 'max_sbj' already in plugins.php
		$limit_sbj = htmlspecialchars($_POST['max_sbj'], ENT_QUOTES);
		$query = "update sic_options set max_sbj='".$limit_sbj."'";
		mysqli_query($status,$query);
		echo '<script>alert("แก้ไขจำนวนชมรมสูงสุดที่นักเรียนจะสมัครได้สำเร็จแล้ว");</script>';
		echo '<script>window.location.href="admin.php"</script>';
	}
}

if($_POST['club_maintenance_button'] != NULL){
	if($_POST['club_maintenance_button'] == 'on'){
		$query = "update sic_options set club_maintenance_mode='1'";
		mysqli_query($status,$query);
		echo '<script>alert("ปิดการลงทะเบียนชมรมได้สำเร็จแล้ว");</script>';
	}
	else if($_POST['club_maintenance_button'] == 'off'){
		$query = "update sic_options set club_maintenance_mode='0'";
		mysqli_query($status,$query);
		echo '<script>alert("เปิดการลงทะเบียนชมรมได้สำเร็จแล้ว");</script>';
	}
	echo '<script>window.location.href="admin.php"</script>';
}

if($_POST['subject_maintenance_button'] != NULL){
	if($_POST['subject_maintenance_button'] == 'on'){
		$query = "update sic_options set subject_maintenance_mode='1'";
		mysqli_query($status,$query);
		echo '<script>alert("ปิดการลงทะเบียนวิชาเสริมได้สำเร็จแล้ว");</script>';
	}
	else if($_POST['subject_maintenance_button'] == 'off'){
		$query = "update sic_options set subject_maintenance_mode='0'";
		mysqli_query($status,$query);
		echo '<script>alert("เปิดการลงทะเบียนวิชาเสริมได้สำเร็จแล้ว");</script>';
	}
	echo '<script>window.location.href="admin.php"</script>';
}
?>