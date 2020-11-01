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


    if(isset($_GET['tags'])){
            
        $query = "SELECT distinct video_id, thumbnail_link, title, channelTitle, channelId, date(publishedAt) as publishedAt, view_count, likes, REPLACE(tags, '|', '  #') as tags
        FROM KR WHERE tags LIKE '%{$_GET['tags']}%' and channelTitle != '피지컬갤러리' and title not like '%가짜사나이%' 
        GROUP BY video_id ORDER BY view_count DESC LIMIT 20";
        
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
            $article .= '</td><td>';
            $article .= '</td></tr>';
            $article .= '<tr><td colspan="6" style="color:#084B8A; font-size:15px;">#'.$row['tags'].'</td></tr>';    
        }
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> 태그 검색하기 </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
<body>
    </head>
    <div class="logo" style="float:left;">
    <a href="index.php"><img src="./image/youtubelogo.jpg" width="150px" height="80px"></a>
    </div>
    <form action="" method="GET">
        <br>
        <div class="textBox">
        <input type="text" name="tags" placeholder="원하는 태그를 검색해보세요">
        <input type="image"
            src="https://www.pinclipart.com/picdir/big/485-4851736_free-png-search-icon-search-icon-free-download.png"
            class="button">
</div>
    </form><br> <br>
    <table>
        <?= $title ?>
        <?= $article ?>
    </table>
</body>

</html>