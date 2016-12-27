<html>
<head>
<title>Update Hours</title>
</head>
<body>
<?php

//if(isset($_POST['submit'])){

	$data_missing = array();

	if(empty($_POST['pin'])){

        	// Adds name to array
        	$data_missing[] = 'pin';

    	} else {

        	// Trim white space from the name and store the name
	      	$pin = trim($_POST['pin']);

 	}
	if(empty($data_missing)){
		$hours = $_POST['hours'];
		if($hours < 0)
			$hours = 0;
        	require_once('mysqli_connect.php');
		$stmt = $dbc->prepare('SELECT hours FROM log WHERE pin = ?');
		$stmt->bind_param('i', $pin);

		$stmt->execute();

		$result = $stmt->get_result();
		if(!$row = $result->fetch_assoc())
			echo "Please enter a Valid Pin<br/>";
		else {
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc()){
				$hours = $row['hours'] + $hours;
			}
		}
		$stmt = $dbc->prepare('UPDATE log SET hours = ?, date = NOW() WHERE pin = ?');
		$stmt->bind_param('ii', $hours, $pin);
		$stmt->execute();

		$stmt = $dbc->prepare('SELECT pin, hours, date FROM log WHERE pin = ?');
		$stmt->bind_param('i', $pin);
		$stmt->execute();

		$result = $stmt->get_result();		
		while($row = $result->fetch_assoc()){
			echo "<b>Pin</b>: " . $pin . "<br/>" .
                        "<b>Total Hours</b>: " . $row['hours'] . "<br/>" .
			"<b>Date Entered</b>: " . $row['date'] . "<br/>";
		}
		if($pin == 2287){
			include('allHours.php');
			echo "Right Click > Save As: <a href=\"export.php\">Download</a><br/>";
		}
		mysqli_close($stmt);
		mysqli_close($dbc);
	} else {

        	echo "You need to enter the following data<br />";

        	foreach($data_missing as $missing){

            	echo "<b>$missing</b><br />";
		}
        }
	echo "<a href=\"index.html\">Back</a>";
//}

?>
</body>
</html>
