<?php  
    $servername="localhost";
    $username="root";
    $password="";
    $db_name="exam_registration";

    $conn=new mysqli($servername,$username,$password,$db_name);
    if($conn->connect_error){
        die("Connectiton Failed" . $conn->connect_error);
    }

    $success=false;

    $name=$email=$course=$rollno="";
    $nameErr=$emailErr=$courseErr=$rollnoErr="";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(empty($_POST["name"])){
            $nameErr="Name must be required";
        }
        else{
            $name=htmlspecialchars($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                $nameErr="Name only contain letters and spaces";
            }
        }

        if(empty($_POST["email"])){
            $emailErr="Email must required" ;
        }
        else{
            $email=htmlspecialchars($_POST["email"]);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr="Invalid email format ";
            }
        }

        if(empty($_POST["course"])){
            $courseErr="Course must filled";
        }
        else{
            $course=htmlspecialchars($_POST["course"]);
        }

        if(empty($_POST["rollno"])){
            $rollnoErr="Rollno must filled";
        }
        else{
            $rollno=htmlspecialchars($_POST["rollno"]);
            if(!preg_match("/^[0-9]{4,10}$/",$rollno)){
                $rollnoErr="Rollno must be greater than 3 digit and less than 10 digit number ";
            }
        }

        if(($_SERVER["REQUEST_METHOD"]=="POST") && empty($nameErr) && empty($emailErr) && empty($courseErr) && empty($rollnoErr)){
            
            $success=true;

            $stmt=$conn->prepare("INSERT INTO registrations (name,email,course,rollno) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss",$name,$email,$course,$rollno);

            if($stmt->execute()){
                $successMessage="Registration Successfully";
                $name=$email=$course=$rollno="";
            }
            else{
                echo "<p style='color: red; text-align: center;'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6dd5fa, #ffffff);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="text-align: center;"> Student Exam Registration Form</h2>
        <?php if ($success) echo "<p class='success'>$successMessage</p>"; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

            <input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter Name "> <br>
            <div class="error"><?php echo $nameErr ?></div>

            <input type="email" name="email" value="<?php echo $email ?>" placeholder="Enter email "> <br>
            <div class="error"><?php echo $emailErr ?></div>

            <input type="text" name="course" value="<?php echo $course ?>" placeholder="Enter course "> <br>
            <div class="error"><?php echo $courseErr ?></div>

            <input type="text" name="rollno" value="<?php echo $rollno ?>" placeholder="Enter Rollno "> <br>
            <div class="error"><?php echo $rollnoErr ?></div>

            <input type="submit" name="submit" value="Register">
            
        </form>
    </div>
</body>
</html>