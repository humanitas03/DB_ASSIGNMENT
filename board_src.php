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
	<!-- 로그아웃 버튼 -->
	<!--
	<a type="button" href="logout.php">로그아웃</a>
	<hr>
	-->

	<!-- BEGIN 게시판 리스트 -->
	<table border="1" style="width:100%">
		<!-- 테이블 제목 -->
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>생성일</th>
		</tr>

		<!-- 테이블 리스트 -->
<?

	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	
	/*데이터 가져오기
	$sql = 'SELECT id, title, auther, created FROM board_table';
	$list_result = mysql_query($sql);

	$row = mysql_fetch_row($list_result);
	*/
	
	/*
	$pagenum = 15; // 한 페이지당 출력되는 게시글 수 15 설정
	$page = ($_GET['page']) ? $_GET['page'] : 1; //get 방식으로 페이지 번호를 누르면 주소에 번호를 넘김
	
	$offset = ($page-1)*$pagenum; // 페이지 오프셋
	*/
	// 검색 조건에 맞는 데이터 가져오기
	echo $selecton;
	if($_POST['selection']=='name')
	{
		$sql = "SELECT id, title, auther, created FROM board_table WHERE auther='".$_POST['src']."' ORDER BY id DESC"; //LIMIT ".$offset." ,".$pagenum;
		$list_result = mysql_query($sql);
	}
	else if($_POST['selection']=='subject')
	{ 
		//정상적인 동작이 안되는 SQL문
		$sql = "SELECT id, title, auther, created FROM board_table WHERE title LIKE '%".$_POST['src']."%' ORDER BY id DESC";// LIMIT ".$offset." ,".$pagenum;
		$list_result = mysql_query($sql);
	}

	$nrow = mysql_num_rows($list_result);
	$total = $nrow;
	
	echo $total;

	$boards = array ();  
	while ( $row = mysql_fetch_assoc($list_result)) 
		{ //받아논 쿼리 결과를 제한을 둬서 출력 시키기  
		$board = array (  
			"id" => (int) $row ['id'] ,
			"title" => $row ['title'],
			"auther" => $row ['auther'],
			"created" => $row ['created']
		);
		// 결과 배열로 푸쉬
		array_push($boards, $board);  
	}

		$list=null;
		if ($boards == null) 
		{ // 데이터가 없을시
			$list .= "<tr><td colspan='4' style='text-align:center'>검색 결과가 없습니다</td></tr>";
		} 
		else 
		{	// 데이터가 있을시
			foreach($boards as $board) //배열 반복 foreach문
			{
				
				$list .= "<tr>";
				$list .= "<td>".$board['id']."</td>";
				// 게시글로 가기위해 링크
				$list .= "<td><a type='button' href='board_read.php?file="
					.$board['id']."'>".$board['title']."</a></td>";
				$list .= "<td>".$board['auther']."</td>";
				$list .= "<td>".$board['created']."</td>";
				$list .= "</tr>";
				
			}
		}
		echo $list;
		?>
	</table>

	<!-- END 게시판 검색 리스트 -->
<?
	// 게시판으로 돌아가기 버튼
	echo "<hr><a type='button' href='board.php'>게시판으로 돌아가기</a><br>";
?>  

<!--페이징 함수 pagList 정의-->
<?
 // $totalnum 게시물 수 
 // $pagenum [1] [2] [3] [4]... 
 // $page board.php?page=1 
 function pageList($totalnum, $pagenum, $page){ 


    if(!is_int($totalnum)){ 
        $totalnum = 0; 
    } 
    if(!is_int($pagenum) || ($pagenum <= 0)){ 
        $pagenum = 1; 
    } 
    if(!is_int($page) || ($page <= 0)){ 
        $page = 1; 
    } 


    $start = (($page-1)*$pagenum)+1; 
    $end = $page*$pagenum; 
    $totalpage = ceil($totalnum/$pagenum); 
    if ($end > $totalpage) { 
        $end = $totalpage;  
    } 


    $plist = array('block'); 


    foreach(range($start, $end) as $val){ 
        $plist['block'][] = $val+1; 
    } 


    return $plist; 
 } 
 
 ?>

</body>
</html>