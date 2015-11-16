<?php
//使用file()函数读取html目录下的cache.txt
$array = file("sensitive_word_list.txt");
if(count($array)) echo "yes"."<br>";
//遍历file()函数返回的数组
foreach($array as $line){
	echo $line."<br>";
}

?>
