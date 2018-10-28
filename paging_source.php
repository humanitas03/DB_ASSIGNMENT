<?
 // $totalnum 게시물 수 
 // $pagenum [1] [2] [3] [4]... 
 // $page list.php?page=1 
 function pageList($totalnum=0, $pagenum=15, $page=1){ 


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


    $plist = array('page', 'next', 'prev'); 


    foreach(range($start, $end) as $val){ 
        $plist['page'][] = $val; 
    } 


    $plist['prev'] = false; 
    $plist['next'] = false; 
    if ($page > $pagenum) { 
        $plist['prev'] = $start-1; 
    } 
    if($end < $totalpage) { 
        $plist['next'] = $end+1; 
    } 
    return $plist; 
 } 


 // $page  iist.php?page=4 
 // $total 게시물 수 
 
 $plist = pageList($total, 15, $page); 
 for($i=0; $i<count($list['page']); $i++){ 
   echo '<a href=board.php?page='.$plist['page'][$i].'>['.$plist['page'][$i].']</a> '; 
 } 
 echo '<br />'; 
 echo '<a href=board.php?page=' . $plist['prev'] . '>[이전]</a> <a href=board.php?page=' . $plist['next'] . '>[다음]</a>'; 
 ?>  