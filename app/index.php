<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php require 'plugin.php'; ?>
</head>

<body>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
	<legend><div class="header">ข้อมูลทั่วไป</div></legend>
	<div class="row">
		<div class="span">
			<div class="well">
				<canvas id="myChart" width="200" height="200"></canvas><br />
				<center>
				<?php
					$sql_count = mysqli_query($status,"select count(*) as data_count from data_std");
					$data_count = mysqli_fetch_array($sql_count);
				?>
					<font color="#FF7400">
				<?php
					echo "ลงทะเบียนเสร็จ : ".$data_count['data_count']." คน<br>";
				?>
					</font>
				<?php
					$data_count['data_count'] = $studentAll - $data_count['data_count'];
				?>
					<font color="#009999">
				<?php
					echo "ยังไม่ได้ลงทะเบียน : ".$data_count['data_count']." คน";
				?>
					</font>
				</center>
			</div>
		</div>
		<div class="span">
			<div class="well">
				<canvas id="myChart_second" width="200" height="200"></canvas><br />
				<center>
				<?php
					$sql_count = mysqli_query($status,"select count(*) as data_count from data_club where member >= limit_member");
					$data_count = mysqli_fetch_array($sql_count);
				?>
					<font color="#FF7400">
				<?php
					echo "ชมรมเต็มแล้ว : ".$data_count['data_count']." ชมรม<br>";
				?>
					</font>
				<?php
					$sql = mysqli_query($status,"select count(*) as data_count from data_club");
					$data_second = mysqli_fetch_array($sql);
					$data_count['data_count'] = $data_second['data_count'] - $data_count['data_count'];
				?>
					<font color="#009999">
				<?php
					echo "ชมรมยังไม่เต็ม : ".$data_count['data_count']." ชมรม";
				?>
					</font>
				</center>
			</div>
		</div>
		<div class="span">
			<div class="well">
				<canvas id="myChart_sbj" width="200" height="200"></canvas><br />
				<center>
				<?php
					$sql_count = mysqli_query($status,"select count(*) as data_count from data_sbj where member >= limit_member");
					$data_count = mysqli_fetch_array($sql_count);
				?>
					<font color="#FF7400">
				<?php
					echo "วิชาเสริมเต็มแล้ว : ".$data_count['data_count']." วิชาเสริม<br>";
				?>
					</font>
				<?php
					$sql = mysqli_query($status,"select count(*) as data_count from data_sbj");
					$data_second = mysqli_fetch_array($sql);
					$data_count['data_count'] = $data_second['data_count'] - $data_count['data_count'];
				?>
					<font color="#009999">
				<?php
					echo "วิชาเสริมยังไม่เต็ม : ".$data_count['data_count']." วิชาเสริม";
				?>
					</font>
				</center>
			</div>
		</div>
	</div>

	<br />
	<legend><div class="header">ข้อมูลส่วนตัว</div></legend>
	<?php
	$id = GetIdUser();
	$sql = mysqli_query($status,"select * from data_std where user = '$id'");
	$data = mysqli_fetch_array($sql);
	if(empty($data))
		echo '<div class="alert alert-error"><b>คุณยังไม่ได้ลงทะเบียน!</b> โปรดลงทะเบียนนักเรียนก่อนใช้งาน <a href="registry.php">ลงทะเบียนทันที</a></div>';
	else{
		echo '<b>ชื่อ-นามสกุล : </b>'.$data['title'].' '.$data['name'].' '.$data['surname'].'<br>';
		echo '<b>ชื่อเล่น : </b>'.$data['nickname'].'<br>';
		echo '<b>เพศ : </b>'.$data['sex'].'<br>';
		echo '<b>ชั้น : </b>'.$data['class'].'<br>';
		echo '<b>เลขที่(ในห้องเรียน) : </b>'.$data['number_class'].'<br>';
		echo '<b>เลขประจำตัวนักเรียน : </b>'.$data['number'].'<br>';
		echo '<b>วันเกิด : </b>'.$data['birthday'].'<br>';
		echo '<b>ที่อยู่ : </b>'.$data['address'].'<br>';
		echo '<b>E-mail : </b>'.$data['email'].'<br>';
		echo '<b>เบอร์โทรติดต่อ : </b>'.$data['phone'].'<br>';

		/* Section : show club */

		$sql = mysqli_query($status,"select * from clubenrollment where idUser = '$id'");
		$data = mysqli_fetch_array($sql);
		if(empty($data)) echo '<span class="label label-warning">Warning</span> คุณยังไม่ได้ลงทะเบียนชมรม<br>';
		else{
			$sql = mysqli_query($status,"select * from clubenrollment where idUser = '$id'");
			echo '<b>ชมรม : </b>';
			while ($data = mysqli_fetch_array($sql)) {
				$temp = $data['club'];
				$input_make_link = mysqli_query($status,"select * from data_club where ID = '$temp'");
				$make_link = mysqli_fetch_array($input_make_link);
				echo '	
					<div id="'.$make_link['ID'].'" class="modal hide fade in" style="display: none; ">  
					<div class="modal-header"><a class="close" data-dismiss="modal">×</a>
					<h3>'.$make_link['club'].'</h3>
					</div>  
					<div class="modal-body">  
					<h4>สมาชิกปัจจุบัน/สมาชิก</h4>
					<p>'.$make_link['member'].'/'.$make_link['limit_member'].'</p>
					<h4>คำอธิบาย</h4>
					<p>'.$make_link['des'].'</p>
					</div>  
					<div class="modal-footer">  
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>  
					</div>
				';
				echo '<a href="#'.$make_link['ID'].'" data-toggle="modal">'.$make_link['club'].'</a> | ';
			}
			echo "<br>";
		}

		/* Section : show Sbj */
		$sql = mysqli_query($status,"select * from sbjenrollment where idUser = '$id'");
		$data = mysqli_fetch_array($sql);
		if(empty($data)) echo '<span class="label label-warning">Warning</span> คุณยังไม่ได้ลงทะเบียนวิชาเสริม';
		else{
			$sql = mysqli_query($status,"select * from sbjenrollment where idUser = '$id'");
			echo '<b>วิชาเสริม : </b>';
			while ($data = mysqli_fetch_array($sql)) {
				$temp = $data['sbj'];
				$input_make_link = mysqli_query($status,"select * from data_sbj where ID = '$temp'");
				$make_link = mysqli_fetch_array($input_make_link);
				echo '	
					<div id="'.$make_link['ID'].'" class="modal hide fade in" style="display: none; ">  
					<div class="modal-header"><a class="close" data-dismiss="modal">×</a>
					<h3>'.$make_link['sbj'].'</h3>
					</div>  
					<div class="modal-body">  
					<h4>สมาชิกปัจจุบัน/สมาชิก</h4>
					<p>'.$make_link['member'].'/'.$make_link['limit_member'].'</p>
					<h4>คำอธิบาย</h4>
					<p>'.$make_link['des'].'</p>
					</div>  
					<div class="modal-footer">  
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>  
					</div>
				';
				echo '<a href="#'.$make_link['ID'].'" data-toggle="modal">'.$make_link['sbj'].'</a> | ';
			}
			echo "<br>";
		}
	}
	?>
