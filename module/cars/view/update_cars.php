<div id="main-wrapper">
    <form method="post" name="update_car" id="update_car">
        <h1>Modificar coche</h1>
        <table border='0' class="form_table">        
            <tr>
                <td width="120" class="form_table_label">License number: </td>
                <td width="310"><input type="text" id="license_number" name="license_number" placeholder="0000A000A00A000A0" value="<?php echo $id['license_number'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_license_number" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Brand: </td>
                <td><input type="text" id="brand" name="brand" placeholder="BMW" value="<?php echo $id['brand'];?>"/></td>
                <td><font color="red">
                    <span id="error_brand" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Model: </td>
                <td><input type="text" id= "model" name="model" placeholder="X6" value="<?php echo $id['model'];?>"/></td>
                <td><font color="red">
                    <span id="error_model" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Car plate: </td>
                <td><input type="text" id= "car_plate" name="car_plate" placeholder="0000XXX" value="<?php echo $id['car_plate'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_car_plate" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Km: </td>
                <td><input type="text" id="km" name="km" placeholder="000000" value="<?php echo $id['km'];?>"/></td>
                <td><font color="red">
                    <span id="error_km" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Type: </td>
                <td>
                    <?php
                        // $data = 'hola crtl user create';
                        // die('<script>console.log('.json_encode( $id['type'] ) .');</script>');

                        if ($id['type']==="GS"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" readonly checked/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="DS" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" readonly/>Hybrid
                    <?php    
                        } else if ($id['type']==="DS"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="DS" readonly checked/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" readonly/>Hybrid
                    <?php
                        } else if ($id['type']==="ET"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="DS" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" readonly checked/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" readonly/>Hybrid
                    <?php   
                        } else if ($id['type']==="HB") {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="DS" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" readonly checked/>Hybrid
                    <?php   
                        }
                    ?> 
                </td>
                <td><font color="red">
                    <span id="error_type" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Comments: </td>
                <td><textarea cols="30" rows="5" id="comments" name="comments" placeholder="comments"><?php echo $id['comments'];?></textarea></td>
                <td><font color="red">
                    <span id="error_comments" class="error">
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Discharge date: </td>
                <td><input id="fecha" type="text" name="discharge_date" placeholder="dd/mm/yyyy" value="<?php echo $id['discharge_date'];?>"/></td>
                <td><font color="red">
                    <span id="error_discharge_date" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Color: </td>
                <td><input type="text" id="color" name="color" placeholder="Red" value="<?php echo $id['color'];?>"/></td>
                <td><font color="red">
                    <span id="error_color" class="error"></span>
                </font></font></td>
            </tr>

            <td class="form_table_label">Additional features: </td>
                <?php
                    $afi=explode(":", $id['extra']);
                ?>
                <td>
                    <?php
                        $busca_array = in_array("Camara trasera", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Camara trasera" checked/>Rear camera
                    <?php
                        } else{
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Camara trasera"/>Rear camera
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Modo crucero", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Modo crucero" checked/>Cruise control
                    <?php
                        }else{
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Modo crucero"/>Cruise control
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Navegador", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Navegador" checked/>Browser
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extra[]" name="extra[]" value="Navegador"/>Browser
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Cargador inalambrico", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Cargador inalambrico" checked/>Wireless charger</td>
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extra[]" name="extra[]" value="Cargador inalambrico"/>Wireless charger</td>
                    <?php
                        }
                    ?>
                </td>
                <td><font color="red">
                    <span id="error_extra" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <!-- <td><input type="submit" name="update" id="update"/></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="validate('update')" value="Apply"/></td>
                <td align="right"><br><a class="Button_green" href="index.php?module=cars&op=list">Back</a></td>
            </tr>
        </table>
    </form>
</div>