<html>
    <head>
        <title>Edit Details</title>
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
            {   die("Connection failed: " . mysqli_connect_error());    }

            $nameErr=$deptErr=$emailErr=$addErr=$descErr=$passErr="";
            $name=$dept=$email=$add=$desc=$passcode="";

            if ($_SERVER["REQUEST_METHOD"]=="POST")
            {
                if (empty($_POST["Name"])) 
                    {       $nameErr = "Name is mandatory"; }   
                else
                    {       $name = test_input($_POST["Name"]); 
                        if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
                            {   $nameErr = "Only letters and white space allowed";  }
                    }
        
                            $dept = test_input($_POST["Dept"]); 
                if (empty($_POST["Email"]))
                    {       $emailErr = "Email is mandatory";   }
                else
                    {       $email = test_input($_POST["Email"]);
                        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                            {   $emailErr = "Invalid email format"; }
                            else if (!strpos($email,"@nitt.edu",strlen($email)-strlen("@nitt.edu")))
                            {   $emailErr = "Invalid email format"; }
                    }
                if (empty($_POST["Address"]))
                    {       $addErr = "Address is mandatory";   }
                else
                    {       $add = test_input($_POST["Address"]);   }
                if (empty($_POST["Description"]))
                    {       $desc = ""; }
                else
                    {       $desc = test_input($_POST["Description"]);  }
                if (empty($_POST["Passcode"]))
                    {       $passErr = "Passcode is mandatory";     }
                else
                    {       $passcode=$_POST["Passcode"];       }
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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <span class="error">* required field.</span>
        </br>
            Name : <input type="text" name="Name"/>
               <span class="error">* <?php echo $nameErr;?></span>
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
                        <textarea rows="5" cols="50" name="Description">
                        </textarea>
                </br>
                </br>
            Passcode : <input type="text" name="Passcode"/>
                <span class="error">* <?php echo $passErr;?></span>
                </br>
                </br>
            <input type="submit" name="submit" value="Submit"/>
        </form>
        <?php
        if ($flag==1)
        {
        $sql = "SELECT * FROM Student WHERE Passcode='$passcode'";
        $retval = mysqli_query($conn,$sql);
        if (mysqli_num_rows($retval)>0)
        {
        $sql = "UPDATE Student SET Name='$name',Dept='$dept',Email='$email',Address='$add',Description='$desc' WHERE Passcode='$passcode'";
        mysqli_query($conn,$sql);
        if (mysqli_query($conn,$sql))
        {   echo "Record Updated Successfully"; }
        else
        {   echo "Error Updating Record:Invalid Passcode";  }
        }
        else
        echo "Invalid Passcode";
        }
        mysqli_close($conn);
        ?>
</html>