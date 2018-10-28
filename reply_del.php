<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: ./loginform.php");
		exit;
	} 
?>

<html>
<head>
	<meta charset = "UTF-8"/>
</head>
<body>
<?
	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	// 작성자 비교
	$sql = "SELECT r_auther, id FROM reply_table WHERE r_id=".$_POST['rdel'];
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
		
	// 사용자 비교(로그인 한 닉네임과 댓글 작성자 비교)
	if ($_SESSION['nickname'] === $row['r_auther'] ) {
	
	// 댓글 제거하기
		$sql = "DELETE FROM reply_table 
			   WHERE r_id=".$_POST['rdel'];

		$result = mysql_query($sql);

		// 제거 결과
		if ($result) 
		{
			echo "댓글 삭제 완료";
		} 
		else 
		{
			echo "에러발생";
		}
	}
	else
	{
		echo "작성자만 삭제 할 수 있습니다.";
	}
?>

<hr>
<a type="button" href="board.php">게시판으로 가기</a>
<br>
<?
	echo "<a type='button' href='board_read.php?file=".$row['id']."'>본문으로 가기</a>";
?>
</body>
</html>