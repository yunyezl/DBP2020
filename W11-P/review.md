# 11주차 학습 회고 - JAVA + ORACLE : CRUD 
## 배운 내용
### DriverManager , Connection, Statement, ResultSet
* Connection : jdbc 드라이버와 oracle을 연동하기 위해 필요한 인터페이스. DriverManager 클래스의 getConnection 메서드에  url, userName, password를 인자로 넘긴 후 반환받은 값을 저장하고 후에 createStatement 메서드 혹은 prepareStatement 메서드를 통해 질의를 수행한다.
* Statement : SQL 문을 수행하기 위한 인터페이스. Connection 객체의 createStatement 메서드가 반환한 값을 저장한다.
	* preparedStatement : statement의 자식 인터페이스로, statement와의 가장 큰 차이점은 sql 문에 ?(question) 키워드를 작성하여 동적인 쿼리 생성이 가능하다는 것이다. Statement 는 statement 객체의 executeQuery 메서드를 실행할 때 sql을 넘기는 반면 preparedStatement 의 경우 connection 객체의 preparedStatement 메서드를 실행할 때 sql 값을 넘겨준다.
* ResultSet : 쿼리를 실행한 결과값을 저장한다. getString, getInt 등의 다양한 메서드를 통해 결과값을 가져올 수 있다.

### Transaction
* 트랜잭션의 네 가지 성질
	* 원자성 atomicity : 트랜잭션의 연산은 db에 모두 반영되거나 전혀 반영되지 않아야 한다.
	* 일관성 consistency : 실행이 성공적으로 완료하면 DB 상태가 일관성있게 변환된다.
	* 독립성 isolation : 둘 이상의 트랜잭션이 병행될 경우, 다른 트랜잭션에 끼어들 수 없다.
	* 지속성 durability : 트랜잭션이 성공적으로 수행하면 그 결과는 영구적으로 반영되어야 한다.
* 실행한 쿼리가 commit 되지 않았으면 rollback 함수를 통해 이 전의 상태로 되돌아갈 수 있다.

### 리팩토링
* 외부 동작을 바꾸지 않으면서 내부적으로 코드를 개선하여 보다 이해하기 쉽고, 변경이 용이하도록 함. 이번 강의에서는 select, update 등 DML을 실행할 때마다 DB에 연결, 해제하는 코드를 작성했던 것을 하나의 메서드(각각 getConnection, closeAll) 로 만듦으로서 중복을 제거함.

## 오류 발생 내용 + 해결 과정
* **the network adapter could not establish the connection 에러**. 
10주차 실습에서 연결이 되는 것을 확인한 후  11주차 실습을 위해 다시 연결 테스트를 했는데 연결이 되지 않았다. 나의 실습 환경의 경우 docker를 이용하여 oracle xe를 설치하였기 때문에 docker를 실행한 후 실습을 진행해야한다는 것을 간과했다. 
* **IntelliJ 모듈 추가 시 라이브러리가 적용되지 않는 문제**  
이클립스의 경우 workspace에 여러 프로젝트를 추가하여 실습을 진행할 수 있지만 인텔리제이의 경우 별도의 워크스페이스가 존재하지 않는다. 그래서 DBP 라는 빈 상위 프로젝트를 생성하고 프로젝트의 하위 모듈로 W10, W11와 같이 주차별 모듈을 추가하는 방식으로 실습을 진행하려고 했는데 모듈을 새로 추가한 후 연결 테스트를 하니 ClassNotFoundException 에러가 발생했다. 외부 라이브러리로 가져왔던 JDBC인 ojdbc6.jar 파일이 새로 추가된 모듈에 적용되지 않아서 생기는 문제인 것 같아 다음과 같은 과정을 진행했다.  
File -> Project Structure -> Modules Tab 선택 -> 모듈 선택(나의 경우 W11-P 모듈) -> 윈도우 하위의 + 버튼 선택 -> Library 선택 -> ojdbc6 선택 -> apply
정상적으로 JDBC 라이브러리가 가져와졌고 연결에 성공할 수 있었다.

## 회고
**+**
> JAVA 언어를 통한 DB 프로그래밍을 처음 배우게 됐는데 php를 할 때보다 재밌는 것 같다.  웹 어플리케이션과 연동할 실습도 기대된다.  

**-**
> 수업을 들을 때 집중력이 너무 떨어진다. 강의당 러닝타임이 길지도 않은데 자꾸만 핸드폰을 본다. 10분짜리를 듣고 20분은 족히 쉰다.. 왜 이럴까..  

[DBP 11주차 과제 녹화 - YouTube](https://www.youtube.com/watch?v=As1D2Pwey-0&feature=youtu.be)
