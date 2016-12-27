/* index.php : cookies */
window.cookieconsent_options = {
    "message":"En poursuivant votre navigation sur notre site, vos acceptez l'installation et l'utilisation de cookies sur votre poste, \n\
               notamment à des fins promotionnelles et/ou publicitaires, dans le respect de notre politique de protection de votre vie privee.",
    "dismiss":"D'accord !",
    "learnMore":"Plus d'info",
    "link":null,
    "theme":"dark-bottom"
};

/* accueil.php*/
$(document).ready(function(){
     $(window).scroll(function () {
        if ($(this).scrollTop()> 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $('#back-to-top').tooltip('show');
});
 
 /* contact.php*/
$(document).ready(function() {
    var panels = $('.vote-results');
    var panelsButton = $('.dropdown-results');
    panels.hide();
    
    panelsButton.click(function() {
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            if(idFor.is(':visible'))
                currentButton.html('Hide Results');
            else
                currentButton.html('View Results');
        })
    });
});

/* articles.php */
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});

function init() { 
  document.getElementById("about").style.color = 'green';
}