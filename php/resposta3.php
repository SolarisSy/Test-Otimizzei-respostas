<!-- 3) Escreva uma classe em PHP ou JavaScript chamada "Livro" que possua os atributos "título",
 "autor" e "ano de lançamento".
  A classe deve possuir um método construtor que inicialize os atributos e métodos getter e setter para cada atributo. -->

<?php
session_start(); //inicia sessão
class Livro
{

  // declarando interface

  private $titulo;
  private $autor;
  private $anoLancamento;

  public function __construct($titulo, $autor, $anoLancamento)
  {
    $this->titulo = $titulo;
    $this->autor = $autor;
    $this->anoLancamento = $anoLancamento;
  }

  // listar título

  public function getTitulo()
  {
    return $this->titulo;
  }

  // definir título

  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;
  }

  // listar autor

  public function getAutor()
  {
    return $this->autor;
  }

  // definir autor

  public function setAutor($autor)
  {
    $this->autor = $autor;
  }

  // listar Ano de lançamento

  public function getAnoLancamento()
  {
    return $this->anoLancamento;
  }

  // definir ano de lançamento

  public function setAnoLancamento($anoLancamento)
  {
    $this->anoLancamento = $anoLancamento;
  }
}

// se a variável de sessão previamente existir o código desserializa o valor armazenado e a tribui a $livro

if (isset($_SESSION['livro'])) {
  $livro = unserialize($_SESSION['livro']);
} else {
  $livro = new Livro("Título", "Autor", 'Data'); //inicializa um novo objeto
}

// botão Set Titulo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setTitulo'])) {
  $titulo = $_POST['titulo'];
  if (empty($titulo)) {
    echo "<script>alert('O titulo adicionado não deve ser vazio.')</script>";
  } else {
    $livro->setTitulo($titulo);
    $_SESSION['livro'] = serialize($livro); //salva o titulo atualizado na sessão
    header('Location: resposta3.php');  // redirecionamento para a página inicial 
    exit();  //finaliza o script
  }
}

// botão Set Autor
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setAutor'])) {
  $autor = $_POST['autor'];
  if (empty($autor)) {
    echo "<script>alert('O autor adicionado não deve ser vazio.')</script>";
  } else {
    $livro->setAutor($autor);
    $_SESSION['livro'] = serialize($livro); //salva o autor atualizado na sessão
    header('Location: resposta3.php');  // redirecionamento para a página inicial 
    exit();  //finaliza o script
  }
}

// botão Set Ano
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['setAnoLancamento'])) {
  $anoLancamento = $_POST['anoLancamento'];
  if (empty($anoLancamento)) {
    echo "<script>alert('O AnoLancamento adicionado não deve ser vazio.')</script>";
  } else {
    $livro->setAnoLancamento($anoLancamento);
    $_SESSION['livro'] = serialize($livro); //salva o anoLancamento atualizado na sessão
    header('Location: resposta3.php');  // redirecionamento para a página inicial 
    exit();  //finaliza o script
  }
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão limpar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpar'])) {
  session_destroy(); // destroi a sessão
  header("Location: resposta3.php"); // redirecionamento para a página inicial 
  exit(); //finaliza o script
}

?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>


<body>
  <div class="container">
    <div class="content">

      <!-- formulário com input de dados -->
      <h2>Livro:</h2>
      <form method="post">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $livro->getTitulo() ?>">
        <button type="submit" name="setTitulo">Set Titulo</button>
        <br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" value="<?php echo $livro->getAutor() ?>">
        <button type="submit" name="setAutor">Set Autor</button>
        <br>
        <label for="anoLancamento">Data:</label>
        <input type="text" name="anoLancamento" id="anoLancamento" value="<?php echo $livro->getAnoLancamento() ?>">
        <button type="submit" name="setAnoLancamento">Set Ano</button>
        <br>
        <button type="submit" name="limpar">Limpar tudo</button>
      </form>
      <!-- exibição de dados -->
      <?php
      // Exibindo as informações do livro em HTML
      echo "<h3>Get Titulo: " . $livro->getTitulo() . "</h3>";
      echo "<p>Get Autor: " . $livro->getAutor() . "</p>";
      echo "<p>Get Ano de lançamento: " . $livro->getAnoLancamento() . "</p>";
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