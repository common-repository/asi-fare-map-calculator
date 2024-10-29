<?php
add_action('init', 'asi_map_register_shortcodes');
function asi_map_register_shortcodes() {
    //register shortcode
    add_shortcode('asi-map', 'asi_map_shortcode');
}
function get_allfares()
            {
                global $wpdb;
                $table_name = $wpdb->prefix."fare";
                $fares = $wpdb->get_row("SELECT * FROM $table_name",ARRAY_A);
                return $fares;
            }
// The shortcode
function asi_map_shortcode($atts) {
         $allfare=get_allfares();
         $cartype=new asi_map_plugin_admin();
         $cartypes=$cartype->Get_allselected_car();
         $select='<select name="cartypes" class="form-control" id="cartypes" style="width: 75%;padding-left: 15px; float: right;">';
         foreach($cartypes as $car)
         {
            $select.='<option value="'.$car['fare'].'">'.$car['name'].'</option>';
         }
         $select.='</select>';
         $color=$allfare['color'];
         if($color!="")
         {
            $color='background-color:'.$allfare['color'];
         }
        
		$displayform='<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-7 col-xs-12" id="main1" style="'.$color.'; padding-bottom: 15px">
					<form id="order" method="">
			
						<div class="row">
							<label class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px">
							'.__("Taxi Type :").'
							</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px;">
								'.$select.'
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
								<input type="text" class="form-control" id="source" name="source" placeholder="'.__("PickUp Address").'">
								<input style="display: none;" type="text" hidden class="form-control" id="stops_count_s" name="stops_count">
							</div>
						</div>
						<div class="row">
							<label class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px">
								'.__("Additional Stops :").'
							</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px;">
								<input style="padding-left: 15px; width: 75%; float: right;" class="form-control" type="number" value="0" min="0" name="stops_count" id="stops_count">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
								<input type="textbox" id="destination" name="destination" placeholder="'.__("DropOff Address").'" class="form-control" value="" />
							</div>
						</div>
						<div class="row">
							<label class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px">
								'.__("Car Seats :").'
							</label>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-top: 15px;">
							<input type="checkbox" hidden name="baby_seat" id="baby_seat" onChange="set_baby()">   
                        <select name="baby_count" class="form-control" id="baby_count" style="width: 75%;padding-left: 15px; float: right;">
         <option value="0"> 0</option>
        <option value="1"> 1</option>
          <option value="2">2</option>
            <option value="3">3</option>
        </select></div>
						</div>
					
						<div class="calBlue_line">
						</div>
						<div class="form-group">
							<div class="col-xs-12" style="text-align: center;padding-top: 15px; margin-bottom: 15px">
								<input type="button" id="cal1" name="submit" value="'.__("Calculate").'" onClick="doCalculation()" class="btn btn-primary "style="font-size: 14px; font-weight: bold" />
								<input type="button" class="btn" name="reset" value="'.__("Reset").'" onclick="clear_form_elements(this.form)" style="font-size: 14px; font-weight: bold;" />
							</div>
                             <input type="hidden" name="distance"  id="distance" readonly value=""/>
                            <input type="hidden" name="fare" id="fare" readonly value=""/>
                             <input type="hidden" name="duration" id="duration" readonly value=""/>
							<input type="hidden" name="latitude" id="latitude" value="" />
							<input type="hidden" name="longitude" id="longitude" value="" />
							<input type="hidden" name="dest_latitude" id="dest_latitude" value="" />
							<input type="hidden" name="dest_longitude" id="dest_longitude" value="" />
                            <input type="hidden"  name="stopfare" id="stopfare" value="'.$allfare['stop'].'"/>
                            <input type="hidden"  name="milefare" id="milefare" value="'.$allfare['mile'].'"/>
                             <input type="hidden"  name="seatfare" id="seatfare" value="'.$allfare['seat'].'"/>
                            <input type="hidden"  name="minutefare" id="minutefare" value="'.$allfare['minute'].'"/>
                            <input type="hidden"  name="currfare" id="currfare" value="'.$allfare['curr'].'"/>
                            <input type="hidden" name="diskmmiles" id="diskmmiles" value="'.$allfare['diskmmile'].'"/>
                            
						</div>
						<div class="table-float" style="text-align: center; margin-top: 10px; float: none">
							<div id="po" style="display:none;text-align:left;">
                            <span class="nearest">'.__("Estimated Fare: ").'</span><span id="estfare"></span><br>
                            <span class="nearest">'.__("Distance: ").'</span><span id="estdist"></span><br>
                            <span class="nearest">'.__("Duration: ").'</span><span id="estdur"></span><br>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
        
	<div class="table-float" style="text-align: center">
		<div id="po" style="display: none; text-align: left"></div> 
	</div>
<div class="clear"></div>
<div style="padding-top: 15px;">
    <div id="map_canvas" class="map" style="height:400px;"></div></div>';
return $displayform;
} 
?>
