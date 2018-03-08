<?php
    /* Connect sql database */
	require 'sic_sql_config.php';
    /* Connect sql database */
    
	$sql = mysqli_query($status,"select count(*) as data_count from data_sbj where member >= limit_member");
	$data = mysqli_fetch_array($sql);
    $json_data[]=array(
        "value"=>$data['data_count']+0,
        "color"=>"#FF7400"
        );   
    $sql = mysqli_query($status,"select count(*) as data_count from data_sbj");
	$data_second = mysqli_fetch_array($sql);
    $json_data[]=array(
        "value"=>$data_second['data_count']-$data['data_count'],
        "color"=>"#009999"
        );  
	$json = json_encode($json_data);
	echo $json;
?>