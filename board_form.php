<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) 
	{
		header("Location: /phplec/board_db/loginform.php");
		exit;
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
	<!-- 로그아웃 버튼 -->
	<a type="button" href="logout.php">로그아웃</a>
	<hr>
	<!-- 파일 작성 폼 -->
	<form method="post" action="board_add.php">
		<label for="title">제목</label> 
		<input type="text" name="title" placeholder="게시글 제목"/>
		<br>
		<!-- 타입을 password 로 지정하면 '*' 형태로 보여줌 -->
		<label for="pw">비밀번호 설정</label>
		<input type="password" name="pw" placeholder="*********"/>
		<br>
		<!-- 여러줄 입력 받는 폼 -->
		<label for="context">본문</label>
		<textarea rows="10" name="context"></textarea>
		<input type="submit" value="작성"/>
	</form>
</body>
</html>