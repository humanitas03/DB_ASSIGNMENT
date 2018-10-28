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
	"INSERT INTO reply_table (id, r_content, r_auther, r_created) 
	VALUES (
			'".$_POST['num']."',
			'".mysql_real_escape_string($_POST['r_content'])."',
			'".$_SESSION['nickname']."',
			now() )"; 

	$result = mysql_query($sql);
	$mmm = $_POST['num'];//오류 확인을 위한 구문
	

	// 삽입 결과
	if ($result && ($_POST['num'] != 0)) 
	{
		echo "댓글 저장 완료";
	} 
	else 
	{
		echo "에러발생";
		echo "$mmm"; //오류 확인을 위한 구문
	}
	
?>
	<hr>
	<a type='button' href='board.php'>게시판 가기</a>
	<br>
	<?
	echo "<a type='button' href='board_read.php?file=".$_POST['num']."''>본문으로 가기</a>";
	?>
</body>
</html>