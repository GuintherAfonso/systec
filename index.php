<?php
session_start();
include 'inc/header.inc.php';
include 'inc/footer.inc.php';

if(isset($_SESSION['logado'])){
    echo "<div class='login'><a href='editarcliente.php'>Editar Login</a><a href='sair.php'>Sair</a></div>";
}
    
    else {
        echo "<div class='login'><a href='login.php'>Login</a><a href='cadastro.php'>Cadastro</a></div>";
    
}


?>

<div class="container">
		<div class="produto">
			<img src="https://via.placeholder.com/300x200.png?text=Produto+1" alt="Produto 1">
			<h2>Produto 1</h2>
			<p>Descrição do produto 1</p>
			<div class="preco">R$ 99,90</div>
			<button>Comprar</button>
		</div>
		<div class="produto">
			<img src="https://via.placeholder.com/300x200.png?text=Produto+2" alt="Produto 2">
			<h2>Produto 2</h2>
			<p>Descrição do produto 2</p>
			<div class="preco">R$ 149,90</div>
			<button>Comprar</button>
		</div>
		<div class="produto">
			<img src="https://via.placeholder.com/300x200.png?text=Produto+3" alt="Produto 3">
			<h2>Produto 3</h2>
			<p>Descrição do produto 3</p>
            <div class="preco">R$ 119,90</div>
            <button>Comprar</button>
        </div>    