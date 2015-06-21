<select name="ano" class="Formulario" id="ano">
<?php
for($i = 2002; $i <= date('Y'); $i++){
?>
	<option value="<?php print($i); ?>" <?php if($i == date('Y')){ print('selected'); }?>><?php print($i); ?></option>
<?php
}
?>
</select>