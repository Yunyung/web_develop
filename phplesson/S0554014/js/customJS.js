$(function() {
    /* language Switcher */
    $("#chn-button").attr("disabled", true);
    $('.eng').toggle();

    $("#chn-button").click(function() {
        $('.eng').toggle();
        $('.chn').toggle();

        $("#chn-button").attr("disabled", true);
        $("#eng-button").attr("disabled", false);
    });

    $("#eng-button").click(function() {
        $('.chn').toggle();
        $('.eng').toggle();

        $("#eng-button").attr("disabled", true);
        $("#chn-button").attr("disabled", false);
    });


    /* Declaration-of-Consent */
    $("#Form-Declaration-Consent").submit(function() {
        if (!$("#chkbox-Agreement").is(":checked")) {
            alert("請詳閱同意書，瞭解並同意後才可進行下一步!!");
            return false;
        };
    });

    
});