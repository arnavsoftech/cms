<div class="page-header">
	<h2>City</h2>
	<div class="row">
		<div class="col-sm-6">
			<form method="get" action="<?= current_url(); ?>">
				<div class="input-group">
					<input type="text" name="q" value="" class="form-control input-sm" />
					<div class="input-group-btn">
						<input type="submit" name="btn_search" value="Seach" class="btn btn-primary btn-sm" />
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-6 text-right">
			<a class="btn btn-sm btn-primary" href="<?php echo admin_url('cities/add'); ?>"><i class="fa fa-plus-circle"></i> Add New City</a>
		</div>
	</div>
</div>

<table class="table table-striped">
    <thead>
		<tr>
			<th>#ID</th>
			<th>City Name</th>
            <th>Parent</th>
            <th>In Menu</th>
            <th>[lat,lng]</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php echo (count($city) < 1)?'<tr><td style="text-align:center;" colspan="5">No Record Found</td></tr>':''?>

		<?php foreach($city as $row):
            $o = $this -> City_model -> get($row -> id);
            //print_r($o);
            ?>
        	<tr>
            	<td><?= $row -> id; ?></td>
            	<td><?= $row -> city_name; ?></td>
            	<td><?= $o -> parent; ?></td>
                <td><?php if($row -> show_in_menu) echo 'Yes'; ?></td>
                <td>[<?= $row -> lat . ',' . $row -> lng; ?>]</td>
                <td>
					<div class="btn-group pull-right">
                    	<a href="<?= admin_url('cities/add/'.$row -> id); ?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="<?= admin_url('cities/delete/'.$row -> id);?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i> Delete</a>
                    </div>
				<?php

				?></td>
        	</tr>
        <?php endforeach; ?>
	</tbody>
</table>
<div class="pagination pagination-sm">
	<?php echo $paginate; ?>
</div>
