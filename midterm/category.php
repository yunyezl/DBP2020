<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'youtube');

    if (mysqli_connect_errno()) {
        echo "MariaDB 접속에 실패했습니다. 관리자에게 문의하세요.";
        echo "<br>";
        echo mysqli_connect_error();
        exit();
    }

    $article = '';
    $title = '';

    if(!$_GET['category']){
        
        $query = "SELECT distinct video_id, thumbnail_link, title, channelTitle, channelId, publishedAt, view_count, likes 
        FROM KR GROUP BY video_id ORDER BY view_count DESC LIMIT 20";

        $result = mysqli_query($link, $query);       
        
        $title .= '<tr>';
        $title .= '<th>'.'미리보기'.'</th>';
        $title .= '<th>'.'제목'.'</th>';
        $title .= '<th>'.'채널명'.'</th>';
        $title .= '<th>'.'업로드일'.'</th>';
        $title .= '<th>'.'좋아요'.'</th>';
        $title .= '<th>'.'조회수'.'</th>';
        $title .= '</tr>';
    

        while( $row = mysqli_fetch_array($result) ){
            $article .= '<tr><td><a href="https://www.youtube.com/watch?v='.$row['video_id'].'"><img src="https://img.youtube.com/vi/'.$row['video_id'].'/mqdefault.jpg"><a></td><td><h3>';
            $article .= '<a href="https://www.youtube.com/watch?v='.$row['video_id'].'">'.$row['title'].'</a>';
            $article .= '<h3></td><td>';
            $article .= '<a href="https://www.youtube.com/channel/'.$row['channelId'].'">'.$row['channelTitle'].'</a>';
            $article .= '</td><td>';
            $article .= $row['publishedAt'];
            $article .= '</td><td>';
            $article .= $row['likes'];
            $article .= '</td><td>';
            $article .= $row['view_count'];
            $article .= '</td></tr>';    
        }
    }

    if(isset($_GET['category'])){
        if($_GET['category']) {
            $query = "SELECT distinct video_id, thumbnail_link, title, channelTitle, channelId, publishedAt, view_count, likes 
            FROM KR WHERE categoryId = {$_GET['category']} and month(publishedAt) = 10 and channelTitle != '피지컬갤러리'
            GROUP BY video_id ORDER BY view_count DESC LIMIT 20";
        } else {
            $query = "SELECT distinct video_id, thumbnail_link, title, channelTitle, channelId, publishedAt, view_count, likes 
            FROM KR GROUP BY video_id ORDER BY view_count DESC LIMIT 20";
        }
        
        $result = mysqli_query($link, $query);
        
        if($_GET['category'] != 0){
        $title .= '<tr>';
        $title .= '<th>'.'미리보기'.'</th>';
        $title .= '<th>'.'제목'.'</th>';
        $title .= '<th>'.'채널명'.'</th>';
        $title .= '<th>'.'업로드일'.'</th>';
        $title .= '<th>'.'좋아요'.'</th>';
        $title .= '<th>'.'조회수'.'</th>';
        $title .= '</tr>';
        }
        while( $row = mysqli_fetch_array($result) ){
            $article .= '<tr><td><a href="https://www.youtube.com/watch?v='.$row['video_id'].'"><img src="https://img.youtube.com/vi/'.$row['video_id'].'/mqdefault.jpg"><a></td><td><h3>';
            $article .= '<a href="https://www.youtube.com/watch?v='.$row['video_id'].'">'.$row['title'].'</a>';
            $article .= '<h3></td><td>';
            $article .= '<a href="https://www.youtube.com/channel/'.$row['channelId'].'">'.$row['channelTitle'].'</a>';
            $article .= '</td><td>';
            $article .= $row['publishedAt'];
            $article .= '</td><td>';
            $article .= $row['likes'];
            $article .= '</td><td>';
            $article .= $row['view_count'];
            $article .= '</td></tr>';    
        }
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 카테고리별 컨텐츠 모아보기 </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
    </head>
    <body>
    <div class="logo" style="float:left;">
    <a href="index.php"><img src="./image/youtubelogo.jpg" width="150px" height="80px"></a>
    </div>
    <div class="select">
    <form action="" method="GET">
        <br>
        <select name="category">
            <option value="0">전체</option>
            <option value="10">음악</option>
            <option value="17">스포츠</option>
            <option value="25">정치/뉴스</option>
            <option value="15">동물</option>
            <option value="28">테크</option>
            <option value="20">게임</option>
            <option value="2">자동차</option>
        </select>
        <input type="image"
            src="https://www.pinclipart.com/picdir/big/485-4851736_free-png-search-icon-search-icon-free-download.png"
            class="button">
    </form><br> <br>
    </div>
    <table>
        <?= $title ?>
        <?= $article ?>
    </table>
</body>

</html>