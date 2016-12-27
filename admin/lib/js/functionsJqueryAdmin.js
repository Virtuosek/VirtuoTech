$(document).ready(function(){
    
   $("#email2").blur(function(){
        email1 = $("#email1").val();
        email2 = $("#email2").val();
        //alert(email1+" "+email2);
        if($.trim(email1)!='' && $.trim(email2)!='' && email1===email2){
            recherche = "email="+email1;
            $.ajax({
                type: 'GET',
                data: recherche,
                dataType: "json",
                url: './admin/lib/php/ajax/AjaxRechercheClient.php',
                success: function(data){ //data = ce qui revient du script PHP
                    $("#nom").val(data[0].nom_client);
                    $("#prenom").val(data[0].prenom_client);
                    $("#telephone").val(data[0].telephone);
                    $("#adresse").val(data[0].adresse_client);
                    $("#numero").val(data[0].numero);
                    $("#localite").val(data[0].localite);
                    $("#codepostal").val(data[0].codepostal);
                    console.log(data[0].nom_client);
                }
            });
        }
   });
   
});