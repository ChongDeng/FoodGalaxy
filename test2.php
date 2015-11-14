<?php
if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	print $_POST["name"]."<br>".$_POST["age"];
	exit();
}
?>