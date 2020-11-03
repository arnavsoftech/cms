<div class="page-header">
	<h2>Gallery :: <?php echo $gallery_name; ?> <a href="<?php echo admin_url('gallery/multiple/'.$id); ?>" class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Upload New</a></h2>
</div>
<?php echo form_open(admin_url('gallery/view/'.$id)); ?>
<div class="pull-right">
	<label class="btn btn-sm btn-default">
		<input type="checkbox" name="re_crop" value="1" /> Recrop Images
	</label>
    <input type="submit" name="bulk_save" value="Save Cover Image" class="btn btn-info" />
</div>
<div class="row-fluid">
<table class="table table-striped">
	<thead>
    	<tr>
        	<th>Image</th>
            <th>Title</th>
            <th>URL</th>
            <th>Cover Image</th>
            <th width="100">&nbsp;</th>
        </tr>        
    </thead>
    <tbody>
    	<?php foreach($image_list as $row): ?>
        	<tr>
            	<td><img src="<?php echo base_url(upload_dir($row['image']));  ?>" width="100" class="thumbnail" /></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo base_url(upload_dir($row['image']));  ?> </td>
                <td><input type="radio" name="cover_image" value="<?php echo $row['id']; ?>" <?php if($gallery['cover_image'] == $row['id']) echo 'checked'; ?> /> </td>
                <td><div class="pull-right btn-group">
                <a title="Edit Phhoto" href="<?php echo admin_url('gallery/edit_image/'.$row['id']); ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
                <a title="Delete Photo" href="<?php echo admin_url('gallery/delete_image/'.$id.'/'.$row['id']); ?>" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></a></div></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php echo form_close(); ?>