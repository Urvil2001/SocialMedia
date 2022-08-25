<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>
</html>



<?php global $user;
const DB_NAME1 = 'pictogram';
const DB_HOST1 = 'localhost';
const DB_USER1 = 'root';
const DB_PASS1 = '';
$db = mysqli_connect(DB_HOST1,DB_USER1,DB_PASS1,DB_NAME1);
$unameofuser=$user['username'];
$sql="SELECT * FROM `verification` where uname='$unameofuser'";
$result=mysqli_query($db,$sql);

if(mysqli_num_rows($result)>0)
{
     while($row = mysqli_fetch_assoc($result)) {
            $verified=$row['verification'];
            }
            if($verified=='Verified')
             { ?>
             <div class="login">
            <div class="col-md-4 col-sm-12 bg-white border rounded p-4 shadow-sm">
            <form>
                <div class="d-flex justify-content-center">

                    <img class="mb-4" src="assets/images/pictogram.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Hello, <?=$user['first_name'].' '.$user['last_name'].' ('.$user['email'].') '?>Congratulation your account has been verified</h1>

            </form>
        </div>
    </div>
      
            <?php }
            else
            { ?>
                <div class="login">
        <div class="col-md-4 col-sm-12 bg-white border rounded p-4 shadow-sm">
            <form>
                <div class="d-flex justify-content-center">

                    <img class="mb-4" src="assets/images/pictogram.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Hello, <?=$user['first_name'].' '.$user['last_name'].' ('.$user['email'].') '?>Your Account Is Send for verification</h1>

            </form>
        </div>
    </div>
   
            <?php }
  }  
else
{
?>
    <div class="container col-md-9 col-sm-12 rounded-0 d-flex justify-content-between">
        <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
            <form method="post" action="assets/php/insertVerification.php" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Request For Verification</h1>
                <?php
if(isset($_GET['success'])){
    ?>
<p class="text-success">Profile is updated !</p>

<?php
}
                ?>
                <div class="form-floating mt-1 col-md-6 col-sm-12">
                    <img src="assets/images/profile/<?=$user['profile_pic']?>" class="img-thumbnail my-3" style="height:150px;width:150px" alt="...">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Any ID Proof</label><br>
                        <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                            value="Passport" <?=$user['gender']==1?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Passport
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                            value="Driving Licence" <?=$user['gender']==2?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios3">
                            Driving Licence
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                            value="National Identification Card" <?=$user['gender']==0?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios2">
                            National Identification Card
                        </label>
                    </div>
                </div>
                
                        <input class="form-control" type="file" name="Document"  required>
                    </div>
                </div>
                <?=showError('profile_pic')?>

                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">
                        <input type="text" name="first_name" value="<?=$user['first_name']?>" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">first name</label>
                    </div>
                    <div class="form-floating mt-1 col-6">
                        <input type="text" name="last_name" value="<?=$user['last_name']?>" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">last name</label>
                    </div>
               


                </div>
                <?=showError('first_name')?>
                <?=showError('last_name')?>
                
                <div class="form-floating mt-1">
                    <input type="text" name="email_id" value="<?=$user['email']?>" class="form-control rounded-0" placeholder="email">
                    <label for="floatingInput">email</label>
                </div>
                <div class="form-floating mt-1">
                    <input type="text"  value="<?=$user['username']?>" name="username" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">username</label>
                </div>
                <?=showError('username')?>

                <script>
                    function showHint(str) {
                      if (str.length == 0) {
                        document.getElementById("txtHint").innerHTML = "";
                        return;
                      } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                          }
                        }
                        xmlhttp.open("GET", "./assets/pages/gethint.php?q="+str, true);
                        xmlhttp.send();
                      }
                    }
                    </script>
                   <!--  <form action="">
                    -->   <div class="form-floating mt-1">
                                        <input type="text" name="fname" class="form-control rounded-0" id="fname" placeholder="Category" onkeyup="showHint(this.value)" required>
                                        <label for="floatingPassword">Category</label>
                                        <p>Suggestions: <span id="txtHint"></span></p>
                                    </div>
                   <!--  </form>
                    -->   <div class="form-floating mt-1">
                                        <input type="text" name="cname" class="form-control rounded-0" id="cname" placeholder="Country name" required>
                                        <label for="floatingPassword">Country name</label>
                            
                                    </div>
                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Upload Details">



                </div>

            </form>
        </div>

    </div>

<?php } ?>

