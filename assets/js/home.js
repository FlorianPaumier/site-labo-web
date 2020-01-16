$(document).ready(function() {
    $(".card-association").click(function() {
        let id = $(this).data("id");
        window.location = "/association/"+id;
    });
});