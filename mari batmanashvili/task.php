<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1</title>
</head>
<body>

<?php  
$fnameErr = $lnameErr = $imageErr = "";  
$fname = $lname = $img_name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {  

    if (empty($_POST["fname"])) {  
        $fnameErr = "First Name is required";  
    } else {   
        $fname = $_POST["fname"];
        if (!preg_match("/^[A-Za-z]+$/",$fname)) {  
            $fnameErr = "Only alphabets are allowed";  
        }  
    }  

    if (empty($_POST["lname"])) {  
        $lnameErr = "Last Name is required";  
    } else {  
        $lname = $_POST["lname"];
        if (!preg_match("/^[A-Za-z]+$/",$lname)) {  
            $lnameErr = "Only alphabets are allowed";  
        }  
    }

    if ($_FILES['image']['name'] == "") {
        $imageErr = "Image is required";
    } else {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $img_tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($img_tmp_name, "images/$img_name");
    }

}  

?>  

<form method="post" action="task.php" enctype="multipart/form-data">    
    First Name:   
    <input type="text" name="fname">  
    <span><?php echo $fnameErr; ?> </span>  
    <br><br>  
    Last Name:   
    <input type="text" name="lname">  
    <span><?php echo $lnameErr; ?> </span>  
    <br><br> 
    <input type="file" name="image">
    <br><br>                       
    <input type="submit" name="submit" value="Submit">   
    <br><br>                             
</form>  

<?php  
    if(isset($_POST['submit'])) {  
        if($fnameErr == "" && $lnameErr == "" && $imageErr == "") {  
            echo "<h2>Hello </h2>";  
            echo "<h3>First Name: " .$fname.'</h3>';  
            echo "<br>";  
            echo "<h3>Last Name: " .$lname.'</h3>';
            echo "<br>";
            ?>
            <img src="images/<?php echo $img_name ?>" alt="">
            <?php
        } else {  
        echo "<h3><b>Please fill in all the fields.</b></h3>";  
        }
    }  
?>  

</body>  
</html>