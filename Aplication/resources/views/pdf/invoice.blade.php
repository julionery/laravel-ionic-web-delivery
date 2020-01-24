<!DOCTYPE html>
<html lang="pt-BR" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title> Os PrintF</title>
    <link rel="stylesheett" type="text/css" href="views/css/pdf.css">
</head>
<body>
<h1>Categorias</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categorias as $categoria)
        <tr>
            <td>{{$categoria->id}}</td>
            <td>{{$categoria->nome}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>