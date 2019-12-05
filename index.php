
<html>
	<head>
		<title>NodeMCU ESP8266 MySQL Database</title>
		<style>
		html, body{
			background-color: #F2F2F2;
			font-family: Arial;
			font-size: 1em;
		}
		table{
			border-spacing: 0;
			border-collapse: collapse;
			margin: 0 auto;
		}
		th{
			padding: 8px;
			background-color: #FF837A;
			border: 1px solid #FF837A;
		}
		td{
			padding: 10px;            
			background-color: #FFF;
			border: 1px solid #CCC;
		}
		
		div.notes{
			font-family: arial;
			text-align: center;
		}
		
		div.current{
			font-size: 58px;
			font-family: arial black;
			text-align: center;
		}
		</style>
	</head>
	<body>
		<?php	
			// Database credentials.
			$servername = "moisturedb.cwrfq2qg1ffh.us-east-1.rds.amazonaws.com";
			$username = "root";
			$dbname = "mySchema";
			$password = "dbmoisture";
			// Number of entires to display.
			$display = 150;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the values
			$result = mysqli_query($conn, "SELECT * FROM mySchema.myTable ORDER BY id desc");
        
            // Print number of entries in the database. Replace YOUR_TABLE_NAME with your database table name.
			$row_cnt = mysqli_num_rows(mysqli_query($conn, "SELECT date FROM mySchema.myTable"));
			echo "<div class='notes'>The database table has " . $row_cnt . " total entries.</div><br/>";

            echo "<table><tr><th>Id</th><th>Date</th><th>Time</th><th>Moisture Value</th><th>Motor Status</th></tr>";
			while($row = mysqli_fetch_assoc($result)) {				
				echo "<tr><td>";
               			 echo $row["id"];
                		echo "</td><td>";				
				echo $row["Date"];
				echo "</td><td>";
				echo $row["Time"];
				echo "</td><td>";
                		echo $row["mvalue"];
				echo "</td><td>";
				echo $row["motorStatus"];
				echo "</td></tr>";
			}
			echo "</table>";
			
			
			// Close connection.
			mysqli_close($conn);
		?>
	</body>
</html>
