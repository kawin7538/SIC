<?php
    /* Connect sql database */
    require 'sic_sql_config.php';

    $sql = mysqli_query($status,'select * from sic_options');
    $num_student = mysqli_fetch_array($sql);
    $studentAll = $num_student['num_student'];
    /* Connect sql database */
    
	$sql = mysqli_query($status,"select count(*) as count from data_std");
	$data = mysqli_fetch_array($sql);
    $json_data[]=array(
        "value"=>$data['count']+0,
        "color"=>"#FF7400"
        );   
    $json_data[]=array(
        "value"=>$studentAll-$data['count'],
        "color"=>"#009999"
        );  
	/* 1000 is student in school */
	$json = json_encode($json_data);
	echo $json;
?>