</div>
<?php require 'footer.php';  ?>
</div>
<?php require 'header.php'; ?>
<script>
	var ctx = $("#myChart").get(0).getContext("2d");
	//This will get the first returned node in the jQuery collection.
	var myNewChart = new Chart(ctx);
	var dataChart = new Array;
	$.getJSON("genJSON.php", function(x){
        $.each(x, function(k,v){
            dataChart.push({"value": v.value, "color": v.color});
            var option = {
            	animation: true,
            };
			new Chart(ctx).Doughnut(dataChart,option);
        });
    });

	/* Donut number 2 */
    var ctx2 = $("#myChart_second").get(0).getContext("2d");
	//This will get the first returned node in the jQuery collection.
	var myNewChart = new Chart(ctx2);
	var dataChart_Second = new Array;
	$.getJSON("genJSON2.php", function(x){
        $.each(x, function(k,v){
            dataChart_Second.push({"value": v.value, "color": v.color});
            var option = {
            	animation: true,
            };
			new Chart(ctx2).Doughnut(dataChart_Second,option);
        });
    });

    /* Donut number 3 */
    var ctx3 = $("#myChart_sbj").get(0).getContext("2d");
	//This will get the first returned node in the jQuery collection.
	var myNewChart = new Chart(ctx3);
	var dataChart_Sbj = new Array;
	$.getJSON("genJSON3_sbj.php", function(x){
        $.each(x, function(k,v){
            dataChart_Sbj.push({"value": v.value, "color": v.color});
            var option = {
            	animation: true,
            };
			new Chart(ctx3).Doughnut(dataChart_Sbj,option);
        });
    });
</script>
</body>
</html>
