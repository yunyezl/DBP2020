# 대한민국 트렌딩 유투브 모아보기
대한민국에서 트렌딩 된 유투브 정보들을 조회할 수 있습니다.

1. 메인 화면
![image](https://user-images.githubusercontent.com/69361613/97792291-ba4b6800-1c1f-11eb-891a-152e68a0c897.png)
2. 카테고리별 인기 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792304-dcdd8100-1c1f-11eb-839b-ef7184393fbf.png)
3. 해시태그별 인기 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792326-072f3e80-1c20-11eb-863d-8fd4158f9ff3.png)
4. 기간별 트렌딩 비디오 리스트
![image](https://user-images.githubusercontent.com/69361613/97792340-2c23b180-1c20-11eb-8049-c682813dcd5a.png)

### 개발 환경
1. 데이터베이스 - MariaDB
MariaDB가 Mysql보다 가볍고 성능이 빠르다고 들었기 때문에 1차적으로 MariaDB를 선택하기로 했지만 내가 다루는 데이터 수준에서 MariadB와 MySql의 정확한 차이를 알 수 없어서, 여러 자료를 찾아보았고 다음과 같은 자료를 읽게 되었다.
[MySQL에서 MariaDB로 마이그레이션 해야 할 10가지 이유](https://xdhyix.wordpress.com/2016/03/24/mysql-%EC%97%90%EC%84%9C-mariadb-%EB%A1%9C-%EB%A7%88%EC%9D%B4%EA%B7%B8%EB%A0%88%EC%9D%B4%EC%85%98-%ED%95%B4%EC%95%BC%ED%95%A0-10%EA%B0%80%EC%A7%80-%EC%9D%B4%EC%9C%A0/)
특히 mariaDB는 오라클 독점 데이터베이스가 아닌 오픈 소스이기 때문에 빠른 릴리즈가 이루어진다는 점이 마음에 들었고, 이러한 점을 종합해서 성능면에서도, 디비 특성 자체에서도 MariaDB가 의심 할 여지없이 더 나은 선택이라는 결론이 나왔다.
2. 백엔드 - PHP
3. 프론트엔드 - HTML/CSS
만들다보니 디자인적 요소를 넣고 싶어서 CSS를 추가하였다. 
4. 서버 - Linux/Apache Web server
Linux 서버를 사용할 경우  +window 환경을 사용할 때보다 보안성 측면에서 우수하며 local이 아닌 실제 서버를 등록할 경우 Linux는 OS 자체가 오픈 소스인 반면 윈도우는 서버로 사용할 경우 리눅스에 비해 훨씬 더 많은 비용이 든다. 또한 대부분의 기관들이 리눅스 서버를 이용하기 때문에 자료가 더 풍부하다고 생각했다. 이러한 이유들로 linux 서버를 선택했다.

### 선택한 데이터와 출력한 정보
흥미있는 데이터 + 최신의 데이터를 이용하고 싶어서 kaggle 데이터를 이용하기로 했다. 그 중에서도 'Youtube Trending Video Dataset(updated daily)' 데이터셋을 사용했다. 매일 데이터가 업데이트 되기 때문에 가장 최신의 데이터를 이용할 수 있었다.
![image](https://user-images.githubusercontent.com/69361613/97792790-6a23d400-1c26-11eb-806c-ddf690f4d530.png)
![image](https://user-images.githubusercontent.com/69361613/97792803-a48d7100-1c26-11eb-8710-f307de8081f3.png)
여러 개의 테이블이 아닌 단일 테이블로 구성되어있는 데이터베이스

1. 카테고리별 데이터베이스 조회
![image](https://user-images.githubusercontent.com/69361613/97792868-883e0400-1c27-11eb-931c-81422ea876d8.png)
GROUP BY : 일별 트렌딩 데이터이기 때문에, 다른 날짜에 동일한 비디오가 트렌딩 되어 중복 데이터가 다량 발생하였다. 따라서 동일한 video_id를 가진 데이터의 경우 하나로 묶고 최초 트렌딩 날짜 기준으로 데이터가 출력되도록 GROUP BY 함수를 이용하였다.

2. 태그별 데이터베이스 조회
![image](https://user-images.githubusercontent.com/69361613/97792902-eb2f9b00-1c27-11eb-9669-a17f95ede10e.png)
DATE 함수 : 해당 테이터베이스는 시간까지 포함하고 있는데, 출력을 할 때 년-월-일 만을 출력하기를 원했음.
REPLACE 함수 : 해당 테이터는 tags 속성값들을 | 구분자를 이용해서 구분하였으나 해시태그라는 특성에 맞게 # 로 변경하길 원했음.

3. 기간별 데이터베이스 조회
![image](https://user-images.githubusercontent.com/69361613/97792958-89bbfc00-1c28-11eb-9708-505a381eac9a.png)
시작일과 종료일을 GET 형식을 통해 받아와서 데이터를 출력함.

[구동영상](https://youtu.be/4lsQ_3Fx9Tw)

