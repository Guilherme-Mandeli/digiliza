<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
</head>
<body>
    <h1>Detalhes do Contato</h1>
    <p><strong>Nome:</strong> {{ $data['name'] }}</p>
    <p><strong>E-mail:</strong> {{ $data['email'] }}</p>
    <p><strong>Assunto:</strong> {{ $data['subject'] }}</p>
    <p><strong>Mensagem:</strong> {{ $data['message'] }}</p>
</body>
</html>