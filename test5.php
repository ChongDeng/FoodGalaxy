<?php
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// ʹ�� !== ��������ʹ�� != �����������ڴ�������������
// ��Ϊ 'a' ��λ���� 0����� (0 != false) �Ľ���� false��
if ($pos !== false) {
     echo "The string '$findme' was found in the string '$mystring'";
         echo " and exists at position $pos";
} else {
     echo "The string '$findme' was not found in the string '$mystring'";
}
?> 