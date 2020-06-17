<?php
    include('errors.php');
    require_once('PHPMailer-FE_v4.11/_lib/class.phpmailer.php');

    define('HOST','localhost');
    define('USERNAME','marcosennes');
    define('PASSWORD', "");
    define('DATABASE', 'cadastro');

    $database = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die('não foi possivel conectar');
    
    session_start();

    $errors = array();
    $user_id = "";
    $email = "";

    if (isset($_POST['email'])) {
        
        $email = $_POST['email'];
        $query = "SELECT email FROM register WHERE email='$email'";
        $results = mysqli_query($database, $query);
      
        if (empty($email)) {
            array_push($errors, "Your email is required");
            $retorno = 2;

        }else if(mysqli_num_rows($results) == 0) {
            array_push($errors, "Sorry, no user exists on our system with that email");
            $retorno = 0;
        }
        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(50));
      
        if (count($errors) == 0) {
            // store token in the password-reset database table against the user's email


            $sql = "INSERT INTO password_recovery(email, token) VALUES ('$email', '$token')";
            $results = mysqli_query($database, $sql);        

            $mailer = new PHPMailer();
            $mailer->IsSMTP();
            $mailer-> CharSet = 'UTF-8';
            $mailer->SMTPDebug = 1;
            $mailer->Port = 587; //Indica a porta de conexão 
            $mailer->Host = 'smtp.gmail.com';//Endereço do Host do SMTP 
            $mailer->SMTPAuth = true; //define se haverá ou não autenticação 
            $mailer->Username = 'testemarcosennes@gmail.com'; //Login de autenticação do SMTP
            $mailer->Password = '123456marcos'; //Senha de autenticação do SMTP
            $mailer->FromName = 'Bart S. Caio Amaral'; //Nome que será exibido
            $mailer->setFrom = 'testemarcosennes@gmail.com'; //Obrigatório ser 
            //a mesma caixa postal configurada no remetente do SMTP
            $mailer->AddAddress($email,'Nome do destinatário'); //Destinatários
            $mailer->Subject = 'Teste enviado através do PHP Mailer SMTPLW';
            $mailer->Body = 'Este é um teste realizado com o PHP Mailer SMTPLW';
            
            if(!$mailer())
            {
                echo "Message was not sent";
                echo "Mailer Error: " . $mailer->ErrorInfo; exit; 
            }
                print "E-mail enviado!";
            
                
                $retorno = 1;
            
        }
    }

/*
    // ENTER A NEW PASSWORD
    if (isset($_POST['password_cadastro'])) {
        $new_pass = mysqli_real_escape_string($database, $_POST['password_cadastro']);
        $new_pass_c = mysqli_real_escape_string($database, $_POST['password_confirmacao_cadastro']);
    
        // Grab to token that came from the email link
        $token = $_SESSION['token'];
        if(empty($new_pass) || empty($new_pass_c) || $new_pass !== $new_pass_c){
            if (empty($new_pass) || empty($new_pass_c)) array_push($errors, "Password is required");
            if ($new_pass !== $new_pass_c) array_push($errors, "Password do not match");
            $retorno = 0;
        }
        
        if (count($errors) == 0) {
        
            // select email address of user from the password_reset table 
        $sql = "SELECT email FROM password_recovery WHERE token='$token' LIMIT 1";
        $results = mysqli_query($database, $sql);
        $email_rec = mysqli_fetch_assoc($results)['email'];
    
            if ($email_rec) {
                $new_pass = md5($new_pass);
                $sql = "UPDATE register SET password='$new_pass' WHERE email='$email_rec'";
                $results = mysqli_query($database, $sql);
                $retorno = 1;
            }
        }
    }
*/ 
    echo json_encode($retorno);
?>