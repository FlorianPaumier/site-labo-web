$(document).ready(function () {
    "use strict"; // Start of use strict
    $('.btnSubmitSondage').click(function () {
       const sondage = $(this).data('id');

       const input = $('input[name="sondage'+sondage+'-answer"]:checked').data('id');

       if(input != 'undefinied'){
           fetch('/sondage/'+sondage+'/answer', {
               method: 'POST',
               headers: {
                   'Content-Type': 'application/json'
                   // 'Content-Type': 'application/x-www-form-urlencoded',
               },
               body : JSON.stringify({
                   theme : input
               })
           })
           .then(function (response) {
               return response.json();
           })
           .then(function (responde) {
               $('#sondage'+sondage).fadeOut();
           }).error(function (error) {
               console.log(error);
               alert("Une erreur est survenue, désolé du dérangement");
           });
       }
    });

});