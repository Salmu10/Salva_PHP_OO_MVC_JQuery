<?php

	if ((isset($_GET['module'])) && ($_GET['module']==="home") ){
		include("view/inc/top_page_home.html");
	}else if ((isset($_GET['module'])) && ($_GET['module']==="cars") ){
		include("view/inc/top_page_cars.html");
	}else if ((isset($_GET['module'])) && ($_GET['module']==="shop") ){
		include("view/inc/top_page_shop.html");
	}else if ((isset($_GET['module'])) && ($_GET['module']==="login") ){
		include("view/inc/top_page_login.html");
	}else{
		include("view/inc/top_page.html");
	}
	session_start();
?>

<div>
	<div id="contenedor_carga">
		<div class="spinner"></div>
	</div>
	
    <div id="header">    	
    	<?php
    	    include_once("view/inc/header.html");
    	?>        
    </div>  
    <div id="page_container">
    	<?php 
		    include_once("view/inc/pages.php"); 
		?>        
        <br style="clear:both;"/>
    </div>
    <div id="footer-wrapper">   	   
	    <?php
	        include_once("view/inc/footer.html");
	    ?>        
    </div>

	<script>
		window.onload = function(){
			var contenedor = document.getElementById('contenedor_carga');

			contenedor.style.visibility = "hidden";
			contenedor.style.opacity = '0';
		}
	</script>

</div>

    