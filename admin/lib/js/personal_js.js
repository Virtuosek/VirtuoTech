/* index.php : cookies */
window.cookieconsent_options = {
    "message":"En poursuivant votre navigation sur notre site, vos acceptez l'installation et l'utilisation de cookies sur votre poste, \n\
               notamment à des fins promotionnelles et/ou publicitaires, dans le respect de notre politique de protection de votre vie privee.",
    "dismiss":"D'accord !",
    "learnMore":"Plus d'info",
    "link":null,
    "theme":"dark-bottom"
};
/**/

/* Toutes les pages : */
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
/**/
 
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
/**/

/* articles.php */
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
/**/

/* clients_admin.php*/

/*$('.refreshAlert').click(function() {
   $('.alert').hide();
});*/

document.getElementById("refreshAlert").onClick=function(){
    this.style.display="none";
}

$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        var code = e.keyCode || e.which;
        if (code == '9') return;
        
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        $table.find('tbody .no-result').remove();
        
        $rows.show();
        $filteredRows.hide();
        
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">Aucun résultat</td></tr>'));
        }
    });
});

jQuery(document).ready(function(){

    jQuery("#register").submit(function(){

            if (jQuery("#nom").val() == "") {
                    alert("Merci de saisir votre nom");
                    jQuery("#nom").focus();
                    return false;
            }
            if (jQuery("#prenom").val() == "") {
                    alert("Merci de saisir votre prenom");
                    jQuery("#prenom").focus();
                    return false;
            }
            if (jQuery("#email").val() == "" || valideEmail(jQuery("#email").val()) ) {
                    alert("Merci de saisir votre adresse email correcte");
                    jQuery("#email").focus();
                    return false;
            }
            if (jQuery("#pseudo").val() == "" || valideEmail(jQuery("#pseudo").val()) ) {
                    alert("Veuillez saisir votre pseudo");
                    jQuery("#email").focus();
                    return false;
            }
            if (jQuery("#password").val() == "") {
                    alert("Merci de saisir votre mot de passe");
                    jQuery("#password").focus();
                    return false;
            }
            if ($('#password').val()!=$('#vpassword').val()) {
                    alert("Merci de saisir la vérification de votre mot de passe");
                    jQuery("#vpassword").focus();
                    return false;
            }

    });

    function valideEmail(Email){
            var filtre = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            var valid = filtre.test(Email);

            if (!valid) {
                    return true;
            }
            return false;
    }
	
});
