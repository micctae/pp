<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />

<meta http-equiv="refresh" content="60;url=<?php echo base_url('yy/mientras/'.$evento)?>">
	<script Language="javaScript">
		if(history.forward(1)){
		history.replace(history.forward(1));	
		}
	</script>
	
	<script type="text/javascript">
	function setiar () {
	document.getElementById("ami").focus();
	document.getElementById("ami").value="";
	}
	</script>

	
	<meta charset="utf-8">
	<title>Jesse James</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 30px/50px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 15px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 35px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 10px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<?php
	
?>
<body onload="setiar()" >

<div id="container">
	<h1>Control de Ingreso</h1>

	<div id="body">
	
	<p>Ingresado al momento. <?php echo "Evento: ".$evento." total a entrar: ".$totalaentrar; ?></p>

	<code> #Ingresaron <?php echo $cuanto;?> </code>

	<form action="<?php echo base_url('yy/mientras/'.$evento)?>" method="post">
		<p align="center"><input type="submit" value="Refresh" class="inputstyle" /></p>
	</form>
	
	</div>

	<p class="footer">Pagina rendered en <strong>{elapsed_time}</strong> segundos.</p>
</div>

</body>

</html>