<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

  <h1>Probando helper URL</h1>
	<?php    $enlace = base_url("probando_helper_url/muestra_base_url"); ?>   
<div class="container">
	<div class="row">
		<h1><?php echo $enlace; ?></h1>
		<h1>hosd</h1>
		<a href="<?php echo $enlace; ?>">Muestra la URL base</a>
    </div><!-- .row -->
</div><!-- .container -->
