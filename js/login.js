$(document).ready(function() {

    $('#form_login').submit(function(event) {

        $('#email_vazio').hide();
        $('#senha_vazia').hide();
        $('#senha_errada').hide();

        $('#senha_errada').hide();
        $('#senha_errada').hide();
        $('#senha_errada').hide();

        // var user = $('input[name=user]').val();
        var oEnviar = {
            email: $('#email').val(),
            password: $('#password').val(),
            //keep_logged_in : $('#keep_logged_in').val()
        }
        if (oEnviar.email == "" || oEnviar.password == "") {
            if (oEnviar.email == "" && oEnviar.password == "") {
                $('#email_vazio').show();
                $('#senha_vazia').show();
                $('#email').focus();
            } else if (oEnviar.email == "") {
                $('#email_vazio').show();
                $('#email').focus();
            } else if (oEnviar.password == "") {
                $('#senha_vazia').show();
                $('#password').focus();
            }
        } else {
            $.ajax({
                    url: 'login.php',
                    type: 'post',
                    dataType: 'json',
                    data: oEnviar,
                })
                .done(function(s) {

                    if (s == 1) {
                        window.location.href = "teste.html";
                    } else if (s == 0) {
                        $('#senha_errada').show();
                    }

                })
                .fail(function(e) {

                    alert('Deu errado.')

                })
                .always(function(c) {

                    // console.log(c);
                });
        }
        event.preventDefault();
    });
});