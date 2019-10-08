
window.onscroll = function() {scrollFunction()};


function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

function showHideIcons() {
    jQuery("ul.hidden-social-icon").toggle('slow');
    jQuery(".hidden-social-btn").find(".fa").toggleClass('fa-angle-double-down').toggleClass("fa-angle-double-up");
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    // document.body.scrollTop = 0;
    $('html, body').animate({ scrollTop: 0} , "slow");
    
}
function menu() {
    var x = document.getElementById("nav-menu");
 var y = document.getElementById("nav")
    if ($("#nav-menu").hasClass("flex") && !($("#nav-menu").hasClass("responsive"))) {
        x.className += " responsive";
        y.className += " column";
        x.style.display = 'block';       
    } else {
        x.className = "flex";
        y.className = "flex";
        x.style.display = 'none';
    }
}

jQuery(document).ready(function(){
    jQuery(".switch").on("click", function () {
        var lang_set = jQuery(this).data('lang');
        document.cookie = 'lang='+lang_set;
        // cookieStorage.setItem('lang',lang_set);
        window.location.reload();
    });
});
