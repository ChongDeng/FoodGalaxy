<?php
//ʹ��file()������ȡhtmlĿ¼�µ�cache.txt
$array = file("sensitive_word_list.txt");
if(count($array)) echo "yes"."<br>";
//����file()�������ص�����
foreach($array as $line){
	echo $line."<br>";
}

?>
