/* AJAX PROMISE */

function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

/* LOAD MENU */

function load_menu() {   
    ajaxPromise('module/login/controller/controller_login.php?op=data_user', 'POST', 'JSON', {token: localStorage.getItem('token')})
    .then(function(data) {
        if (data.user_type === 'admin') {
            menu_admin();
        }else if (data.user_type === 'client') {
            menu_client();
        }
        click_profile(data);
    }).catch(function() {
        $('<li></li>').attr({'class' : 'nav_item'}).html('<a href="index.php?module=login&op=login_view" class="nav_link" data-tr="Log in">Log in</a>').appendTo('.nav_list');
        $('<li></li>').attr({'class' : 'nav_item'}).html('<a href="index.php?module=errors&op=errors_log" class="nav_link" data-tr="Errors log">Errors log</a>').appendTo('.nav_list');
    });
}

/* MENUS */

function menu_admin() {
    $('<li></li>').attr({'class' : 'nav_item'}).html('<a href="index.php?page=controller_crud&op=list" class="nav_link">Crud</a>').appendTo('.nav_list');
    $('<li></li>').attr({'class' : 'nav_item'}).html('<a href="" id="logout" class="nav_link">Log out</a>').appendTo('.nav_list');
}

function menu_client() {
    // data_profile = data;
    $('<li></li>').attr('class', 'profile').attr('id', 'profile').html('<a id="profile" class="nav_link" data-tr="Profile">Profile</a>').appendTo('.nav_list');
    $('<li></li>').attr({'class' : 'nav_item'}).html('<a href="index.php?module=errors&op=errors_log" class="nav_link" data-tr="Errors log">Errors log</a>').appendTo('.nav_list');
}

/* CLICK PROFILE */

function click_profile(data) {
    $(document).on('click', '#profile', function() {
        $(".profile_options").remove();
        $('<div></div>').attr('class', 'profile_options').attr('id', 'profile_options').appendTo('.nav_list_profile')
        .html(
            "<ul class='profile_list' id='profile_list'>" +
                "<li><div class='user'>" +
                "<div class='user_img'><img class='avatar_img' src='" + data.avatar + "'></div>" + 
                "<div class='user_name'>" + data.username + "</div></li>" +
                "<li><div id='logout' class='logout' data-tr='Log out'>Log out</div></li>" +
            "</ul>"
        )
    });
    $(document).on('click scroll', function(event) {
        if (event.target.id !== 'profile') {
            $('.profile_options').fadeOut(500);
        }
    });
}


/* CLICK LOGOUT */

function click_logout() {
    $(document).on('click', '#logout', function() {
        logout();
        setTimeout('window.location.href = "index.php?module=home&op=home";', 1000);
    });
}

/* LOGOUT */

function logout() {
    $.ajax({
        url: 'module/login/controller/controller_login.php?op=logout',
        type: 'POST',
        dataType: 'JSON'
    }).done(function(data) {
        localStorage.removeItem('token');
        window.location.href = "index.php?module=home&op=home";
        console.log("Sesion cerrada");
    }).fail(function() {
        window.location.href = 'index.php?module=errors&op=503&desc=Logout error';
    });
}

$(document).ready(function() {
    load_menu();
    click_logout();
});