$(document).ready(function() {
    $('#form_register').submit(function(event) {

        var oCadastrar = {

            nome_cadastro: $('#usernamesignup').val(),
            email_cadastro: $('#emailsignup').val(),
            password_cadastro: $('#passwordsignup').val(),
            password_confirmacao_cadastro: $('#passwordsignup_confirm').val(),
            manter_logado: $('#keep_logged_in_register').val(),
        }

        $('#nome_cadastro_vazio').hide();
        $('#email_cadastro_vazio').hide();
        $('#email_ja_cadastrado').hide();
        $('#password_cadastro_vazia').hide();
        $('#password_confirm_cadastro_vazia').hide();
        $('#senhas_diferentes').hide();

        if (oCadastrar.nome_cadastro == '' || oCadastrar.email_cadastro == '' || oCadastrar.password_cadastro.length < 5 ||
            oCadastrar.password_cadastro == "" || oCadastrar.password_confirmacao_cadastro == "" || oCadastrar.password_cadastro !=
            oCadastrar.password_confirmacao_cadastro) {
            if (oCadastrar.nome_cadastro == "") {
                $('#nome_cadastro_vazio').show();
                $('#usernamesignup').focus();
            }
            if (oCadastrar.email_cadastro == "") {
                $('#email_cadastro_vazio').show();
                if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro == "") {
                    $('#emailsignup').focus();
                }
            }
            if (oCadastrar.password_cadastro.length < 5) {
                $('#password_cadastro_vazia').show();
                if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro != "" && oCadastrar.password_cadastro == "") {
                    $('#passwordsignup').focus();
                }
            }
            if (oCadastrar.password_confirmacao_cadastro.length < 5) {
                $('#password_confirm_cadastro_vazia').show();
                if (oCadastrar.nome_cadastro != "" && oCadastrar.email_cadastro != "" && (oCadastrar.password_cadastro != "" || oCadastrar.password_cadastro.length >= 5) && oCadastrar.password_confirmacao_cadastro == "") {
                    $('#passwordsignup_confirm').focus();
                }
            }
            if (oCadastrar.password_cadastro != "" && oCadastrar.password_confirmacao_cadastro != "" && oCadastrar.password_cadastro != oCadastrar.password_confirmacao_cadastro) {
                $('#senhas_diferentes').show();
            }
        } else {
            $.ajax({
                    url: 'register.php',
                    type: 'post',
                    dataType: 'json',
                    data: oCadastrar,
                })
                .done(function(s) {
                    if (s == 1) {
                        window.location.href = "index.php";
                    }
                    if (s == 0) {
                        $('#email_ja_cadastrado').show();
                    }
                })
                .fail(function(e) {
                    alert("Os dados não foram enviados");
                })
                .always(function(c) {

                    // console.log(c);
                });
        }
        event.preventDefault();
    });
});