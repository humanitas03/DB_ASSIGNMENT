<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) 
	{
		header("Location: ./loginform.php");
		exit;
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?	
	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	// 데이터 삽입하기
	$sql = 
	"INSERT INTO board_table (password, title, context, auther, created) 
	VALUES (	'".$_POST['pw']."',
			'".mysql_real_escape_string($_POST['title'])."', 
			'".mysql_real_escape_string($_POST['context'])."',
			'".$_SESSION['nickname']."',
			now() )"; 
	$result = mysql_query($sql);

	// 삽입 결과
	if ($result) 
	{
		echo "게시글 저장 완료";
	} 
	else 
	{
		echo "에러발생";
	}
	
?>
	<hr>
	<a type="button" href="board.php">게시판 가기</a>
</body>
</html>