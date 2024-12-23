<?php
	include "session.php"; 	// 세션 처리

    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
	$regist_day = date("Y-m-d (H:i)");  // UTC 기준 현재의 '년-월-일 (시:분)'

	$config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

   	// config.php에서 가져온 정보를 변수에 저장
   	$db_host = $config['DB_HOST'];
   	$db_user = $config['DB_USER'];
   	$db_password = $config['DB_PASSWORD'];
   	$db_name = $config['DB_NAME'];
              
    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);  // DB 접속
	$sql = "update memberboard set subject='$subject', ";	// 수정 명령
	$sql .= "content='$content', regist_day='$regist_day' where num=$num";
	mysqli_query($con, $sql);  // SQL 명령 실행

	mysqli_close($con);       // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'list.php?page=$page';
	   </script>
	";
?>