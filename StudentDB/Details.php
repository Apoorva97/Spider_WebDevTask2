<html>
	<head>
			<title>Edit Details</title>
	</head>

	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "myStudent";

			$conn = mysqli_connect($servername, $username, $password,$dbname);

			if (!$conn) 
			{	die("Connection failed: " . mysqli_connect_error());	}
 			
 			$rollcheck=$rollErr="";

  			
  				if (empty($_POST["RollNumber"]))
			    	{		$rollErr = "Roll Number is mandatory";	}
			    else
      				{		$rollcheck = test_input($_POST["RollNumber"]);
                        if (strlen($rollcheck)!=9 || !preg_match("/^[0-9]*$/",$rollcheck))
                            {	$rollErr = "Should be a 9-digit number";	}
      				}
      		

  			function test_input($data)
			{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
			}

			$sql = "SELECT Name,Rollno,Dept,Email,Address,Description FROM Student WHERE Rollno=$rollcheck";
			$result = mysqli_query($conn,$sql);
	
			if (mysqli_num_rows($result)>0)
			{	while($row = mysqli_fetch_assoc($result))
			{	echo "Name:".$row["Name"]."</br>"."Rollno:".$row["Rollno"]."</br>"."Department:".$row["Dept"]."</br>"."Email:".$row["Email"]."</br>"."Address:".$row["Address"]."</br>"."Description:".$row["Description"]."</br>";}	}
			else echo "Invalid number";	

		?>
	
		<input type="button" value="Edit" onclick="EditDetails()"/>
		<script language="javascript" type="text/javascript">
	function EditDetails()
	{
		window.location="Edit.php";
	}
</script>
</body>
</html>