
			<?php
				$status = mysqli_connect("HOST","USERNAME","PASSWORD","DATABASE") or die("Cannot Connect Database");
				if(!$status) die("Could not connect: " . mysqli_error());
				mysqli_query($status,"SET NAMES utf8"); 
			?>
			