<div class="page-header">
	<h2>Menu Settings</h2>
</div>
<?= form_open(admin_url('menu/settings'), array('class' => 'form-horizontal')); ?>
<?php
$menus = $this -> config -> item('menus');
if($menus <> NULL){
	foreach($menus as $m){
		$allmenus = $this -> Menu_model -> all_groups();
		$mar = array('' => 'Select Menu');
		if(is_array($groups) && count($groups) > 0){
			foreach($groups as $g){
				$mar[$g['id']] = $g['group_name'];
			}
		}
		$dfv = $this -> Setting_model -> get_option_value($m[0]);
		?>
		<div class="form-group">
			<label for="name" class="col-sm-2"><?= $m[1]; ?></label>
			<div class="col-sm-4">
				<?= form_dropdown($m[0], $mar, set_value($m[0], $dfv), 'class="form-control input-sm"'); ?>
			</div>
		</div>
		<?php
	}
}
?>
<div class="form-group">
	<div class="col-sm-4 col-sm-offset-2">
		<button type="submit" name="submit" value="Set Menu" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-floppy-disk"></i> Set Menu</button>						     <a href="<?php echo admin_url('menu'); ?>" class="btn btn-sm btn-default">Cancel</a>
	</div>
</div>
</form>
