<div id="contenido">
    <form autocomplete="on" method="post" name="delete_all_cars" id="delete_all_cars" action="index.php?module=cars&op=delete_all">
        <table border='0'>
            <tr>
            <th width=1500><h3>Do you want to delete the whole list of cars?</h3></th>
            </tr>
        </table>
        <table border='0'>
            <tr>
                <td width=680 align="right"><button type="submit" class="Button_green" name="delete_all_cars" id="delete_all_cars">Accept</button></td>
                <td><a class="Button_red" href="index.php?module=cars&op=list">Cancel</a></td>
            </tr>
        </table>
        <br>
        <br>
    </form>
</div>