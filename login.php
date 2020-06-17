<?php
    define('HOST','localhost');
    define('USERNAME','marcosennes');
    define('PASSWORD', "");
    define('DATABASE', 'cadastro');
    $database = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die('não foi possivel conectar');
    
    session_start();

    $email = "";
    $keep_logged_in = 0;
    $errors = array();


    if (isset($_POST['email']) && isset($_POST['password'])) {
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$keep_logged_in = $_POST['loginkeeping'];
    
        if (empty($email)) {
            array_push($errors, "Email is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        
        if($keep_logged_in != 1){
            $keep_logged_in = 0;
        }
        if (count($errors) == 0) {

            $password_codificada = md5($password);
            $query = "SELECT * FROM register WHERE email='$email' AND password='$password_codificada'";
            $results = mysqli_query($database, $query);

            if (mysqli_num_rows($results) == 1) {

                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                
                $retorno = 1;

            }else {

                session_destroy();
                array_push($errors, "Combinação de email e password errada");

                $retorno = 0;
            }
        }
    }
    
    echo json_encode($retorno);
?>