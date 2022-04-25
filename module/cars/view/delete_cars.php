<div id="contenido">
    <form autocomplete="on" method="post" name="delete_cars" id="delete_cars" action="index.php?module=cars&op=delete&id=<?php echo $_GET['id']; ?>">
        <table border='0'>
            <tr>
                <th width=1200><h3>Do you want to delete the car <?php echo $car['car_plate'];?>?</h3></th>
            </tr>
        </table>
        <table border='0'>
            <tr>
                <td width=580 align="right"><button type="submit" class="Button_green" name="delete" id="delete">Accept</button></td>
                <td><a class="Button_red" href="index.php?module=cars&op=list">Cancel</a></td>
            </tr>
        </table>
        <br>
        <br>
    </form>
</div>