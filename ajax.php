<?php
//ʹ��JavaScriptʵ��AJAX����
?>
<script type="text/javascript">
<!--
	//��ʼ������
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
//ʵ��AJAX�������
?>