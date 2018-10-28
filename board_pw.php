<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
</head>
<body>
	<h3>게시글 비밀번호를 입력해주세요</h3>
	<form method="post" action="board_del.php?file=<?=$_GET['file']?>">
		<br>
		<label for="pw">비밀번호</label>
		<input type="password" name="pw" placeholder="*********"/>
		<input type="submit" value="삭제"/>
	</form>
	
</body>
</html>