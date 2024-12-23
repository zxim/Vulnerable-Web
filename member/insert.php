<?php
    $id   = $_POST["id"];               // 아이디
    $pass = $_POST["pass"];             // 비밀번호
    $name = $_POST["name"];             // 이름
    $email  = $_POST["email"];          // 이메일

    $regist_day = date("Y-m-d (H:i)");  // UTC 현재 '년-월-일 (시:분)'

    $config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

    // config.php에서 가져온 정보를 변수에 저장
    $db_host = $config['DB_HOST'];
    $db_user = $config['DB_USER'];
    $db_password = $config['DB_PASSWORD'];
    $db_name = $config['DB_NAME'];

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);  // DB 접속

	$sql = "insert into members (id, pass, name, admin,email, regist_day) ";    // 데이터 삽입 명령
	$sql .= "values('$id', '$pass', '$name', false,'$email', '$regist_day')";       

	mysqli_query($con, $sql);       // SQL 명령 실행
    mysqli_close($con);     

    // 로그인 폼으로 이동
    echo "<script>
	          location.href = 'login_form.php';
	      </script>";
?>