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
	<a type="button" href="logout.php">로그아웃</a>
	<hr>

	<!-- BEGIN 게시판 리스트 -->
	<table border="1" style="width:100%">
		<!-- 테이블 제목 -->
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>생성일</th>
			<th>조회수</th>
		</tr>

		<!-- 테이블 리스트 -->
<?
	

	// DB 접속
	mysql_connect('localhost', 'root', 'mysql');
	mysql_select_db('board');

	
	// 데이터 가져오기
	$sql = "SELECT id, title, auther, created, view FROM board_table";
	$list_result = mysql_query($sql);


	$total = mysql_num_rows($list_result); // 전체 데이터의 행의 개수를 $total 변수에 대입
	$pagenum = 15; // 한 페이지당 출력되는 게시글 수 15 설정
	
	/* 정상적인 출력을 확인하기 위한 구문
	 *	echo $total;
	 */ 

	/* paging을 GET방식으로 구현*/
	$page = ($_GET['page']) ? $_GET['page'] : 1; //get 방식으로 페이지 번호를 누르면 주소에 번호를 넘김 만약 page값이 없을 시 $page의 값을 1로 
	
	$offset = ($page-1)*$pagenum; // 페이지 오프셋설정

	// 페이지 구간 별로 오프셋($offset)을 설정하여 15개씩 끊어서 쿼리문을 조정, id를 내림차순 정렬하여 작성 순서대로 출력되게 설정
	$sql = "SELECT id, title, auther, created, view FROM board_table ORDER BY id DESC LIMIT ".$offset." ,".$pagenum;
	$list_result = mysql_query($sql);

	$boards = array ();  
	while ( $row = mysql_fetch_assoc($list_result)) 
		{ //받아논 쿼리 결과를 제한을 둬서 출력 시키기  
		$board = array (  
			"id" => (int) $row ['id'] ,
			"title" => $row ['title'],
			"auther" => $row ['auther'],
			"created" => $row ['created'],
			"view" => (int)$row['view']
		);
		// 결과 배열로 푸쉬
		array_push($boards, $board);  
	}

		$list=null;
		if ($boards == null) 
		{ // 데이터가 없을시
			$list .= "<tr><td colspan='4' style='text-align:center'>결과가 없습니다</td></tr>";
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
				$list .= "<td>".$board['view']."</td>";
				$list .= "</tr>";
				
			}
		}
		echo $list;
		?>
	</table>
	<!-- END 게시판 리스트 -->

<?
	
	// 파일 작성 폼으로 연결
	echo "<hr><a type='button' href='board_form.php'>게시글 작성</a><br>";
	 
	 //페이징 출력과 관련된 변수 plist 선언
	 $plist = pageList($total, $pagenum, $page); 
 
 	for($i=0; $i<count($plist['block']); $i++)
 	{ 
   		echo '<a href=board.php?page='.$plist['block'][$i].'>['.$plist['block'][$i].']</a> '; 
 	} 

 echo '<br />'; 

// 구현 처리 x
//echo '<a href=board.php?page=' . $plist['prev'] . '>[이전]</a> <a href=board.php?page=' . $plist['next'] . '>[다음]</a>'; 
 ?>  

<!-- 검색 입력 폼 / action='borad_src.php' -->
<form method = POST action = 'board_src.php'>
	<tr>
		<td width = 100% colspan = 5 align = center>
			<input type = hidden name=page value=<? echo "$page";?>>

			<select name = selection>
				<option value = name>작성자</option>
				<option value = subject selected>제목</option>

			</select>

			<input type = text name=src size = 30>
			<input type= submit value = 검색> 

		</td>
	</tr>
</form>
<!-- 검색 입력 폼의 끝-->


<!--페이징 함수 pagList 정의-->
<?
 // $totalnum 게시물 수 
 // $pagenum [1] [2] [3] [4]... 
 // $page board.php?page=1 
 // 블록 설정 제외
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

    //$end가 $totalpage보다 값이 클 때
    if ($end > $totalpage) 
    { 
        $end = $totalpage;  
    } 


    $plist = array('block', 'next', 'prev'); 


    foreach(range($start, $end) as $val){ 
        $plist['block'][] = $val; 
    } 

    //프리뷰와 넥스트 초기화
    $plist['prev'] = false; 
    $plist['next'] = false; 
    
    //현재 페이지가 전체 페이지 넘버보다 작을시(함수만 구현)
    if ($page > $pagenum) 
    { 
        $plist['prev'] = $start-1; 
    } 

    if($end < $totalpage) { 
        $plist['next'] = $end+1; 
    } 
    
    return $plist; 
 } 


 
 ?>

</body>
</html>