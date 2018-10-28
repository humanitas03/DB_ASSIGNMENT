<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
		header("Location: ./loginform.php");
		exit;
	} 
?>

<?
	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	// 비밀번호 가져오기
	$sql = "SELECT password FROM board_table WHERE id=".$_GET['file'];
	$result = mysql_query($sql);
	$password = mysql_fetch_row($result);

	// 비밀번호 비교
	if ($_POST['pw'] === $password[0]) {
		// 데이터 제거하기
		$sql = "DELETE FROM board_table 
			   WHERE id=".$_GET['file'];

		$result = mysql_query($sql);

		// 제거 결과
		if ($result) {
			echo "게시글 삭제 완료";
		} else {
			echo "에러발생";
		}
	} else {
		echo "비밀번호가 틀렸습니다.";
	}

?>
<hr>
<a type="button" href="board.php">게시판 가기</a>