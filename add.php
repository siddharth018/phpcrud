<?php
   require_once('db.php');
   $upload_dir = 'uploads/';
   
   if (isset($_POST['Submit'])) {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $hobby = implode(',', $_POST['hobbies']);;
    
   
   $imgName = $_FILES['image']['name'];
   $imgTmp = $_FILES['image']['tmp_name'];
   $imgSize = $_FILES['image']['size'];
   
   $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
   
   	$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
   
   	$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
   if(in_array($imgExt, $allowExt)){
   
   		if($imgSize < 5000000){
   			move_uploaded_file($imgTmp ,$upload_dir.$userPic);
   		}
   	}
   	$sql = "insert into contacts(name, email, image, hobby, password)
   		values('".$name."','".$email."', '".$userPic."', '".$hobby."', '".$password."')";
   	$result = mysqli_query($conn, $sql);
   
   	if($result){
   		$successMsg = 'New record added successfully';
   		header('Location: index.php');
   	}else{
   		$errorMsg = 'Error '.mysqli_error($conn);
   	}			
   
   }
 ?>