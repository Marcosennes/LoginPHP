<?php
    define('HOST','localhost');
    define('USERNAME','marcosennes');
    define('PASSWORD', "");
    define('DATABASE', 'cadastro');

    $database = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die('não foi possivel conectar');

    $username = "";
    $email = "";
    $keep_logged_in = 0;
    $errors = array();
    
    if(isset($_POST['nome_cadastro']) && isset($_POST['email_cadastro']) && isset($_POST['password_cadastro']) && isset($_POST['password_confirmacao_cadastro'])){
      
      $username = $_POST['nome_cadastro'];
      $email = $_POST['email_cadastro'];
      $password = $_POST['password_cadastro'];
      $password_confirmacao_cadastro = $_POST['password_confirmacao_cadastro'];
      $keep_logged_in = $_POST['keep_logged_in_register'];
  
      if (empty($username)) { 
        array_push($errors, "Username é requerido"); 
      }
      if (empty($email)) { 
        array_push($errors, "Email é requerido"); 
      }
      if (empty($password)) { 
        array_push($errors, "Password é requerido"); 
      }
      if ($password != $password_confirmacao_cadastro) {
          array_push($errors, "password diferentes");
      }
      if($keep_logged_in != 1){
        $keep_logged_in = 0;
      }
  
      $user_check_query = "SELECT * FROM register WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($database, $user_check_query);
      $user = mysqli_fetch_assoc($result);
  
      if ($user) { // if user exists
          if ($user['email'] === $email) {
            array_push($errors, "email já existe");
  
            $retorno = 0;
          }
        }
        if (count($errors) == 0) {
          $password_db = md5($password);//encrypt the password before saving in the database
    
          $query = "INSERT INTO register (username, email, password, keep_logged_in) 
                    VALUES('$username', '$email', '$password_db', '$keep_logged_in')";
          mysqli_query($database, $query);
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Agora você está logado";
  
          $retorno = 1;
      }
    }
    
    echo json_encode($retorno);  
?>