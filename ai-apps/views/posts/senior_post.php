<div class="page-header">
	<h2>Manage Post </h2>
</div>
	<div class="row-fluid">
	<table class="table table-striped table-search1" id="post-index">
		<thead>
		<tr>
            <th>#ID</th>
			<th>Post Title</th>
            
           <!-- <th>Language</th>-->
            <th>Status</th>
            <th></th>
		</tr>
		</thead>
		<tbody>
		<?php
			$sl = 1;
			foreach($post_list as $row){

                //$a = new AI_Post($row -> id);
				?>
				<tr>
                    <td>#<?= $sl++; ?></td>
					<td><?= $row -> post_title; ?> </td>
					
                   
                    <td>
                        <?php
                        if($row -> status == 1){
                            ?>
                            <a href="<?= admin_url('posts/deactive/' . $row -> id, true); ?>" class="label label-success tip" title="Deactive now">Active</a>
                        <?php
                        }else{
                            ?>
                            <a href="<?= admin_url('posts/active/' . $row -> id, true); ?>" class="label label-danger tip" title="Activate now">Deactive</a>
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                    <div class="btn-group pull-right">

						<a class="btn btn-sm btn-default" href="<?php echo  admin_url('posts/edit/'.$row -> id);?>"><i class="fa fa-pencil"></i> Edit</a>

						<a class="btn btn-sm btn-danger delete" href="<?php echo  admin_url('posts/deletep/'.$row -> id);?>"><i class="fa fa-trash"></i> Delete</a>
					</div>
					</td>
				</tr>
				<?php
			}
		?>
		</tbody>
	</table>
    </div>
<div class="text-center">
	<?php echo $paginate; ?>
</div>
