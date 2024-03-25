<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Find Employee</title>
</head>

<body>
	<h2>Update Employee Record</h2>
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
		$emp_no = $_GET["emp_no"];
		echo "Searching for: " . $emp_no;
	
		echo "<br><br>";
		
		//create the SQL select statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		$sql = "SELECT * FROM employees where emp_no = '".$emp_no."'";
	
		//put the resultset into a variable, again object oriented way of doing things here
		$result = $conn->query($sql);
	
		//if there were no records found say so, otherwise create a while loop that loops through all rows
		//and echos each line to the screen. You do this by creating some crazy looking echo statements
		// in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
		// the dot "." is PHP's string concatenator operator
		if ($result->num_rows > 0){
			//print rows
			while($row = $result->fetch_assoc()){
				echo "Employee Detail: <br><br>" . $row["first_name"]. "<br>" . $row["last_name"]. "<br> " . $row["birth_date"]. "<br> " . $row["hire_date"]. "<br> " .$row["emp_no"]. "<br>";
			}
		} else {
			echo "No Records Found";
		}
		
		//always close the DB connections, don't leave 'em hanging
		$conn->close();
		
?>
<br>
<form action="updateemployeeattr.php">
  <label for="emp_attr">Which attribute to you want to update?</label>
  <select id="emp_attr" name="emp_attr">
    <option value="birth_date">Birth Date</option>
    <option value="hire_date">Hire Date</option>
    <option value="gender">Gender</option>
    <option value="first_name">First Name</option>
    <option value="last_name">Last Name</option>
  </select>
  
  <br><br>
  
  <label for="newval">New value:</label><br>
  <input type="text" id="new_val" name="new_val"><br><br>

  <label for="emp_no">Employee Number</label><br>
  <input type="text" id="emp_no" name="emp_no"><br><br>

  <input type="submit">
</form>
</body>
</html>
