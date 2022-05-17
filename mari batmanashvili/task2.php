<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="task2.css">
    <title>Document</title>
</head>
<body>
<?php
$manipulation=0;
$follower_manipulation=0;

if(isset($_POST['submit']))
{
    if(empty($_POST['name']))
    {
       $eror="<h1 style ='color:green'>* search is empty </h1>";
       echo $eror;
    }else{
        $name=$_POST['name'];
        $manipulation=1;
    }
}
//User Search
$headers=[
    'User-Agent: Generate new token',
    'Authorization: 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'
];
if($manipulation==1)
{
$ch =curl_init("https://api.github.com/users/$name");
curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$responce=curl_exec($ch);
curl_close($ch);
$data=json_decode($responce,true);
    $imge= $data["avatar_url"];
    $saxeli=$data['name'];
    $followers=$data['followers'];
    $user=$data['login'];
    
    if($followers > 0){
        $follower_manipulation=1;
    }
    else{
        $follower_manipulation=2;
    }
}

?>


<form class="forms" action="task2.php" method="post" enctype="multipart/form-data">
<input  class="Name_Control" type="text" name="name" placeholder="Enter the Search name"><br>
<input class="submit" type="submit" name="submit" value="Search">
</form>
<?php
//User Information
 if($manipulation==1)
 {
    
    
    $info=
    "<div class='first_repo'>
    <img class='picture' src='$imge' alt=''>
     <h1>name : $saxeli </h1>
     <h1 style='margin-left: 200px'>Username : $user </h1>
    <h1 style='margin-left: 200px'>Followers : $followers</h1>
    </div>
     <div class='folo'><h2 style='margin-right: 5%;'>Folowers</h2></div>
    ";

    echo $info;
 }
  
  if($follower_manipulation==1)
  {
    $ch =curl_init("https://api.github.com/users/$name/followers");
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
   $responce=curl_exec($ch);
   curl_close($ch);
   $data=json_decode($responce,true);
    foreach($data as $repositori)
    {  
        $suraTi= $repositori['avatar_url'];
        $id=  $repositori['id'];
        $login=  $repositori['login'];
        $element = "
         
        <div class='Pics-of-Followers'>
        <img style='height:50px ; width:50px' src='$suraTi' alt=''>
        <p style='margin-left: 100px'>ID : $id</p>
        <p style='margin-left: 100px'>USERNAME : $login</p>
        </div>
        ";'<br>';
        echo $element;
    }
}
if( $follower_manipulation==2){
    $no_follovers= "<div class='folo'><p style='margin-right: 5%;'>User hasnot any Followers </p></div>";
    echo $no_follovers;
}
?>
<style>
</style>
</body>
</html>