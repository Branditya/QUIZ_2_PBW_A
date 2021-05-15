<?php
    session_start();
    require 'connect.php';
    if( isset($_COOKIE['User']) && isset($_COOKIE['Pass'])){
        $C_User = $_COOKIE['User']; 
        $C_Pass = $_COOKIE['Pass'];
        
        $sql = "SELECT `Username`, `Password` FROM `account`";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
      
        if($C_User==$row['Username'] && $C_Pass==$row['Password']){
          $_SESSION['Login'] = true;
        }
      }

    if (isset($_SESSION['Login'])){
        header("Location: home.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class='container'>
    <div class="row justify-content-center">
    <form action="" method="GET">
        <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" class="form-control" name="Username" required>
        </div>
        <div class="form-group">
        <label for="Password">Password</label>
        <input type="text" class="form-control" name="Password" required>
        </div>
        <div class="form-group">
        <label for="Remember">Remember Me</label>
        <input type="checkbox" name="Remember">
        </div>
        <input type="submit" class="btn btn-success" value="LOGIN" name="LOGIN">
        </div>
    </form>
    </div>
    <p>User=DandyWP<br>Pass=6969</p>
    <?php
        if (isset($_GET['LOGIN'])){
            $user = $_GET['Username'];
            $pass = $_GET['Password'];

            $sql = "SELECT `Username`, `Password` FROM `account`";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row["Username"]==$user and $row["Password"]==$pass) {
                        $_SESSION['Login']=true;

                        if(isset($_GET["Remember"])){
                            setcookie('User', $row['Username'], time()+60);
                            setcookie('Pass', $row['Password'], time()+60);
                        }
                        header("Location: home.html");
                        exit();
                    }   else {
                        echo "<script>alert('Username atau Password Salah.');</script>";
                    }
                }
            }
            $conn->close(); 
        }    
    ?>
</body>
</html>