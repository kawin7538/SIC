<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php
	require 'plugin.php'; 
	GetRoot();
	$sql = mysqli_query($status,"select * from log_file order by time desc");
	$sql_null = mysqli_query($status,"select * from log_file");
	$data_null = mysqli_fetch_array($sql_null);
?>
</head>
<body>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
	<legend><div class="header">Log File</div></legend>
	<?php
		if(!empty($data_null)){ ?>
			<br />
			<table class="table table-bordered">
			<tr><td width="50px">ID</td><th>Username</th><th>Page</th><th>Time</th></tr> <?php
			while($data = mysqli_fetch_array($sql)){ 
				echo '<tr>';
				echo '<td>'.$data['ID'].'</td>';
				echo '<td>'.$data['user'].'</td>';
				echo '<td>'.$data['page'].'</td>';
				echo '<td>'.$data['time'].'</td>';
				echo '</tr>';
			}
		}
		else{
			echo '<div class="alert alert-block">ยังไม่มีประวัติการเข้าใช้ในขณะนี้</div>';
		}
	?>
</table>
</div>
<?php require 'footer.php';  ?>
</div>
<?php require 'header.php'; ?>
</body>
</html>
