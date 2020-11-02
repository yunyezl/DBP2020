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
    $noResult ='';

    if(isset($_GET['fromDate'])){
        $query = "SELECT distinct video_id, title, channelTitle, channelId, date(trending_date) as trending_date, view_count, likes 
        FROM KR WHERE date(trending_date) >= '{$_GET['fromDate']}' and date(trending_date) <= '{$_GET['toDate']}'
        GROUP BY video_id ORDER BY trending_date LIMIT 20";
        
        $result = mysqli_query($link, $query);
        
        if(mysqli_num_rows($result) > 0){
        if ($query != NULL) {
        $title .= '<tr>';
        $title .= '<th>'.'미리보기'.'</th>';
        $title .= '<th>'.'제목'.'</th>';
        $title .= '<th>'.'채널명'.'</th>';
        $title .= '<th>'.'트랜딩 날짜'.'</th>';
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
            $article .= $row['trending_date'];
            $article .= '</td><td>';
            $article .= $row['likes'];
            $article .= '</td><td>';
            $article .= $row['view_count'];
            $article .= '</td></tr>';    
        }
    } else {
        $noResult = '조회된 결과가 없습니다.';
    }
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> 기간별 트렌딩 비디오 모아보기 </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css?after">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/datepicker-ko.js"></script>
        <script>
            $(function() {
                $("#today").text(new Date().toLocaleDateString());
                $.datepicker.setDefaults($.datepicker.regional['ko']); 

                //시작일.
                $('#fromDate').datepicker({
                    showOn: "both",                    
                    buttonImage: "https://www.pinclipart.com/picdir/big/388-3886103_calendar-icon-calendar-symbol-clipart.png", 
                    buttonImageOnly : true,             
                    dateFormat: "yy-mm-dd",             
                    changeMonth: true,                                  
                    onClose: function( selectedDate ) {    
                        $("#toDate").datepicker( "option", "minDate", selectedDate );
                    }                
                });

                //종료일.
                $('#toDate').datepicker({
                    showOn: "both", 
                    buttonImage: "https://www.pinclipart.com/picdir/big/388-3886103_calendar-icon-calendar-symbol-clipart.png",  
                    buttonImageOnly : true,
                    dateFormat: "yy-mm-dd",
                    changeMonth: true,
                    onClose: function( selectedDate ) {
                        $("#fromDate").datepicker( "option", "maxDate", selectedDate );
                    }                
                });
            });
        </script>

</head>
    <body>
    <div class="logo" style="float:left;">
    <a href="index.php"><img src="./image/youtubelogo.jpg" width="150px" height="80px"></a>
    </div>
        <h3> 조회 기간 선택 </h3>
    <form action="" method="GET">
          <label for="fromDate"></label>
          <input type="text" name="fromDate" id="fromDate">
          ~
          <label for="toDate"></label>
          <input type="text" name="toDate" id="toDate">
        <input type="image" src="https://www.pinclipart.com/picdir/big/485-4851736_free-png-search-icon-search-icon-free-download.png" class="button">
    </form><br> <br>
    <div class="div">    
    <table>
            <?= $title ?>
            <?= $article ?>
            <?= $noResult ?>
        </table>
</div>
    </body>
</html>