# 13주차 학습회고
## 배운 내용
* JSP : Java Server Page, HTML 내부에 JAVA 코드를 입력하여 웹 서버에서 동적으로 웹 브라우저를 관리함
* 간단하게나마 JSP의 작성 방법을 배움

## 오류 발생 내용
* 처음에 인텔리제이로 실습을 하려고 했는데 실패했다. 셋팅하는 과정은 간단했지만 이상하게 자꾸 url 연결이 안됐다. -> 마땅한 방법이 나오지 않았기도 하고, 시간이 없어서 교수님이 한 방법을 참고하기 위해 이클립스로 넘어갔다.
* Data Source Explorer 탭에서 Oracle과 연결을 하려는데 계속 ping failed이 되었다. 구글링해도 마땅한 방법이 없어서 혹시나.. 하고 jdbc:oracle:thin:@server:1521:xe 이 부분을 jdbc:oracle:thin:@localhost:1521:xe로 변경했더니 연결에 성공했다..!

# 회고
**+** 
> 자바 서버 프로그래밍을 위해 Spring 이라는 프레임 워크를 배우고 있었는데, 지금은 사용하지 않더라도 jsp 를 알아두는게 왜 spring 프레임워크를 사용하는지 더 쉽게 이해할 수 있다고 해서 jsp를 배우고 싶었는데 시간이 없어서 못배우고 있었다. 그런데 짧게라도 이렇게 jsp를 접할 기회가 생겨서 좋았다.  

**-**
> 이클립스, 인텔리제이 두 개를 써보고 느낀 점은 아무래도 인텔리제이의 환경이 훨씬 편하다.  이렇게 느낀건 인텔리제이의 강력한 자동완성, 단축키, ui 등에서 기인한 것 같다. 설정에 실패한 것이 아쉽다.  

**!**
> 맥으로 실습을 하다보니 실습을 따라가기 버거운 점이 많았지만 별도로 환경변수 설정을 하지 않아도 된다는 것은 큰 장점인 것 같다.  

[DBP 13주차 과제 - YouTube](https://youtu.be/jX2SCl9xUHo) : 삭제 기능을 구현하였습니다.

