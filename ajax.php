<?php
//使用JavaScript实现AJAX引擎
?>
<script type="text/javascript">
<!--
	//初始化数据
	var xmlHttp = false;
	try {
		xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
	  	try{
	  		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlHttp = false;
		}
	}
	if(!xmlHttp && typeof XMLHttpRequest != 'undefined') {
		xmlHttp = new XMLHttpRequest();
	}
//-->
</script>
<?php
//实现AJAX引擎结束
?>