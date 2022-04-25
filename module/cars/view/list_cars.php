<div id="main-wrapper">
    <div class="container">
    	<div class="row">
    			<h1 class=titulo data-tr="List"></h1>
    	</div>
        <br>
        <br>
    	<div class="row">
            <table>
            <br>
            <br>
                <tr>
                    <th width=800><h2 data-tr="Add"></h2></th>
                    <th width=700><h2 data-tr="Dummies"></h2></th>
                </tr>
                <tr>
                    <th><p><a href="index.php?module=cars&op=create"><img src="view/images/anadir.png"></a></p></th>
                    <th><p><a href="index.php?module=cars&op=dummies"><img src="view/images/anadir.png"></a></p></th>
                </tr>
            </table>
            <br>
            <table id="table_crud">
                <thead>
                    <tr>
                        <!-- <td width=40><b>Id</b></th> -->
                        <td width=250 align="center"><h3 data-tr="License">License number</h3></td>
                        <td width=250 align="center"><h3 data-tr="Brand">Brand</h3></td>
                        <td width=250 align="center"><h3 data-tr="Model">Model</h3></td>
                        <td width=250 align="center"><h3 data-tr="Car plate">Car plate</h3></td>
                        <td width=250 align="center"><h3 data-tr="Type">Type</h3></td>
                        <td width=250 align="center"><h3 data-tr="Discharge date">Discharge date</h3></td>
                        <td width=600 align="center"><h3 data-tr="Action">Action</h3></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows === 0){
                            echo '<tr>';
                            echo '<td align="left" colspan="3">The cars list is void</td>';
                            echo '</tr>';
                        }else{
                            foreach ($result as $row) {
                                echo '<tr>';
                                // echo '<td width=60>'. $row['id'] . '</td>';
                                echo '<td width=250 align="center">'. $row['license_number'] . '</td>';
                                echo '<td width=250 align="center">'. $row['brand'] . '</td>';
                                echo '<td width=250 align="center">'. $row['model'] . '</td>';
                                echo '<td width=250 align="center">'. $row['car_plate'] . '</td>';
                                echo '<td width=250 align="center">'. $row['type'] . '</td>';
                                echo '<td width=250 align="center">'. $row['discharge_date'] . '</td>';
                                echo '<td class="action" width=600 align="center">';

                                print ("<div class='id' id='".$row['id']."'><a class='Button_blue' data-tr='Read'></a></div>");  //READ

                                // echo '<a class="Button_blue" href="index.php?module=cars&op=read&id='.$row['id'].'" data-tr="Read"></a>';
                        
                                echo '&nbsp;';
                                echo '<a class="Button_green" href="index.php?module=cars&op=update&id='.$row['id'].'" data-tr="Update"></a>';
                                echo '<a class="Trash" href="index.php?module=cars&op=delete&id='.$row['id'].'"><img src="view/images/Papelera.png"></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>         
            </table>
            <br>
            <br>
            <table>
                <tr>
                    <th width=1500><h2 data-tr="Delete all">Delete All</h2></th>
                </tr>
                <tr>
                    <th><p><a href="index.php?module=cars&op=delete_all"><img src="view/images/Papelera.png"></a></p></th>
                </tr>
            </table>
    	</div>
    </div>
</div>

<!-- modal window -->
<section id="car_modal">
    <div id="details_car" hidden>
        <div id="details">
            <div id="container">
            </div>
        </div>
    </div>
</section>