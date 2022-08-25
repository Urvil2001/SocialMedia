<?php global $user;?>
<?php
require_once 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$document=$_FILES['Document']['name'];
$type=strtolower(pathinfo($document,PATHINFO_EXTENSION));

if(isset($_POST['submit']))
{
    if($type!='jpg' && $type!='jpeg' && $type!='png')
    {
    	echo "invalid";
    }
    else
    {   
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $fname=$_POST['fname'];
        $cname=$_POST['cname'];
        $emailid=$_POST['email_id'];
        $username=$_POST['username'];
        $documenttype=$_POST['exampleRadios'];
        $filename = $_FILES['Document']['name'];
        $tempname = $_FILES['Document']['tmp_name'];    
        $folder = "../images/Verification/".$username.$filename;
        $imgname =$username.$filename;
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
            $query1="INSERT INTO `verification` (`id`, `fname`, `lname`, `uname`, `email`, `documenttype`, `docfile`, `category`, `countryname`,`verification`) VALUES (NULL, '$first_name', '$last_name', '$username', '$emailid', '$documenttype', '$imgname', '$fname', '$cname','Unverified')";
            mysqli_query($db,$query1);
             echo "<script>
                alert('Details is submitted for Verification');
                window.location.href='../../?ReqVerification&send';
                </script>";
        }else{
            $msg = "Failed to upload image";
      }
          
}
}
?>