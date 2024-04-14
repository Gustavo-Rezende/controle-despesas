<!DOCTYPE html>
<html>
<head>
    <title>Nova Despesa Criada</title>
</head>
<body>
    <h1>Nova Despesa Criada</h1>
    <p>Uma nova despesa foi criada com os seguintes detalhes:</p>
    <ul>
        <li>Valor: {{ $despesa->valor }}</li>
        <li>Categoria: {{ $despesa->categoria }}</li>
    </ul>
</body>
</html>
