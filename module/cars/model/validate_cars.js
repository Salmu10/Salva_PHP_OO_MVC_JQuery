function validate_license_number(texto) {
    if (texto.length > 0){
        var reg = /^[0-9A-Z]{17}$/;

        return reg.test(texto);
    }
    return false;
}

function validate_brand(texto) {
    if (texto.length > 0){
        var reg = /[A-Za-zñ'\\s]/;

        return reg.test(texto);
    }
    return false;
}

function validate_model(texto) {
    if (texto.length > 0){
        var reg = /[A-Za-z0-9]/;
        return reg.test(texto);
    }
    return false;
}

function validate_car_plate(texto) {
    if (texto.length > 0){
        var reg = /^([0-9]{4})([A-Z]{3})$/;
        return reg.test(texto);
    }
    return false;
}

function validate_km(texto) {
    if (texto.length > 0){
        var reg = /[0-9]/;
        return reg.test(texto);
    }
    return false;
}

function validate_type(texto) {
    var i;
    var ok = 0;
    for(i = 0; i < texto.length; i++){
        if(texto[i].checked){
            ok = 1;
        }
    }
    if(ok == 1){
        return true;
    }
    if(ok == 0){
        return false;
    }
}

function validate_comments(texto) {
    if (texto.length > 0){
        var reg = /[A-Za-zñ'\\s]/;

        return reg.test(texto);
    }
    return false;
}

function validate_fecha(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

function validate_color(texto) {
    if (texto.length > 0){
        var reg = /[A-Za-zñ'\\s]/;

        return reg.test(texto);
    }
    return false;
}

function validate_extra(array) {
    var i;
    var ok = 0;
    for(i = 0; i < array.length; i++){
        if(array[i].checked){
            ok = 1;
        }
    }
    if(ok == 1){
        return true;
    }
    if(ok == 0){
        return false;
    }
}

function validate(op){

    var check = true;
    
    var v_license_number = document.getElementById('license_number').value;
    var v_brand = document.getElementById('brand').value;
    var v_model = document.getElementById('model').value;
    var v_car_plate = document.getElementById('car_plate').value;
    var v_km = document.getElementById('km').value;
    var v_type = document.getElementsByName('type');
    var v_comments = document.getElementById('comments').value;
    var v_discharge_date = document.getElementById('fecha').value;
    var v_color = document.getElementById('color').value;
    var v_extra = document.getElementsByName('extra[]');
    
    var r_license_number = validate_license_number(v_license_number);
    var r_brand = validate_brand(v_brand);
    var r_model = validate_model (v_model);
    var r_car_plate = validate_car_plate(v_car_plate);
    var r_km = validate_km(v_km);
    var r_type = validate_type(v_type);
    var r_comments = validate_comments(v_comments);
    var r_discharge_date = validate_fecha(v_discharge_date);
    var r_color = validate_color(v_color);
    var r_extra = validate_extra(v_extra);

    
    if(!r_license_number){
        document.getElementById('error_license_number').innerHTML = " * El número de bastidor introducido no es válido";
        check=false;
    }else{
        document.getElementById('error_license_number').innerHTML = "";
    }
    if(!r_brand){
        document.getElementById('error_brand').innerHTML = " * La brand introducida no es válida";
        check=false;
    }else{
        document.getElementById('error_brand').innerHTML = "";
    }
    if(!r_model){
        document.getElementById('error_model').innerHTML = " * El model introducido no es válido";
        check=false;
    }else{
        document.getElementById('error_model').innerHTML = "";
    }
    if(!r_car_plate){
        document.getElementById('error_car_plate').innerHTML = " * La matrícula introducida no es válida";
        check=false;
    }else{
        document.getElementById('error_car_plate').innerHTML = "";
    }
    if(!r_km){
        document.getElementById('error_km').innerHTML = " * Los kilómetros introducidos no son válidos";
        check = false;
    }else{
        document.getElementById('error_km').innerHTML = "";
    }
    if(!r_type){
        document.getElementById('error_type').innerHTML = " * No has seleccionado ningún type de vehículo";
        check=false;
    }else{
        document.getElementById('error_type').innerHTML = "";
    }

    if(!r_comments){
        document.getElementById('error_comments').innerHTML = " * No has rellenado el campo de comments";
        check=false;
    }else{
        document.getElementById('error_comments').innerHTML = "";
    }

    if(!r_discharge_date){
        document.getElementById('error_discharge_date').innerHTML = " * No has introducido ninguna fecha";
        check=false;
    }else{
        document.getElementById('error_discharge_date').innerHTML = "";
    }

    if(!r_color){
        document.getElementById('error_color').innerHTML = " * No has rellenado el campo de color";
        check=false;
    }else{
        document.getElementById('error_color').innerHTML = "";
    }

    if(!r_extra){
        document.getElementById('error_extra').innerHTML = " * Debes seleccionar almenos uno de los extra";
        check=false;
    }else{
        document.getElementById('error_extra').innerHTML = "";
    }

    // return check;

    if (check){
        if (op == 'create'){
            document.alta_car.submit();
            document.alta_car.action = "index.php?module=cars&op=create";
        }
        if (op == 'update'){
            document.update_car.submit();
            document.update_car.action = "index.php?module=cars&op=update";
        }
    }
}

function showModal(title_Car, id) {
    $("#details_car").show();
    $("#car_modal").dialog({
        title: title_Car,
        width : 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons : {
            Update: function() {
                        window.location.href = 'index.php?module=cars&op=update&id=' + id;
                    },
            Delete: function() {
                        window.location.href = 'index.php?module=cars&op=delete&id=' + id;
                    }
        }
    });
}

function loadContentModal() {
    
    $('#table_crud').DataTable();

    $('.id').click(function () {
        var id = this.getAttribute('id');
        ajaxPromise('module/cars/controller/controller_cars.php?op=read_modal&id=' + id, 'GET', 'JSON')
        .then(function(data) {
            // var data = JSON.parse(data);
            $('<div></div>').attr('id', 'details_car', 'type', 'hidden').appendTo('#car_modal');
            $('<div></div>').attr('id', 'container').appendTo('#details_car');
            $('#container').empty();
            $('<div></div>').attr('id', 'car_content').appendTo('#container');
            $('#car_content').html(function() {
                var content = "";
                for (row in data) {
                    content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
                }// end_for
                //////
                return content;
                });
                //////
                // showModal(data.id);
                showModal(title_car = data.brand + " " + data.model, data.id);
        })
        .catch(function() {
            window.location.href = 'index.php?module=errors&op=503&desc=List error';
        });
    });
 }

 $(document).ready(function() {
    loadContentModal();
});