<?php
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// 使用 !== 操作符。使用 != 不能像我们期待的那样工作，
// 因为 'a' 的位置是 0。语句 (0 != false) 的结果是 false。
if ($pos !== false) {
     echo "The string '$findme' was found in the string '$mystring'";
         echo " and exists at position $pos";
} else {
     echo "The string '$findme' was not found in the string '$mystring'";
}
?> 