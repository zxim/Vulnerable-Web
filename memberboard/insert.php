<?php
	include "session.php"; 	// 세션 처리

	if (!$userid) {
		echo "
				<script>
				alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
				history.go(-1)
				</script>
		";
		exit;
	}
    $subject = $_POST["subject"];		// 제목
    $content = $_POST["content"];		// 내용

	//xss 허용
	// $subject = htmlspecialchars($subject, ENT_QUOTES);	// 제목 HTML 특수문자 변환
	// $content = htmlspecialchars($content, ENT_QUOTES);	// 내용 HTML 특수문자 변환 
	$regist_day = date("Y-m-d (H:i)");  // UTC 기준 현재의 '년-월-일 (시:분)'

	$upload_dir = './data/';

	$upfile_name	 = $_FILES["upfile"]["name"];
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
	$upfile_type     = $_FILES["upfile"]["type"];
	$upfile_size     = $_FILES["upfile"]["size"];
	$upfile_error    = $_FILES["upfile"]["error"];

	if ($upfile_name && !$upfile_error)
	{
		$file = explode(".", $upfile_name);
		$file_name = $file[0];
		$file_ext  = $file[1];

		$copied_file_name = date("Y_m_d_H_i_s");
		$copied_file_name .= ".".$file_ext;
		$uploaded_file = $upload_dir.$copied_file_name;

		if( $upfile_size  > 10000000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1);
				</script>
				");
				exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
		{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
		}
	}
	else 
	{
		$upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
	}

    $config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

   	// config.php에서 가져온 정보를 변수에 저장
   	$db_host = $config['DB_HOST'];
   	$db_user = $config['DB_USER'];
   	$db_password = $config['DB_PASSWORD'];
   	$db_name = $config['DB_NAME'];
              
    $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);  // DB 접속
	$sql = "insert into memberboard (id, name, subject, content, regist_day, ";
	$sql .= "file_name, file_type, file_copied) ";
	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', ";
	$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

	mysqli_query($con, $sql);  // $sql에 저장된 명령 실행

	mysqli_close($con);       // DB 연결 끊기

	// 목록 페이지로 이동
	echo "<script>
	    location.href = 'list.php';
	   </script>";
?>