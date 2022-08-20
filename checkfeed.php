<?php
    $myconn = new mysqli("localhost","root","","feedback1");

	if(!empty($_GET['feedid'])){
		  if ($stmt = $myconn->prepare("SELECT count(*),user FROM `feedssubmitted` WHERE feed_id=? group by user ORDER BY count(*),user ASC")) {
			  $stmt->bind_param("s",$_GET['feedid']);
				
			   if($stmt->execute()){

				$stmt->bind_result($counts,$users);

				echo "<table border=1 cellpadding=10>";
				$i = 0;
				while ($stmt->fetch()) {
				  echo '<tr><td>'.$users.'</td><td>'.$counts.'</td></tr>';
					$i++;
				}
				echo "<tr><th colspan=2>Total : ".$i."</th></tr>";
				echo "</table>";
			   }
		  }
	}else{
		echo "GET";
	}
	
	
?>