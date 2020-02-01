$(document).ready(function() {
    // MASK UANG
    $(".uang").mask("0.000.000.000", { reverse: true });
    // MASK NO TELP
    $(".telp").mask("0000-0000-00000");

    // TOOLTIPS
    $("[data-toggle=tooltip]").tooltip();

    //INPUT GAMBAR FIX LABEL
    $(".custom-file-input").on("change", function() {
        let filename = $(this)
            .val()
            .split("\\")
            .pop();
        $(this)
            .next(".custom-file-label")
            .addClass("selected")
            .html(filename);
    });

    // SHOWHIDEPASS
    $("#showhidepass a").on("click", function(event) {
        event.preventDefault();
        if ($("#showhidepass input").attr("type") == "text") {
            $("#showhidepass input").attr("type", "Password");
            $("#showhidepass i").addClass("fa-eye");
            $("#showhidepass i").removeClass("fa-eye-slash");
        } else if ($("#showhidepass input").attr("type") == "Password") {
            $("#showhidepass input").attr("type", "text");
            $("#showhidepass i").removeClass("fa-eye");
            $("#showhidepass i").addClass("fa-eye-slash");
        }
    });

    //DATA TABLES
    $("#tolong").DataTable();
});
