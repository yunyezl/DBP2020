---
title:  "[week5] 리눅스 환경에서 mariaDB 실습하기"
excerpt: "2020-2 SSWU Database programming 학습 일지"

categories:
  - database programming
tags:
  - database
  - programming
  - study
  - php
last_modified_at: 2020-10-05T23:49:00-05:00
---


## 새로 배운 내용
- 방화벽 상태 확인  <pre><code>sudo ufw status</code></pre>
- apache 상태 확인  <pre><code>sudo systemctl status apache2.service</code></pre>
- maridadb 상태 확인 <pre><code>sudo systemctl status mariadb</code></pre>
- install <pre><code>sudo apt install apache2 / sudo apt install php libapache2-mod-php php-mysql / sudo apt install mariadb-server</code></pre>
- ip 주소 확인 <pre><code>hostname -I</code></pre>

### 문제가 생기거나 고민한 부분
이번 실습에서는 오류가 나지 않았다.

### 회고
#### +
>  리눅스 환경이 아직 낯설지만 재밌다. 윈도우보다 프로그램 설치가 더 쉽고, 익숙해지면 더 편할 것 같다. git bash를 사용하면서 명령어를 좀 익혀둬서 수월했다.
#### -
> 이번에 새로운 노트북으로 맥북을 주문했는데 virtual Box를 제대로 사용할 수 있을지 살짝 걱정된다. 그리고 이번주도 추석전에 듣겠다고 다짐했으나 결국 추석이 다 끝나고 과제 제출 당일날 과제를 하게 됐다. :(..
#### !
> 2학년(무려 2년반 전..)때 컴퓨터 시스템 관리 수업에서 페도라 환경에서 실습한 적이 있는데, vmware를 재설치하니까 그 때 설치한 서버들이 그대로 남아있어서 놀랐다.

[구동 영상](https://www.youtube.com/watch?v=xZRzIZMlTmI)
