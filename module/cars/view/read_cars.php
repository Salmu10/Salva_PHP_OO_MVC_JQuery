<div id="contenido">
    <h1>Información del Coche</h1>
    <p>
    <form name="form1" method="post">
		<table border="0">
		<tr> 
				<td>License number: </td>
				<td><input type="text" name="license_number" value="<?php echo $id['license_number'];?>" readonly></td>
			</tr>
			<tr> 
				<td>Brand: </td>
				<td><input type="text" name="brand" value="<?php echo $id['brand'];?>" readonly></td>
			</tr>
			<tr> 
				<td>Model: </td>
				<td><input type="text" name="model" value="<?php echo $id['model'];?>" readonly></td>
			</tr>
			<tr> 
				<td>Car plate: </td>
				<td><input type="text" name="car_plate" value="<?php echo $id['car_plate'];?>" readonly></td>
			</tr>
			<tr> 
				<td>Km: </td>
				<td><input type="text" name="km" value="<?php echo $id['km'];?>" readonly></td>
			</tr>
            <tr>
                <td>Type: </td>
                <td>
                    <?php
                        // $data = 'hola crtl user create';
                        // die('<script>console.log('.json_encode( $id['tipo'] ) .');</script>');

                        if ($id['type']==="Gasolina"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Gasolina" readonly checked/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="Diesel" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="Electrico" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="Hibrido" readonly/>Hybrid
                    <?php    
                        } else if ($id['type']==="Diesel"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Gasolina" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="Diesel" readonly checked/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="Electrico" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="Hibrido" readonly/>Hybrid
                    <?php
                        } else if ($id['type']==="Electrico"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Gasolina" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="Diesel" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="Electrico" readonly checked/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="Hibrido" readonly/>Hybrid
                    <?php   
                        } else if ($id['type']==="Hibrido") {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="Gasolina" readonly/>Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="Diesel" readonly/>Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="Electrico" readonly/>Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="Hibrido" readonly checked/>Hybrid
                    <?php   
                        }
                    ?>       
                </td>
			</tr>

            <tr>
                <td>Comments: </td>
                <td><textarea cols="30" rows="5" id="comments" name="comments" placeholder="comments" readonly><?php echo $id['comments'];?></textarea></td>
                <td><font color="red">
                    <span id="error_comments" class="error">
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td>Discharge date: </td>
                <td><input id="fecha" type="text" name="discharge_date" placeholder="dd/mm/yyyy" value="<?php echo $id['discharge_date'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_discharge_date" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td>Colour: </td>
                <td><input type="text" id="color" name="color" placeholder="Red" value="<?php echo $id['color'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_color" class="error"></span>
                </font></font></td>
            </tr>

            <td width="150">Additional features: </td>
                <?php
                    $afi=explode(":", $id['extra']);
                ?>
                <td>
                    <?php
                        $busca_array = in_array("Camara trasera", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Camara trasera" readonly checked/>Rear camera
                    <?php
                        } else{
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Camara trasera" readonly/>Rear camera
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Modo crucero", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Modo crucero" readonly checked/>Cruise control
                    <?php
                        }else{
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Modo crucero" readonly/>Cruise control
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Navegador", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Navegador" readonly checked/>Browser
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extra[]" name="extra[]" value="Navegador" readonly/>Browser
                    <?php
                        }
                    ?>
                    <?php
                        $busca_array = in_array("Cargador inalambrico", $afi);
                        if($busca_array){
                    ?>
                        <input type="checkbox" id= "extra[]" name="extra[]" value="Cargador inalambrico" readonly checked/>Wireless charger</td>
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extra[]" name="extra[]" value="Cargador inalambrico" readonly/>Wireless charger</td>
                    <?php
                        }
                    ?>
                </td>
                <td><font color="red">
                    <span id="error_extra" class="error"></span>
                </font></font></td>
            </tr>

			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
			</tr>
		</table>
	</form>
    </p>
    <p><br><a class="Button_green" href="index.php?module=cars&op=list">Back</a></p>
</div>