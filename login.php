<?php
session_start();
include 'inc/header.inc.php';
include 'classes/clientes.php';

if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5($_POST['senha']);

    $cliente = new Clientes();
    if($cliente->fazerLogin($email, $senha)){
        header("Location: index.php");
        exit;
    }else{
        echo "Usuario e/ou senha estão incorretas!";

    }
}
?>
<div class="centralizarform">
<h1>LOGIN</h1>

    <form method="post">
        Email: <br>
        <input type="email" name="email"><br><br>
        Senha: <br>
        <input type="password" name="senha"><br><br>
       <div class="centralizarbutton"><input class="button" type="submit" value="Entrar"></div>
    </form>    
</div>



<?php include 'inc/footer.inc.php'; ?>