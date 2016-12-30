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