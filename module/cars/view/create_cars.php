<div id="main-wrapper">
    <form method="post" name="alta_car" id="alta_car">
        <h1>New Car</h1>
        <br>
        <table border='0' class="form_table">
            <tr>
                <td width="150" class="form_table_label">License number: </td>
                <td width="310"><input type="text" id="license_number" name="license_number" placeholder="0000A000A00A000A0" value=""/></td>
                <td><font color="red">
                    <span id="error_license_number" class="error"></span>
                </font></font></td>
            </tr>
        
            <tr>
                <td class="form_table_label">Brand: </td>
                <td><input type="text" id="brand" name="brand" placeholder="BMW" value=""/></td>
                <td><font color="red">
                    <span id="error_brand" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Model: </td>
                <td><input type="text" id="model" name="model" placeholder="X6" value=""/></td>
                <td><font color="red">
                    <span id="error_model" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Car plate: </td>
                <td><input type="text" id= "car_plate" name="car_plate" placeholder="0000XXX" value=""/></td>
                <td><font color="red">
                    <span id="error_car_plate" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Km: </td>
                <td><input type="text" id="km" name="km" placeholder="000000" value=""/></td>
                <td><font color="red">
                    <span id="error_km" class="error"></span>
                </font></font></td>
            </tr> 

            <tr>
                <td class="form_table_label">Type: </td>
                <td>
                    <input type="radio" id="type" name="type" placeholder="type" value="GS"/>Gasoline
                    <input type="radio" id="type" name="type" placeholder="type" value="DS"/>Diesel
                    <input type="radio" id="type" name="type" placeholder="type" value="ET"/>Electric
                    <input type="radio" id="type" name="type" placeholder="type" value="HB"/>Hybrid
                </td>
                <td><font color="red">
                    <span id="error_type" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Comments: </td>
                <td><textarea cols="30" rows="5" id="comments" name="comments" placeholder="comments" value=""></textarea></td>
                <td><font color="red">
                    <span id="error_comments" class="error">
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Discharge date: </td>
                <td><input id="fecha" type="text" name="discharge_date" placeholder="dd/mm/yyyy" value=""/></td>
                <td><font color="red">
                    <span id="error_discharge_date" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">Color: </td>
                <td><input type="text" id="color" name="color" placeholder="Red" value=""/></td>
                <td><font color="red">
                    <span id="error_color" class="error"></span>
                </font></font></td>
            </tr>
            
            <tr>
                <td class="form_table_label">Additional features: </td>
                <td><input type="checkbox" id= "extra[]" name="extra[]" placeholder= "extra" value="Camara trasera"/>Rear camera
                    <input type="checkbox" id= "extra[]" name="extra[]" placeholder= "extra" value="Modo crucero"/>Cruise control
                    <input type="checkbox" id= "extra[]" name="extra[]" placeholder= "extra" value="Navegador"/>Browser
                    <input type="checkbox" id= "extra[]" name="extra[]" placeholder= "extra" value="Cargador inalambrico"/>Wireless charger</td>
                <td><font color="red">
                    <span id="error_extra" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <!-- <td><input type="submit" name="create" id="create"/></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="validate('create')" value="Send"/></td>
                <td align="right"><br><a class="Button_green_2" href="index.php?module=cars&op=list">Back</a></td>
            </tr>
        </table>
    </form>
</div>