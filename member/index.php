<?php
    include "../memberboard/session.php";
?>	
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>모의해킹 프로젝트</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h3 class="logo">
            <a href="index.php">모의해킹 프로젝트</a>
        </h3>
        <div class="top">
<?php
    if(!$userid) {
?>                
                <div>
                    <span><a href="form.php">회원가입</a> </span>
                    <span><a href="login_form.php">로그인</a></span>
                    <span><a href="../memberboard/list.php">게시판</a></span>
                </div>
<?php
    } else {
                $logged = $username."(".$userid.")";
?>
                <div>
                    <span><?=$logged?> </span>
                    <span><a href="logout.php">로그아웃</a> </span>
                    <span><a href="modify_form.php">정보수정</a></span>
                    <span><a href="../memberboard/list.php">게시판</a></span>
                </div>
<?php
    }
?>
        </div> 
    </div> 
</body>
</html>