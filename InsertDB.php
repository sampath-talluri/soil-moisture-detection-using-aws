<?php
//Creates new record as per request
    //Connect to database
    $servername = "moisturedb.cwrfq2qg1ffh.us-east-1.rds.amazonaws.com";		
    $username = "root";		
    $password = "dbmoisture";	
    $dbname = "mySchema";
   
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get current date and time
    //date_default_timezone_set('Asia/Jakarta');
    $d = date("Y-m-d");
    $t = date("H:i:s");

    if(!empty($_POST['svalue']))
    {
	$readvalue = $_POST['svalue'];
        
        if ($readvalue >= "700") {
            $motor = "ON";
        } else{
            $motor = "OFF";
        }
	    $sql = "INSERT INTO mySchema.myTable (mvalue, Date, Time, motorStatus) VALUES ('".$readvalue."', '".$d."', '".$t."', '".$motor."')"; 

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$conn->close();
?>

