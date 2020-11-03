

<table >
    <thead>
		<tr>
		<th>name</th>
			<th>Category name(HN)</th>

		</tr>
	</thead>
	<tbody>
	<?php
	if(is_array($categories) && count($categories) > 0){
		foreach($categories as $cat){
			$c = new AI_Category($cat -> id);
			?>
			<tr>
                <td><?= $c -> title(); ?></td>
                <td><?=$c -> permalink();?></td>


			</tr>
			<?php
		}
	}
	?>
	</tbody>
</table>
