# 10주차 학습 회고 - JAVA + JDBC + ORACLE 연동
### 배운 내용 
1. **MySQL, MariaDB, ORACLE**  
지금까지 총 3가지의 DBMS를 배웠다. 비슷하지만 다른 세 개의 DB를 정리해보았다.  

||MySQL|MariaDB|ORACLE|
|--|------|---|---|
|**설명**|오픈 소스 기반 DBMS|MySQL와 호환되는 오픈 소스 기반 DBMS|상업적 용도로 사용되는 DBMS|
|**데이터베이스 모델**|RDBMS|RDBMS|RDBMS|
|**라이선스**|open source+commerical|open source(GPL)|commerical|
|**소유**|Oracle|MariaDB Enterprise|Oracle|

배우는 수준에서 세 개를 비교하는 것이 큰 의미는 없어보이지만 궁금해서 찾아보았는데 오라클은 기업용이기 때문에 성능면에서 가장 뛰어나다고 한다. 전체 데이터를 select 하는 것을 기준으로 3000개 이내의 데이터를 조회할 때는 큰 차이가 없었지만 약 800만개의 데이터를 조회할 경우 Oracle 23초, MariaDB 236초로 큰 차이를 보였다는 자료를 보았고 차이가 크다는 것을 실감했다.  

2. **MAC에서 JAVA + JDBC + ORACLE 연동하기**   
교수님이 강의하시는 윈도우 환경과 설치 환경이 달라서 조금 다른 방식으로 설치를 해야 했다. docker를 이용해서 Oracle XE를 설치해야한다는 것 빼고는 큰 차이가 없어서 Docker에 관한 내용만 정리해보았다.
- Oracle XE 11g R2 설치하기 - DOCKER 이용  
Mac에서는 oracle XE 11g R2를 바로 사용하기 어렵기 때문에 Docker를 사용해야한다. 한 번도 써본 적이 없어서 찾아봤는데, 완벽하게 이해할 수는 없었지만 "서버 관리에 필요한 서로 다른 다양한 프로그램들을 추상화하여 동일한 인터페이스 사용을 가능하게 함으로써 서버 관리를 용이하게 해주는 프로그램"인 것 같았다. 
- 사용한 명령어  
~~~
docker pull jaspeen/oracle-xe-11g 
~~~
~~~
docker run --name oracle11g-test -d -p 8080:8080 -p 1521:1521 jaspeen/oracle-xe-11g
~~~
~~~
docker exec -it oracle11g-test sqlplus //터미널에서 sqlplus 실행
~~~
3. **JDBC란?**  
자바와 데이터베이스를 연동하는 데에 필요한 API로 DBMS에 전달될 SQL 구문을 각 시스템(Oracle, MySQL 등)에 맞도록 변경해준다.


### 오류 발생 내용 + 해결 과정
docker에서 deepdiver의 oracle-xe-11g 이미지 파일을 가져온 후 해당 이미지를 컨테이너로 생성한 뒤 실행하는 과정에서  
**docker: Error response from daemon: Ports are not available: listen tcp 0.0.0.0:49161: bind: address already in use.**  
라는 에러 메세지를 마주했다. 49161 포트가 이미 사용되고 있어서 컨테이너 생성이 불가능하다는 것 같았다.  
터미널에서 **netstat -anv|grep LISTEN** 명령어를 사용해서 현재 실행중인 프로세스들의 포트 번호를 확인해봤더니 정말로 해당 포트 번호가 이용되고 있었고 **sudo lsof -i:49161** 를 이용해서 어떤 프로세스인지 확인해보니 UserEvent라는 프로세스가 사용하고 있었다. 건드리면 안될 것 같아서 그냥 deepdiver의 이미지가 아닌 1521 포트번호를 사용하는 jaspeen의 이미지를 새로 가져와서 연결을 해주었더니 해결되었다.


### 참고 자료 
* [[성능 비교] Oracle과 MariaDB의 간단 성능 비교](https://yeti.tistory.com/61)  
* [MariaDB vs MySQL vs ORACLE](https://db-engines.com/en/system/MariaDB%3BMySQL%3BOracle)  
* [[MAC] oracle-xe-11g & SQL Developer 설치](https://clearstar0817.tistory.com/10)  
* [초보자를 위한 도커 안내서 - 도커란 무엇인가?](https://subicura.com/2017/01/19/docker-guide-for-beginners-1.html)  

### 회고
**+**
> 비교적 익숙한 언어인 JAVA로 데이터베이스 프로그래밍을 하게 돼서 기대된다. 자바 수업을 들을 때 인텔리제이로 수업을 하셨어서 이클립스를 처음 써봤는데 아직은 인텔리제이가 조금 더 편한 것 같다. 그래서 두 개 다 연동을 시켜놨는데 둘 다 써보면서 나한테 더 적합한 IDE를 찾아서 사용해야겠다. 인텔리제이 Ultimate 버전은 SQL Developer와 비슷한 기능을 하는(걸로 추정되는) 데이터베이스탭을 제공해서 한 가지 IDE로 작업을 할 수 있는 장점이 있는 것 같다.(학생 인증을 했더니 무료로 사용이 가능했다.)

**-**
> 인텔리제이에서 연동을 할 때 '데이터베이스탭에서 오라클 연동'과 'jdbc를 통한 데이터베이스 프로그래밍'을 혼동해서 시간이 오래 걸렸다. 데이터베이스탭에서 오라클을 연동한 것은 SQL Developer에서 오라클에 접속하는 과정과 다를 바 없는 것이므로 jdbc를 이용해서 데이터베이스와 자바를 연동하는 것과 상관없는 것이었는데 단단히 착각을 했다. 그걸 연동시키고 설정이 다 됐다고 생각을 해서 교수님이 제공해주신 코드를 실행했는데 ClassNotFoundException 에러가 났다. jdbc를 라이브러리에 넣지 않았으므로 당연한 것이었는데 생각을 잘못해서 한참 뒤에야 깨달을 수 있었고 라이브러리에 ojdbc6.jar 파일을 추가해주었더니 정상적으로 연결을 할 수 있었다. 이런 말도 안되는 이유로 에러 발생 과정 겪으면 시간도 오래 걸리고 딱히 해결 방법도 마땅치가 않아서 답답하지만 스스로 깨달으면서 해결해나가는 과정에서 더 많이 얻어갈 수 있는 것 같다.

**!**
> 한 학기에 굉장히 다양한 개발 도구들을 경험할 수 있는 것 같아서 힘들어도 얻어가는게 가장 많은 수업인 것 같다:)

