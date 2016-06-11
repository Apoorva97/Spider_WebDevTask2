<html>
	<head>
			<title>Student Form</title>
			<style>
				.error {color:#FF0000;}
			</style>
	</head>

	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "myStudent";
        	$flag=0;

			$conn = mysqli_connect($servername, $username, $password,$dbname);

			if (!$conn) 
			{	die("Connection failed: " . mysqli_connect_error());	}

			$nameErr=$rollnoErr=$deptErr=$emailErr=$addErr=$descErr="";
			$name=$rollno=$dept=$email=$add=$desc="";

			if ($_SERVER["REQUEST_METHOD"]=="POST")
			{
				if (empty($_POST["Name"])) 
					{		$nameErr = "Name is mandatory";	}	
				else
			    	{		$name = test_input($_POST["Name"]);	
			    		if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
			   				{	$nameErr = "Only letters and white space allowed";	}
			    	}
			    if (empty($_POST["RollNumber"]))
			    	{		$rollnoErr = "Roll Number is mandatory";	}
			    else
      				{		$rollno = test_input($_POST["RollNumber"]);
                        if (strlen($rollno)!=9 || !preg_match("/^[0-9]*$/",$rollno))
                            {	$rollnoErr = "Should be a 9-digit number";	}
      				}
			    			$dept = test_input($_POST["Dept"]);	
				if (empty($_POST["Email"]))
					{		$emailErr = "Email is mandatory";	}
				else
					{		$email = test_input($_POST["Email"]);
                        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                            {	$emailErr = "Invalid email format";	}
                            else if (!strpos($email,"@nitt.edu",strlen($email)-strlen("@nitt.edu")))
					  		{	$emailErr = "Invalid email format";	}
					}
				if (empty($_POST["Address"]))
					{		$addErr = "Address is mandatory";	}
		        else
					{		$add = test_input($_POST["Address"]);	}
				if (empty($_POST["Description"]))
					{		$desc = "";	}
				else
					{		$desc = test_input($_POST["Description"]);	}
	         $flag=1;
			}

			function test_input($data)
			{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
			}
 				
 			
 			

		?>
		<span class="error">* required field.</span>
		<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			Name : <input type="text" name="Name"/>
				<span class="error">* <?php echo $nameErr;?></span>
				</br>
				</br>
			Roll Number : <input type="text" name="RollNumber"/>
				<span class="error">* <?php echo $rollnoErr;?></span> 
				</br>
				</br>
			Department : <select name="Dept">
    						<option value="ARCH" selected>Architecture</option>
    						<option value="CHEM">Chemical Engineering</option>
    						<option value="CIV">Civil Engineering</option>
    						<option value="CSE">Computer Science & Engineering</option>
    						<option value="EEE">Electrical & Electronics Engineering</option>
    						<option value="ECE">Electronics & Communication Engineering</option>
    						<option value="ICE">Instrumentation & Control Engineering</option>
    						<option value="MECH">Mechanical Engineering</option>
    						<option value="MME">Metallurgy and Materials Engineering</option>
    						<option value="PROD">Production Engineering</option>
    					 </select>
      			</br>
    			</br>
    		Email Address : <input type="text" name="Email"/>
    			<span class="error">* <?php echo $emailErr;?></span>
    			</br>
    			</br>										
    		Residential Address : <input type="text" name="Address"/>
    			<span class="error">* <?php echo $addErr;?></span>
    			</br>
    			</br>
    		About you : </br>
    					<span class="error"><?php echo $descErr;?></span>
    		            <textarea rows="5" cols="50" name="Description">
    					</textarea>
    			</br>
    			</br>
    		<input type="submit" name="submit" value="Submit"/>
    	</form>

    	<?php 

    		
    		$chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=;:'<,>.?/{[}]\|";
    		$passcode = substr(str_shuffle($chars),0,8); 
            
            if ($flag==1 && (strcmp("",$nameErr)==0) && (strcmp("",$rollnoErr)==0) && (strcmp("",$deptErr)==0) && (strcmp("",$emailErr)==0) && (strcmp("",$addErr)==0) && (strcmp("",$descErr)==0))
            {
    		$sql = "INSERT INTO Student(Name,Rollno,Dept,Email,Address,Description,Passcode) VALUES('$name',$rollno,'$dept','$email','$add','$desc','$passcode')";
			if (mysqli_query($conn, $sql)) 
			{	echo "Passcode :".$passcode;	}
			else 
			{	echo "Error in the data: " . mysqli_error($conn);	}
            }
			mysqli_close($conn);
    	?>
    </body>
</html>  