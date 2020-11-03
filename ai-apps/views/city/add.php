<div class="page-header">
	<h2>City Form</h2>
</div>
<div class="row">
    <div class="col-sm-10">
        <?php echo form_open(admin_url('cities/add/'.$city -> id), array('class' => 'form-horizontal')); ?>
        <div class="box">
            <div class="box-p box-bb">
                <h4 class="box-title">City From</h4>
            </div>
            <div class="box-p">
                <div class="form-group">
                    <label class="col-sm-2 control-label">City name</label>
                    <div class="col-sm-5">
                        <input type="text" name="form[city_name]" value="<?php  echo set_value('form[city_name]', $city -> city_name); ?>" data-geo="locality" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Lat</label>
                    <div class="col-sm-2">
                        <input type="text" data-geo="lat" name="form[lat]" value="<?php  echo set_value('form[lat]', $city -> lat); ?>" class="form-control input-sm" />
                    </div>
                    <label class="col-sm-1 control-label">Lng</label>
                    <div class="col-sm-2">
                        <input type="text" data-geo="lng" name="form[lng]" value="<?php  echo set_value('form[lng]', $city -> lng); ?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Google Map</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" id="dragmap" name="ad[map_address]" class="form-control input-sm" value="<?php  echo set_value('form[city_name]', $city -> city_name); ?>" />
                            <div class="input-group-btn">
                                <button type="button" id="find" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Find</button>
                            </div>
                        </div>
                        <div style="height: 5px;"></div>
                        <div class="map_canvas map"></div>
                        <p class="help-text">Drag marker to meet your exact location.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Parent name</label>
                    <div class="col-sm-2">
                        <?php
                        $state_arr = array(
                            0 => 'Top City'
                        );
                        foreach($topcities as $s){
                            if($s -> id == $city -> id) continue;
                            $state_arr[$s-> id] = $s -> city_name;
                        }
                        echo form_dropdown('form[parent_id]', $state_arr, $city -> parent_id, 'class="form-control input-sm"');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sequence</label>
                    <div class="col-sm-2">
                        <input type="text" name="form[sequence]" value="<?php  echo set_value('form[sequence]', $city -> sequence); ?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Featured</label>
                    <div class="col-sm-2">
                        <label class="checkbox checkbox-inline">
                            <input type="checkbox" name="show_in_menu" value="1" <?= ($city -> show_in_menu) ? 'Checked' : ''; ?> /> Yes
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">&nbsp;</label>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <script>
            $(function(){
                $('#dragmap').geocomplete({
                    map: ".map_canvas",
                    <?php
                    if($city -> id){
                        echo 'location: ['.$city -> lat.', '.$city -> lng.'],';
                    }else{
                        echo 'location: "India",';
                    }
                    ?>
                    details: "form",
                    markerOptions: {
                        draggable: true
                    },
                    detailsAttribute: "data-geo"
                }).bind("geocode:dragged", function(event, latLng){
                    $("#inptlat").val(latLng.lat());
                    $("#inptlng").val(latLng.lng());
                });
                $("#find").click(function(){
                    $("#dragmap").trigger("geocode");
                });
            });
        </script>
    </div>
</div>