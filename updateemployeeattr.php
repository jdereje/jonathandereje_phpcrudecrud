<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Find Employee</title>
</head>

<body>
	<h2>Employee Updated</h2>
	<hr>
<?php

                //access credentials fils
                include 'credentials.php';
		
		//this is the php object oriented style of creating a mysql connection
		$conn = new mysqli($servername, $username, $password, $dbname);  
	
		//check for connection success
		if ($conn->connect_error) {
			die("MySQL Connection Failed: " . $conn->connect_error);
		}
		echo "MySQL Connection Succeeded<br><br>";
		
		//pull the attribute that was passed with the html form GET request and put into a local variable.
		$emp_attr = $_GET["emp_attr"]; // "birth_date"
		$new_val = $_GET["new_val"];   // "1979-05-12"
                $emp_no = $_GET["emp_no"];     // 500000

		//echo $emp_attr;
		//echo $new_val;
		//echo $emp_no;

		echo "Updating: " . $emp_attr . " to " . $new_val;
	
		echo "<br><br>";
		
		//create the SQL select statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		$sql = "UPDATE employees SET ".$emp_attr." = '".$new_val."' where " . "id" . " = '".$emp_no."'";

		//run the update
                if ($conn->query($sql) === TRUE){

                        echo "Update Completed";

                } else {

                        echo "Error: " . $sql . "<br>" . $conn->error;

                }	
		
		//always close the DB connections, don't leave open 
		$conn->close();
		
?>
<br><br>
<a href="index.html" title="Home" target="_parent">Home Page</a>
</body>
</html>
