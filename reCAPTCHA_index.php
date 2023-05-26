<?php
if ($_POST) {

  // CURL

  $curl = curl_init();

  // DEFINICOES DA REQUISIÇÃO COM CURL
  curl_setopt_array($curl, [
    CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => [
      'secret' => '6LfB_DYmAAAAAC4iPec-eEGv3ziSmqtjhUI-RKXg',
      'response' => $_POST['g-recaptcha-response'] ?? ''
    ]
  ]);

  // EXECUTA A REQUISIÇÃO
  $response = curl_exec($curl);

  // FECHA A CONEXÃO CURL
  curl_close($curl);


  // RESPONSE EM ARRAY
  $responseArray = json_decode($response, true);

  // SUCESSO DO RECAPCHA
  $sucesso = $responseArray['success'] ?? false;


  // RETORNO PARA O USUÁRIO
  // echo $sucesso ? "Usuário cadastrado com sucesso!" : "reCAPTCHA inválido";


  if ($sucesso) {
    header('Location: Verificacao.html');
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>reCAPTCHA</title>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="shortcut icon" href="img/Favicon.png" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    function validarPost() {
      /*VERIFICA SE O RECAPTCHO FOI SELECIONADO*/
      if (grecaptcha.getResponse() != "")
        return true;
      // ERRO NÃO SELECIONADO
      alert('Selecione a caixa "Não sou um robô"')
      return false;
    }
  </script>
</head>

<body>
  <div id="formalario">

    <h1>reCAPTCHA V2</h1>

    <p>Entre com os dados.</p>

    <form onsubmit="return validarPost()" method="POST">

      <div class="campo_formulario">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required placeholder="Nome" />
      </div>

      <div class="campo_formulario">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required placeholder="exemplo@provedor.com" />
      </div>

      <div class="g-recaptcha" data-sitekey="6LfB_DYmAAAAACzlgdhjsW2ZhrqWt4ufVFIqsopj"></div>

      <input class="botao" type="submit" value="Enviar" />

    </form>


    <section id="instrucoes">

      <h1>INSTRUÇÕES DE USO</h1>

      <p>1º Digite seu nome e sobrenome</p>
      <p>2º Digite seu e-mail </p>
      <p>3º Selecione o reCAPTCHA</p>

    </section>
  </div>
</body>

<footer>
  Desenvolvido por Arthur Rosa, Gabriel Lins e Luan Henrique.</a>
</footer>

</html>