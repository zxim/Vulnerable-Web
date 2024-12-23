<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
.close { margin:20px 0 0 120px; cursor:pointer; }
</style>
</head>
<body>
   <h3>아이디 중복체크</h3>
   <div>
<?php
   $config = require '../config.php';  // 루트에 있는 config.php 파일 불러옴

   // config.php에서 가져온 정보를 변수에 저장
   $db_host = $config['DB_HOST'];
   $db_user = $config['DB_USER'];
   $db_password = $config['DB_PASSWORD'];
   $db_name = $config['DB_NAME'];
   

   $id = $_GET["id"];

   if(!$id) {
      echo("아이디를 입력해 주세요!");
   }
   else {
      $con = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "select * from members where id='$id'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record) {
         echo $id." 아이디는 중복됩니다.<br>";
         echo "다른 아이디를 사용해 주세요!<br>";
      }
      else {
         echo $id." 아이디는 사용 가능합니다.<br>";
      }    
      mysqli_close($con);
   }
?>
   </div>
   <div class="close">
      <button type="button" onclick="javascript:self.close()">창 닫기</button>
   </div>
</body>
</html>

