# 14주차 학습 일지
## 새로 배운 내용
* mongoDB : 도큐먼트 지향 데이터베이스 시스템으로 대규모 시스템에 적합하며 RDBMS에 비해 높은 확장성을 지니고 있다. SQL문을 사용하지 않는 NoSQL이다. mongoDB는 Database, Collection, Document 구조로 설계가 되어있는데, RDBMS에 비유하자면 Collection은 테이블, Document는 데이터 정도로 생각할 수 있다.  RDBMS와 달리 스키마가 존재하지 않으며, BSON 형태로 각 문서가 저장된다.

* MySQL vs mongoDB 용어/구문 비교  

|MySQL 용어|mongoDB 용어|
|--|--|
|database|database|
|table|collection|
|index|index|
|row|JSON document|
|column|JSON field|
|join|embedding and linking|
|primary key|_id field|
|group by|aggegation|

|SQL 구문|mongoDB 구문|  
|--|--|  
|CREATE TABLE USERS(a Number, b Number)|db.createCollection(“mycoll”)|  
|INSERT INTO USERS VALUES(3, 5)|db.users.insert({a:3, b:5})|  
|SELECT * FROM users|db.users.find()|  
|SELECT a,b FROM users WHERE age=20|db.users.find({age:20}, {a:1, b:1})|
|DELETE FROM users WHERE age=20|db.users.deleteMany({age:20})|

## 오류 발생 내용
없었음

## 참고한 내용
[mongoDB란? - 한 눈에 끝내는 Node.js](https://edu.goorm.io/learn/lecture/557/%ED%95%9C-%EB%88%88%EC%97%90-%EB%81%9D%EB%82%B4%EB%8A%94-node-js/lesson/174384/mongodb%EB%9E%80)

## 회고
**+**
> NoSQL에 대해서 평소에 궁금했었는데 이번 기회에 알 수 있게 되어 좋았다.  아직 잘은 모르지만 compass라는 툴이 매우 편해보였고, 나중에 기회가 된다면 다른 프로젝트에 nodejs+mongoDB로 서버를 만들어서 적용시키고 싶다!

**-**
> 괄호가 헷갈려서 터미널 상에서 오타가 많이 난다. compass를 이용하는 게 좋을 것 같다.

**!**
> 교수님이 맥 사용자들까지 챙겨주셔서 편리하게 설치할 수 있었다!

[14주차 과제 - YouTube](https://youtu.be/Po_sBvaCL94) - 녹화하면서 입력하면 보기 힘드실 거 같아서 미리 작성해놓고 복사해서 사용했습니다 😀 (배경음악 소리 주의)
