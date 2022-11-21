<?php 

require_once('config.php'); 
if (isset($_POST['verified'])){
$email = $_POST['email'];
$verify = $_POST['verify'];

$query = "UPDATE clients SET status=1 where verinum = '$verify' and email = '$email' ";
$insert = mysqli_query($conn,$query);
if(!$insert)						{
    header("refresh:0;url=verify.php");
}
else
{
    ?>
    <script>
        alert("Account Successfully Verified")
    </script>
    <?php
        header("refresh:0;url=index.php");
        ?>
    <?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<style>
    .inside{
        background-color: maroon;
        width: 30%;
      margin-left: 570px;
      margin-top: 150px;
      padding: 50px 50px;
      border: 4px solid grey;
    }
    label{
        color: white;
        font-size: 17px;
    }
    #verify{
        border-color: transparent;
        padding: 8px 28px;
    }
    .but{
        padding: 8px 22px;
        border-color: transparent;
        background-color: grey;
        font-weight: bold;
    }
</style>
<body>
<?php require_once('inc/header.php') ?>
<?php require_once('inc/topBarNav.php') ?>
    <div class="inside">
        <form action="verify.php" method="post">
            <h3 style="color: white";>Email Verification</h3>
            <br>
            <label for="verify">Enter your email</label><br>
            <input type="text" name="email" id="verify">
            <br>
            <br>
            <label for="verify">Enter 6 digits code sent to your regitered email</label><br>
            <input type="text" name="verify" id="verify">
            <br>
            <br>
            <button type="submit" class="but" class="btn btn-primary btn-flat" name="verified">Verify</button>
        </form>
    </div>
</body>
</html>