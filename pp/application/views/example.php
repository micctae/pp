<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
	<div>
		<a href='<?php echo site_url('yy/cuenta/3')?>'>cuenta 3</a> |
		<a href='<?php echo site_url('yy/cuenta/4')?>'>cuenta 4</a> |
		<a href='<?php echo site_url('yy/ccuenta/3')?>'>ccuenta 3</a> |
		<a href='<?php echo site_url('yy/ccuenta/4')?>'>ccuenta 4</a> |
		<a href='<?php echo site_url('yy/mecuenta')?>'>mecuenta</a> |
		<a href='<?php echo site_url('yy/vendedore')?>'>vendedore</a> | 
		<a href='<?php echo site_url('yy/evente')?>'>evente</a> |		 
		<a href='<?php echo site_url('yy/entrege')?>'>entrege</a> |
		<a href='<?php echo base_url('yy/')?>'>volver</a>  
		
		
	</div>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
