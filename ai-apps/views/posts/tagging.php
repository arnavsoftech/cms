<script>
    $(document).ready(function(){

        $('#addlink').hide();

        $('#add').click(function(){
            $('#addlink').toggle();
        });
        $('#chackall').click(function(){
            $('input:checkbox').not(this).prop('checked', (this).checked);
        });
    });
</script>
    <!-- Main content -->
    <section class="content">

            <h2>Tagging</h2>

    <div class="box box-default color-palette-box">
     <table class="table table-striped">
     <thead>
            <tr>
                <th style="width:5%;"> <input type="checkbox" id="chackall"> </th>
                <th style="width:5%;"> Sl No </th>
                <th style="width:75%;"> Tags </th>
                <th style="width:15%;">Actions</th>
            </tr>
        </thead>
        
        <tbody>
        <form method="POST" action="<?php echo admin_url('posts/checktagging'); ?>">
            <?php
            if(is_array($tag) && count($tag) > 0)
            {
                $i = 0;
                foreach($tag as $t)
                {
                    $i++;
                    ?>
                    <tr>
                        <td> <input type="checkbox"  name="check[]" value="<?php echo $t->id; ?>"> </td>
                        <td> <?php echo $i ?>. </td>
                        <td> <input class="form-control input-sm" type="text" name="tag_<?php echo $t->id; ?>" value="<?php echo $t->tag; ?>"> </td>
                        <td><a href="<?php echo admin_url('posts/tagging_delete/'.$t->id) ?>?url=posts/tagging" data-id="33" class="btn btn-xs btn-danger del-tag" title="Delete"><i class="glyphicon glyphicon-trash"></i> Delete</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
<tr><td colspan="4"><div class="text-center">
            <?php echo $paginate; ?>
        </div></td></tr>

            <tr>
                <td colspan="4" style="text-align: center; border-top: 1px solid #ccc; background-color: white;">
                    <input type="submit" name="save" value="Save Checked" class="btn btn-primary">
                    <input type="submit" name="delete" value="Delete Checked" class="btn btn-danger">
                    <br>
                    <br>
                    <a id="add" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> ADD Tag</a>
                </td>
            </tr>

        </form>
        </tbody>
         <tfoot>
         <tr style="text-align: center;">
             <td colspan="5">

                 <div id="addlink">

                     <div style="border: 1px solid #ccc;padding: 15px 20px 0px 20px;">
                         <form method="POST" action="<?php echo admin_url('posts/tagging'); ?>">
                             <div class="form-group">
                                 <div class="row">
                                     <label class="col-sm-2" style="text-align: left;">Tag</label>
                                     <div class="col-sm-10">
                                         <input type="text" class="form-control" name="tag" value="">
                                     </div>
                                 </div>
                             </div>

                             <div class="form-group">
                                 <div class="row">

                                     <div class="col-sm-12">
                                         <input type="submit" name="submit" value="submit" class="btn btn-success">
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </td>
         </tr>
         </tfoot>
    </table>
      <!-- Your Page Content Here -->
</div>
    </section>
    <!-- /.content -->

