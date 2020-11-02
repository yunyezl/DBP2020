# 대한민국 트렌딩 유투브 모아보기
대한민국에서 트렌딩 된 유투브 정보들을 조회할 수 있습니다. (수정 전은 결과적으로 하나의 정보 같아서 내용을 수정했습니다)

1. 메인 화면
![image](https://user-images.githubusercontent.com/69361613/97792291-ba4b6800-1c1f-11eb-891a-152e68a0c897.png)
1-1. 카테고리별 인기 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792304-dcdd8100-1c1f-11eb-839b-ef7184393fbf.png)
1-2. 사용자가 검색한 해시태그에 맞는 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792326-072f3e80-1c20-11eb-863d-8fd4158f9ff3.png)
1-3. 기간별 트렌딩 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792340-2c23b180-1c20-11eb-8049-c682813dcd5a.png)
2. 트렌딩 횟수가 가장 많은 채널 TOP 50 
![image](https://user-images.githubusercontent.com/69361613/97839703-0d0f4780-1d26-11eb-9441-99e99bd31bbe.png)
3. 사용자 선호도에 따른 카테고리 순위
![image](https://user-images.githubusercontent.com/69361613/97839843-5495d380-1d26-11eb-9abf-f2c7c23611c5.png)

### 개발 환경
1. 데이터베이스 - MariaDB  
MariaDB가 Mysql보다 가볍고 성능이 빠르다고 들었기 때문에 1차적으로 MariaDB를 선택하기로 했지만 제가 다루는 데이터 수준에서 MariadB와 MySql의 정확한 차이를 알 수 없어서, 여러 자료를 찾아보았고 다음과 같은 자료를 읽게 되었습니다.  
[MySQL에서 MariaDB로 마이그레이션 해야 할 10가지 이유](https://xdhyix.wordpress.com/2016/03/24/mysql-%EC%97%90%EC%84%9C-mariadb-%EB%A1%9C-%EB%A7%88%EC%9D%B4%EA%B7%B8%EB%A0%88%EC%9D%B4%EC%85%98-%ED%95%B4%EC%95%BC%ED%95%A0-10%EA%B0%80%EC%A7%80-%EC%9D%B4%EC%9C%A0/)  
특히 mariaDB는 오라클 독점 데이터베이스가 아닌 오픈 소스이기 때문에 빠른 릴리즈가 이루어진다는 점이 마음에 들었고, 이러한 점을 종합해서 성능면에서도, 디비 특성 자체에서도 MariaDB가 의심 할 여지없이 더 나은 선택이라는 결론이 나왔습니다.
2. 백엔드 - PHP  
3. 프론트엔드 - HTML/CSS  
만들다보니 디자인적 요소를 넣고 싶어서 CSS를 추가하였습니다.
4. 서버 - Linux/Apache Web server  
Linux 서버를 사용할 경우 window 환경을 사용할 때보다 보안성 측면에서 우수하며 local이 아닌 실제 서버를 등록할 경우 Linux는 OS 자체가 오픈 소스인 반면 윈도우는 서버로 사용할 경우 리눅스에 비해 훨씬 더 많은 비용이 듭니다. 또한 대부분의 기관들이 리눅스 서버를 이용하기 때문에 자료가 더 풍부하다고 생각했으며 후에 현업에 들어갔을 때 더 도움이 될 거라고 생각했습니다. 이러한 이유들로 linux 서버를 선택했습니다.

### 선택한 데이터와 출력한 정보
흥미있는 데이터 + 최신의 데이터를 이용하고 싶어서 kaggle 데이터를 이용하기로 했습니다. 그 중에서도 'Youtube Trending Video Dataset(updated daily)' 데이터셋을 사용했다. 매일 데이터가 업데이트 되기 때문에 가장 최신의 데이터를 이용할 수 있었습니다.
![image](https://user-images.githubusercontent.com/69361613/97792790-6a23d400-1c26-11eb-806c-ddf690f4d530.png)
![image](https://user-images.githubusercontent.com/69361613/97792803-a48d7100-1c26-11eb-8710-f307de8081f3.png)  
원본 데이터 - 단일 테이블로 구성되어있는 데이터셋입니다.

1. 비디오 정보 조회 기능
    1. 카테고리별 데이터베이스 조회 : select Box에 있는 정치, 스포츠, 음악 등의 카테고리를 사용자가 선택하면 해당 카테고리에 맞는 데이터를 조회수로 정렬하여 보여줍니다.
![image](https://user-images.githubusercontent.com/69361613/97792868-883e0400-1c27-11eb-931c-81422ea876d8.png)  
GROUP BY : 일별 트렌딩 데이터이기 때문에, 다른 날짜에 동일한 비디오가 트렌딩 되어 중복 데이터가 다량 발생하였고 따라서 동일한 video_id를 가진 데이터의 경우 하나로 묶고 최초 트렌딩 날짜 기준으로 데이터가 출력되도록 GROUP BY 함수를 이용했습니다.    

    2. 태그별 데이터베이스 조회 : 사용자가 해시태그를 검색하면 해당 키워드를 포함하고 있는 비디오 리스트를 출력해서 보여줍니다. LIKE 함수를 이용하였고 기준을 태그로 잡았기 때문에, 제목에 들어가있지 않더라도 태그를 포함하는 비디오가 출력됩니다.
![image](https://user-images.githubusercontent.com/69361613/97792902-eb2f9b00-1c27-11eb-9669-a17f95ede10e.png)  

    3. 기간별 데이터베이스 조회 : 사용자가 시작일과 종료일을 선택하면 날짜에 맞는 비디오 리스트를 시간순으로 출력합니다. 시작일과 종료일이 적절하지 않게 들어오는 경우를 방지하여 시작일보다 빠른 종료일은 비활성화 되어있습니다.
![image](https://user-images.githubusercontent.com/69361613/97792958-89bbfc00-1c28-11eb-9708-505a381eac9a.png)  
시작일과 종료일을 GET 형식을 통해 받아와서 데이터를 출력했습니다.

2. 가장 많이 트렌딩 된 채널 리스트
![image](https://user-images.githubusercontent.com/69361613/97836684-2b724480-1d20-11eb-84d2-bdce26e10b4b.png)
~~~sql
CREATE TABLE trendingCount AS select channelTitle, count(*) as count from KR group by video_id;
~~~
KR 테이블에서 비디오별 트렌딩 횟수를 저장하는 테이블을 새로 생성하여 활용하였습니다.
![image](https://user-images.githubusercontent.com/69361613/97836503-ccaccb00-1d1f-11eb-8865-0931791d6d3e.png)
video_id 의 갯수를 세서 가장 많은 비디오를 트렌딩 시킨 채널들의 순위를 매깁니다.
- 최근 3개월 간 트렌딩 횟수가 가장 많은 50개의 채널을 보여줍니다.

3. 사용자가 선호하는 카테고리 리스트 확인하기  
선호도를 구하기 위해서 기본 데이터셋에서 동일한 카테고리의 비디오 정보를 저장하는 테이블을 새로 만든 후 각 테이블을 UNION + JOIN 했습니다.  
![image](https://user-images.githubusercontent.com/69361613/97838402-76da2200-1d23-11eb-9d5e-66c6185d1167.png)
~~~sql
SELECT categoryName, categoryId, sum(preference) as pre FROM (SELECT categoryName, car.categoryId, likes+view_count+comment_count as preference FROM car INNER JOIN categoryName n ON car.categoryId = n.categoryId GROUP BY video_id) a  
    UNION SELECT categoryName, categoryId, sum(preference) FROM (SELECT categoryName, animal.categoryId, likes+view_count+comment_count as preference FROM animal INNER JOIN categoryName n ON animal.categoryId = n.categoryId GROUP BY video_id) b
    UNION SELECT categoryName, categoryId, sum(preference) FROM (SELECT categoryName, animation.categoryId, likes+view_count+comment_count as preference FROM animation INNER JOIN categoryName n ON animation.categoryId = n.categoryId GROUP BY video_id) c  
    UNION SELECT categoryName, categoryId, sum(preference) FROM (SELECT categoryName, game.categoryId, likes+view_count+comment_count as preference FROM game INNER JOIN categoryName n ON game.categoryId = n.categoryId GROUP BY video_id) d  
    UNION SELECT categoryName, categoryId, sum(preference) FROM (SELECT categoryName, music.categoryId, likes+view_count+comment_count as preference FROM music INNER JOIN categoryName n ON music.categoryId = n.categoryId GROUP BY video_id) e  
    UNION SELECT categoryName, categoryId, sum(preference) FROM (SELECT categoryName, sport.categoryId, likes+view_count+comment_count as preference FROM sport INNER JOIN categoryName n ON sport.categoryId = n.categoryId GROUP BY video_id) f
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, news.categoryId, likes+view_count+comment_count as a FROM news INNER JOIN categoryName n ON news.categoryId = n.categoryId GROUP BY video_id) g  
    UNION SELECT categoryName, categoryId, sum(a) FROM (SELECT categoryName, tech.categoryId, likes+view_count+comment_count as a FROM tech INNER JOIN categoryName n ON tech.categoryId = n.categoryId GROUP BY video_id) h
    ORDER BY pre DESC;
~~~
기존 데이터셋은 카테고리를 숫자로 제공했기 때문에 별도로 카테고리ID별 categoryName을 저장하는 테이블을 추가적으로 만들어줘야했습니다. 이후 카테고리 아이디와 카테고리 이름을 조인해주는 서브쿼리를 작성하고 해당 서브쿼리에서 한 개의 비디오별로 좋아요, 댓글 수, 조회수(이하 선호도)를 합해주었기 때문에 메인쿼리에서 sum 함수를 이용해서 카테고리가 포함하고 있는 모든 비디오의 선호도를 합해주었습니다. 그리고 선호도별로 정렬을 해야하므로 카테고리별로 구한 선호도를 UNION을 통해 합쳐주었습니다.  
한 줄 요약하자면 **카테고리별 사용자 선호도를 구해서 선호도가 높은 순으로 카테고리를 출력**하는 쿼리입니다. 


[구동영상](https://youtu.be/WaskIPpcRHo)

