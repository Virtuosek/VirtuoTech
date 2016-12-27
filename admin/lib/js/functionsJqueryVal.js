$(document).ready(function(){

    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");
    
    
    $("#form_commande").validate({
        rules: {
            email: "required",
            nom: "required",
            prenom: "required",
            submitHandler: function(form) {
                form.submit();
            }
        }
    });
    
});
