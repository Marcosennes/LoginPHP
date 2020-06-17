<?php include('app_logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset PHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
    <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
    <meta name="author" content="Codrops" />
	<link rel="stylesheet" href="main.css">
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
                <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <form id="enter_email_form" method="POST" autocomplete="on">
                            <?php include('errors.php'); ?>
                            <h1>Password Recovery</h1>
                            <p>
                                <label for="email" class="uname" data-icon="u"> Your email</label>
                                <input id="email" type="email" placeholder="mymail@mail.com" />
                                <div style="display: none" id="email_recuperacao">
                                    <span style="color: red;">Preencha o E-mail</span>
                                </div>
                            </p>
                            <p class="login button">
                            <button type="submit" class="btn">Send</button>                            
                            </p>
                            <div  style="display: none" id="email_nao_corresponde">
                                    <span style="color: red;">Email não está registrado no sistema.</span>
                            </div>
                            <div  style="display: none" id="email_corresponde">
                                    <span style="color: green;">Email Enviado</span>
                            </div>
                        </form>
					</div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

<script>
	$(document).ready(function(){
		$('#enter_email_form').submit(function(event){
			
		$('#email_corresponde').hide();
		$('#email_nao_corresponde').hide();
		$('#email_recuperacao').hide();
		
		var oEnviar = {
				email: $('#email').val(),
			}
			if (oEnviar.email == "") {
                $('#email_recuperacao').show();
                $('#email').focus();
            } else{
				$.ajax({
                    url: 'email_verification_RP.php',
                    type: 'post',
                    dataType: 'json',
                    data: oEnviar,
                })
                .done(function(s) {

                    if (s == 1) {
						$('#email_corresponde').show();
                    } else if (s == 0) {
						$('#email_nao_corresponde').show();
                    } else if(s == 2){
						alert("Email não está preenchido");
					}

                })
                .fail(function(e) {
                    
                    alert('Deu errado.')

                })
                .always(function(c) {
                });
			}
		event.preventDefault();
		});
	});
</script>