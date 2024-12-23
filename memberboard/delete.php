<?php
    include "session.php";
    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

    // config.php에서 가져온 정보를 변수에 저장
    $db_host = $config['DB_HOST'];
    $db_user = $config['DB_USER'];
    $db_password = $config['DB_PASSWORD'];
    $db_name = $config['DB_NAME'];
              
    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);  // DB 접속
    $sql = "delete from memberboard where num=$num"; // 레코드 삭제 명령
    mysqli_query($con, $sql);     // SQL 명령 실행

    mysqli_close($con);           // DB 접속 해제

    // 목록보기 이동
    echo "<script>
	         location.href = 'list.php?page=$page';      
	     </script>";
?>