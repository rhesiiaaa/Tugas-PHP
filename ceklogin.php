<?php
    //userpass 
    $user = $_POST['username'];
    $pass = $_POST['password'];

    //connection things
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "tb_login";

    $conn = mysqli_connect($host, $username, $password, $db_name);
    if (isset($_POST['username']) && isset($_POST['password'])) {

        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }
    
        $uname = validate($_POST['username']);
        $pass = validate($_POST['password']);
    
        if (empty($uname)) {
            header("Location: login.php?error=User Name is required");
            exit();
        }else if(empty($pass)){
            header("Location: login.php?error=Password is required");
            exit();
        }else{
            $sql = "SELECT * FROM tb_login WHERE username='$uname' AND password='$pass'";
    
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['username'] === $uname && $row['password'] === $pass) {
                    header("Location: home.php");
                    exit();
                }else{
                    header("Location: login.php?error=Incorect User name or password");
                    exit();
                }
            }else{
                header("Location: login.php?error=Incorect User name or password");
                exit();
            }
        }
        
    }else{
        header("Location: login.php");
        exit();
}
?>