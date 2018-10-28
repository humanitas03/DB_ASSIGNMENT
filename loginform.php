<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
	<br><hr>
	<!-- 로그인 창 -->
	<? if ( $_POST["nickname"] === null && $_POST["pw"] === null) { ?> 
		로그인 해주세요 <br>
	<!-- 로그인 성공시 -->
	<? } else if ( $_POST["nickname"] === "test" && $_POST["pw"] === "111") { 
		session_save_path('./session');
		session_start();
		
		// 세션값 설정
		$_SESSION['is_login'] = true;
		$_SESSION['nickname'] = "test";
		
		header("Location: ./board.php"); 
		exit;
	} else { ?>
	<!-- 로그인 실패시 --> 
		로그인 실패 <br>
	<? } ?>
	
	<form method="post" action="loginform.php">
		<label for="nickname">닉네임</label>
		<input type="text" name="nickname" placeholder="닉네임 입력"/>
		<br>
		<label for="pw">비밀번호</label>
		<input type="password" name="pw" placeholder="*********"/>
		<input type="submit" value="로그인"/>
	</form>
	
</body>
</html>