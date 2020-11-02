<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
    $link = mysqli_connect('localhost', 'admin', 'admin', 'youtube');

    if (mysqli_connect_errno()) {
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $article = '';
    $title = '';

    $query = "SELECT categoryName, categoryId, sum(a) as pre FROM (SELECT categoryName, car.categoryId, likes+view_count+comment_count as a FROM car INNER JOIN categoryName n ON car.categoryId = n.categoryId GROUP BY video_id) a  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, animal.categoryId, likes+view_count+comment_count as a FROM animal INNER JOIN categoryName n ON animal.categoryId = n.categoryId GROUP BY video_id) b
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, animation.categoryId, likes+view_count+comment_count as a FROM animation INNER JOIN categoryName n ON animation.categoryId = n.categoryId GROUP BY video_id) c  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, game.categoryId, likes+view_count+comment_count as a FROM game INNER JOIN categoryName n ON game.categoryId = n.categoryId GROUP BY video_id) d  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, music.categoryId, likes+view_count+comment_count as a FROM music INNER JOIN categoryName n ON music.categoryId = n.categoryId GROUP BY video_id) e  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, sport.categoryId, likes+view_count+comment_count as a FROM sport INNER JOIN categoryName n ON sport.categoryId = n.categoryId GROUP BY video_id) f
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, news.categoryId, likes+view_count+comment_count as a FROM news INNER JOIN categoryName n ON news.categoryId = n.categoryId GROUP BY video_id) g  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, tech.categoryId, likes+view_count+comment_count as a FROM tech INNER JOIN categoryName n ON tech.categoryId = n.categoryId GROUP BY video_id) h
    ORDER BY pre DESC";

    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= '<a href="precate.php?categoryName='.$row['categoryName'].'&categoryId='.$row['categoryId'].'">'.$row['categoryName'].'</a>';
        $article .= '</td></tr>';    
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 가장 많이 트렌딩 된 채널 리스트 </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
    <style>
</style>
    </head>
    <body>
    <div class="logo" style="float:left;">
    <a href="index.php"><img src="./image/youtubelogo.jpg" width="150px" height="80px"></a>
    </div>
    <h2 style="margin-left:-10px;"> 사용자 선호도에 따른 카테고리 순위</h2>
    좋아요, 댓글 수, 조회수 등을 기반으로 결정된 카테고리 순위입니다. <br><br>
    <table style="margin-left: auto; margin-right: auto; width:0%; border-collapse: separate; padding-left:150px;">
         <tr>
         <th>카테고리명</th>
        </tr>
        <?= $article ?>
    </table>
</body>

</html>