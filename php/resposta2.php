<!-- 2) Escreva uma função em PHP ou JavaScript que receba como parâmetro um vetor de inteiros e seu tamanho,
 e retorne o menor valor presente no vetor. -->

<?php
session_start(); //inicia sessão

class Vetor
{
  private $vetor;

  // inicializa as propriedades do objeto $vetor

  public function __construct()
  {
    $this->vetor = array();
  }

  // verifica se $elemento é vazio, caso contrário adiciona um $elemento a $vetor

  public function Adicionar($elemento)
  {
    if (!empty($elemento)) {
      array_push($this->vetor, $elemento);
    }
  }

  // verifica qual é o menor valor do vetor

  public function menorValor()
  {
    $tamanho = count($this->vetor); // calcula tamanho do vetor
    // verifica se vetor não está vazio
    if ($tamanho > 0) {
      $menor = $this->vetor[0]; // define o menor valor inicial como o primeiro elemento do vetor
    } else {
      return "<h3>Vetor vazio</h3>";
    }

    for ($i = 1; $i < $tamanho; $i++) {
      if ($this->vetor[$i] < $menor) {
        $menor = $this->vetor[$i]; // se valor atual for menor, atualiza menor valor
      }
    }
    return "<h3>Menor valor: $menor</h3>";
  }

  // lista todos os items do vetor

  public function listarVetor()
  {
    $elementos = "[" . implode(",", $this->vetor) . "]";
    return $elementos;
  }
}

// se a variável de sessão previamente existir o código desserializa o valor armazenado e a tribui a $vetor

if (isset($_SESSION['vetor'])) {
  $vetor = unserialize($_SESSION['vetor']);
} else {
  $vetor = new Vetor(); //inicializa o vetor com um novo objeto
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão adicionar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
  $elemento = $_POST['elemento'];
  if (empty($elemento)) {
    echo "<script>alert('O elemento adicionado não deve ser vazio.')</script>";
  } elseif (is_numeric($elemento) && intval($elemento) == $elemento) { // verifica se é númerico o dado ou se é possível converter para inteiro
    $vetor->Adicionar($elemento);
    $_SESSION['vetor'] = serialize($vetor); //salva a vetor atualizado na sessão
    header('Location: resposta2.php');  // redirecionamento para a página inicial 
    exit();  //finaliza o script
  } else {
    echo "<script>alert('O elemento adicionado deve ser um número inteiro.')</script>";
  }
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão limpar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpar'])) {
  session_destroy(); // destroi a sessão
  header("Location: resposta2.php"); // redirecionamento para a página inicial 
  exit(); //finaliza o script
}

?>

<!-- Exibição da página -->
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Vetor com PHP e Sessão</title>
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
      </form>
      <h2>Vetor atualizado:</h2>
      <!-- exibição de dados -->
      <?php
      echo $vetor->menorValor();
      echo $vetor->listarVetor();
      ?>
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