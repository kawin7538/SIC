<?php
	$sql = mysqli_query($status,"select * from sbjenrollment inner join data_std on sbjenrollment.idUser = data_std.user where sbjenrollment.sbj = '".$sbj."'");
    $sql_count = mysqli_query($status,"select count(*) from sbjenrollment where sbj = '".$sbj."'");
    $sql_name = mysqli_query($status,"select data_sbj.sbj from sbjenrollment,data_sbj where sbjenrollment.sbj = '".$sbj."' and data_sbj.ID = '".$sbj."'");
    $data_name = mysqli_fetch_array($sql_name);
    $data_count = mysqli_fetch_array($sql_count);
?>

<page style="font-family: freeserif;" backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
	<div style="text-align: center;">
		<h3><?php echo $data_name['sbj'] ?></h3>
	</div>
	<br>
	<table align="center" style=" width: 100%;">
		<tr>
		  	<th style="width: 25px;" align="left"></th>
		  	<th style="width: 40%;" align="left">ชื่อ-นามสกุล</th>
		  	<th style="width: 10%;" align="left">ชื่อเล่น</th>
		  	<th style="width: 8%;"align="left">ชั้น</th>
		  	<th style="width: 8%;"align="left">เลขที่</th>
		  	<th style="width: 20%;"align="left">เบอร์โทรติดต่อ</th>
		</tr>
		<?php
			$i = 1;
		    while($data_std = mysqli_fetch_array($sql)){
		        echo '<tr>';
		        echo '<td>'.$i.'</td>';
		        echo '<td>'.$data_std['title'].' '.$data_std['name'].' '.$data_std['surname'].'</td>';
		        echo '<td>'.$data_std['nickname'].'</td>';
		        echo '<td>'.$data_std['class'].'</td>';
		        echo '<td>'.$data_std['number_class'].'</td>';
		        echo '<td>'.$data_std['phone'].'</td>';
		        echo '</tr>';
		        $i+=1;
		  	}
		?>
	</table>
	<br>
	<div style="text-align: center;">
		รวมสมาชิกชมรม <?php echo $data_count['count(*)']; ?> คน
	</div>
</page>