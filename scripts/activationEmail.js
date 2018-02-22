function sendEmailActivation(acc_id) {
    $('#loadEmail99').show();
    $("#loadingEmail").css("display", "");
    $.get(DEFAULT_URL + "/sponsors/activationEmail.php", {
        acc_id: acc_id
    }, function (response) {
        $("#loadingEmail").css("display", "none");
        if (response.trim() == "ok") {
            $('#loadEmail99').hide();
            $("#messageEmail").css("display", "");
            $("#messageEmailError").css("display", "none");
            $('.content-custom.alert.alert-danger').removeClass('alert-danger').addClass('alert-success').html('Activation link sent successfully. Please check your email');
        } else {
            $('#loadEmail99').hide();
            $("#messageEmail").css("display", "none");
            $("#messageEmailError").html(response);
            $("#messageEmailError").css("display", "");
        }
    });
}