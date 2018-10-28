<? 
	// 로그인 상태 확인
	session_save_path("./session");
	session_start();
	if (!$_SESSION['is_login']) {
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
	<!-- 로그아웃 버튼 -->
	<a type="button" href="logout.php">로그아웃</a>
	<hr>
	
<?
	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	// 데이터 가져오기
	$sql = 'SELECT id, password, title, context, auther, created 
		FROM board_table 
		WHERE id='.$_GET['file'];
	$list_result = mysql_query($sql);
	
	$num = $_GET['file']; // 글 번호(id) $num으로 넘겨받기

	// 쿼리 실행 결과를 가져옴
	$board = mysql_fetch_assoc($list_result);

	if ($board != null) {
		$list = "<h3>".$board['title']."</h3>";
		$list .= "<b>글번호</b> : ".$board['id']."<br>";
		$list .= "<b>글쓴이</b> : ".$board['auther']."<br>";
		$list .= "<b>본문</b><br><p>".$board['context']."</p>";
	}
	echo $list;
?>
	<hr>
<?
	//조회수 업데이트
	$result = mysql_query('UPDATE board_table SET view = view+1 WHERE id='.$num);
?>
	<br>
	<a type="button" href="board_pw.php?file=<?=$_GET['file']?>">본문 삭제하기</a>
	<hr>

	<table border="1" style="width:80%">
		<!-- 댓글 테이블 제목 -->
		<tr>
			<th>작성자</th>
			<th>댓글 내용</th>
			<th>생성일</th>
		</tr>
<?
	/*댓글 출력 부분*/
		
	// 본문 글의 번호(id)와 일치하는 댓글 데이터 가져오기
	$sql = 'SELECT r_id, r_auther, r_content, r_created FROM reply_table WHERE id='.$num;
	$list_result = mysql_query($sql);

	
	//$board = mysql_fetch_assoc($list_result);
	echo $board['r_auther'];
	echo $board['r_content'];
	echo $board['r_created'];
	$boards = array ();  
	while ( $row = mysql_fetch_assoc($list_result)) 
		{ //받아논 쿼리 결과를 제한을 둬서 출력 시키기  
		$board = array (  
			"r_auther" => $row ['r_auther'],
			"r_content" => $row ['r_content'],
			"r_created" => $row ['r_created'],
			"r_id"=>(int)$row['r_id']
		);
		
		// 결과 배열로 푸쉬
		array_push($boards, $board);  
	}
	

		$list=null;
		if ($boards == null) 
		{ // 데이터가 없을시
			$list .= "<tr><td colspan='4' style='text-align:center'>댓글이 없습니다</td></tr>";
		} 
		else 
		{	// 데이터가 있을시
			foreach($boards as $board) //배열 반복 foreach문
			{
				
				$list .= "<tr>";
				$list .= "<td width = '15%'>".$board['r_auther']."</td>";
				$list .= "<td width = '50%' >".$board['r_content']."</td>";
				$list .= "<td width = '25%'>".$board['r_created']."</td>";
				$list .= "<td width = '10%'>"."<form method='post' action='reply_del.php'><button name='rdel' type='submit' value='"
							.$board['r_id']."'>댓글삭제</button></form>";
				$list .= "</tr>";
				
			}
		}

			echo $list;	

?>

	</table>

	<hr>
	<!-- 댓글 쓰기 폼-->
	<form method="post" action="reply_add.php">
		<br>
		<!-- 내용을 입력 받는 폼 -->
		<label for="number">본글 번호</label>
		<textarea name="num" readonly="TRUE" cols="4" rows="1"><?echo "$num";?></textarea>
		<label for="content">댓글 내용</label> 
		<br>
		<textarea rows="1" cols="50" name="r_content"></textarea>
		<input type="submit" value="댓글 작성"/>
	</form>
	<hr>
	
	<a type="button" href="board.php">게시판 가기</a>
</body>

</html>