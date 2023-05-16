<!-- 1) Implemente uma pilha em PHP ou JavaScript utilizando uma estrutura de dados do tipo array.
 A pilha deve possuir os métodos "push" (para inserir um elemento),
  "pop" (para remover o último elemento inserido) e "top" (para retornar o último elemento inserido sem removê-lo).
   A pilha deve ser capaz de armazenar valores inteiros. -->

<?php
session_start(); //iniciar sessão

class Pilha
{

  private $pilha;

  //inicializa as propriedades do objeto $pilha

  public function __construct()
  {
    $this->pilha = array();
  }

  // verifica de o valor recebido não é vazio, se não for adiciona a pilha o novo $elemento

  public function Adicionar($elemento)
  {
    if (!empty($elemento)) {
      array_push($this->pilha, $elemento);
    }
  }

  // função verifica se o dado é vazio e remove topo da pilha

  public function removeTop()
  {
    if (!empty($this->pilha)) {
      array_pop($this->pilha);
    }
  }

  //$elemento é resetado e a pilha é invertida com o método, e depois é construido a lista pelo for a exibição da pilha no html

  public function Listar()
  {
    $elementos = "";
    $pilhaReversa = array_reverse($this->pilha);
    foreach ($pilhaReversa as $elemento) {
      $elementos .= "<li>$elemento</li>";
    }
    return $elementos;
  }

  // quando chamado pega o topo da pilha e retorna no html

  public function Top()
  {
    $topoitem = "";
    if (!empty($this->pilha)) {
      $topoitem = end($this->pilha);
    }
    return "<h3>Topo da pilha: $topoitem</h3>";
  }
}

// se a variável de sessão previamente existir o código desserializa o valor armazenado e a tribui a $pilha

if (isset($_SESSION['pilha'])) {
  $pilha = unserialize($_SESSION['pilha']);
} else {
  $pilha = new Pilha(); //inicializa a pilha com um novo objeto pilha
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão adicionar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
  $elemento = $_POST['elemento'];
  if (empty($elemento)) {
    echo "<script>alert('O elemento adicionado não deve ser vazio.')</script>";
  } elseif (is_numeric($elemento) && intval($elemento) == $elemento) { // verifica se é númerico o dado ou se é possível converter para inteiro
    $pilha->Adicionar($elemento);
    $_SESSION['pilha'] = serialize($pilha); //salva a pilha atualizada na sessão
    header('Location: resposta1.php');  // redirecionamento para a página inicial 
    exit();  //finaliza o script
  } else {
    echo "<script>alert('O elemento adicionado deve ser um número inteiro.')</script>";
  }
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão limpar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpar'])) {
  session_destroy(); // destroi a sessão
  header("Location: resposta1.php"); // redirecionamento para a página inicial 
  exit(); //finaliza o script
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão remover topo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removertopo'])) {
  $pilha->removeTop();  // Remove topo da pilha
  $_SESSION['pilha'] = serialize($pilha); //salva a pilha atualizada na sessão
  header("Location: resposta1.php");  // redirecionamento para a página inicial 
  exit();  //finaliza o script
}
?>

<!-- Exibição da página -->
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Pilha com PHP e Sessão</title>
</head>

<body>
  <div class="container">
    <div class="content">

      <!-- formulário com input de dados -->
      <form method="post">
        <label for="elemento">Elemento:</label>
        <input type="text" name="elemento" id="elemento">
        <button type="submit" name="adicionar">Adicionar</button>
        <button type="submit" name="limpar">Limpar tudo</button>
        <button type="submit" name="removertopo">Remover Topo</button>
      </form>
      <!-- exibição de dados -->
      <h2>Pilha atualizada:</h2>
      <ul>
        <?php
        echo $pilha->Top();
        echo $pilha->Listar();
        ?>
      </ul>
    </div>
  </div>
</body>

<style>
  html,
  body {
    margin: 0;
    padding: 0;
  }

  html {
    width: 100%;
  }

  .container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  .content {
    display: block;
    text-align: left;
  }
</style>

</html>

</html>