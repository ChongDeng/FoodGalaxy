<?php
if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	header('Content-Type:text/html;charset=GB2312');
	print "��������PHPnima�ַ���.";
	exit();
}

$filename = 'C://test.txt';
    $content = "yes\r\n";
    $handle = fopen($filename, 'a');
    fwrite($handle, $content);
    fclose($handle);
    
?>