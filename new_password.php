<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    <title>Prefeitura de Maricá</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
	<script
  		src="https://code.jquery.com/jquery-3.4.1.min.js"
  		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous">
	</script>
</head>

<body>
    <div class="container">
        <!-- Codrops top bar -->
        <div class="codrops-top">
            <a href="">
                <strong>&laquo; Previous Demo: </strong>Responsive Content Navigator
            </a>
            <span class="right">
                    <a href=" http://tympanus.net/codrops/2012/03/27/login-and-registration-form-with-html5-and-css3/">
                        <strong>Back to the Codrops Article</strong>
                    </a>
                </span>
            <div class="clr"></div>
        </div>
        <!--/ Codrops top bar -->
        <header>
            <h1>Login and Registration Form <span>with HTML5 and CSS3</span></h1>
        </header>
        <section>
            <div id="container_demo">
                <div id="wrapper">
                    <form  id="new_pass_form" method="POST" autocomplete="on">
                        <?php include('errors.php'); ?>
                            <h1> Password Recovery </h1>
                        <p>
                            <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                            <input id="passwordsignup" name="passwordsignup" type="password" placeholder="eg. X8df!90EO" />
                        </p>
                        <div style="display: none" id="password_cadastro_vazia">
                            <span style="color: red;">A senha deve possuir pelo menos 5 caracteres</span>
                        </div>
                        <p>
                            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                            <input id="passwordsignup_confirm" name="passwordsignup_confirm" type="password" placeholder="eg. X8df!90EO" />
                        </p>
                        <div style="display: none" id="password_confirm_cadastro_vazia">
                            <span style="color: red;">Preencha a senha</span>
                        </div>
                        <p class="signin button">
                            <input type="submit" value="Send" />
                            <div style="display: none" id="senhas_diferentes">
                                <span style="color: red;">As senhas informadas não correspondem</span>
                            </div>
                        </p>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

<script>
    $(document).ready(function(){
		$('#login-form').submit(function(event){
			
            $('#password_cadastro_vazia').hide();
            $('#password_confirm_cadastro_vazia').hide();
            $('#senhas_diferentes').hide();			
            
            var oCadastrar = {
                password_cadastro: $('#passwordsignup').val(),
                password_confirmacao_cadastro: $('#passwordsignup_confirm').val(),
            }
            
            if (oCadastrar.password_cadastro.length < 5 || oCadastrar.password_cadastro == "" || oCadastrar.password_confirmacao_cadastro == "" || oCadastrar.password_cadastro != oCadastrar.password_confirmacao_cadastro) {
                if (oCadastrar.password_cadastro.length < 5) {
                    $('#password_cadastro_vazia').show();
                    $('#passwordsignup').focus();
                }
                if (oCadastrar.password_confirmacao_cadastro.length < 5) {
                    $('#password_confirm_cadastro_vazia').show();
                    if (oCadastrar.password_cadastro != "") {
                        $('#passwordsignup_confirm').focus();
                    }
                }
                if (oCadastrar.password_cadastro != "" && oCadastrar.password_confirmacao_cadastro != "" && oCadastrar.password_cadastro != oCadastrar.password_confirmacao_cadastro) {
                    $('#senhas_diferentes').show();
                }
            } else {
                $.ajax({
                        url: 'email_verification_RP.php',
                        type: 'post',
                        dataType: 'json',
                        data: oCadastrar,
                    })
                    .done(function(s) {
                        if (s == 1) {
                            window.location.href = "index.php";
                        }
                        if (s == 0) {
                            alert("Não foi possível alterar a senha")
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
</script>