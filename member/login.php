<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

    $config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

    // config.php에서 가져온 정보를 변수에 저장
    $db_host = $config['DB_HOST'];
    $db_user = $config['DB_USER'];
    $db_password = $config['DB_PASSWORD'];
    $db_name = $config['DB_NAME'];

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    $sql = "SELECT * FROM members WHERE id='$id' AND pass='$pass'";
    $result = mysqli_query($con, $sql);

    $num_match = mysqli_num_rows($result);

    if(!$num_match) {
      echo "<script>
             window.alert('등록되지 않는 아이디입니다!')
             history.go(-1)
           </script>";
    }
    else {
        $row = mysqli_fetch_assoc($result);
        $db_pass = $row["pass"];

        mysqli_close($con);

        if($pass != $db_pass) {
           echo "<script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>";
           exit;
        }
        else {
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];

            echo "<script>
                location.href = 'index.php';
              </script>";
        }
     }        
?>
