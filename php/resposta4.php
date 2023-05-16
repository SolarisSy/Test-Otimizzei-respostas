<!-- 4) Escreva um programa em PHP ou JavaScript que solicite ao usuário a temperatura em graus Celsius e converta para Fahrenheit.
 O programa deve exibir o resultado na tela. -->

<?php
session_start(); //inicia sessão

class CelToFah
{

 private $result;
 private $celcius;

 // inicializa as propriedades da variável $result

 public function __construct()
 {
  $this->result = null;
  $this->celcius = null;
 }

 // função que recebe celcius e converte para fahrenheit

 public function conversor($celcius)
 {
  $this->celcius = $celcius;
  $this->result = ($celcius * 1.8) + 32;
 }

 // função que exibe na html o resultado de celcius para fahrenheit

 public function Listar()
 {
  $fahrenheit = $this->result;
  $celcius = $this->celcius;
  return "<h3>$celcius Celcius convertidos para Fahnheit: $fahrenheit</h3>";
 }
}


// se a variável de sessão previamente existir o código desserializa o valor armazenado e a tribui a $celToFah

if (isset($_SESSION['celToFah'])) {
 $celToFah = unserialize($_SESSION['celToFah']);
} else {
 $celToFah = new CelToFah();
}

//botão converter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['converter'])) {
 $converter = $_POST['converter'];
 if (empty($converter)) {
  echo "<script>alert('O campo adicionado não deve ser vazio.')</script>";
 } elseif (is_numeric($converter) && floatval($converter) == $converter) {
  $celToFah->conversor($converter);
  $_SESSION['celToFah'] = serialize($celToFah);
  header('Location: resposta4.php');
  exit();
 } else {
  echo "<script>alert('O elemento adicionado deve ser um número float ou inteiro.')</script>";
 }
}

//verifica se o método da requisição é POST e se os parâmetros foram enviados corretamente.

// botão limpar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpar'])) {
 session_destroy(); // destroi a sessão
 header("Location: resposta4.php"); // redirecionamento para a página inicial 
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
   <h2>Conversor:</h2>
   <form method="post">
    <label for="conversor">Conversor Celcius para Fahrenheit:</label>
    <input type="text" name="converter" id="converter">
    <button type="submit">Enviar</button>
    <button type="submit" name="limpar">Limpar tudo</button>
   </form>
   <!-- exibição de dados -->
   <h2>Resultado:</h2>
   <?php
   // Exibindo as informações
   echo $celToFah->Listar();
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