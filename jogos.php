```php
<?php

header("Content-Type: application/json");

require "conexao.php";

$metodo = $_SERVER["REQUEST_METHOD"];

if($metodo == "POST"){
    $json = file_get_contents("php://input");

    $dados = json_decode($json, true);

    $sql = "INSERT INTO jogos 
    (titulo, plataforma, genero, desenvolvedora, ano_lançamento, preco, estoque) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados["titulo"],
        $dados["plataforma"],
        $dados["genero"],
        $dados["desenvolvedora"],
        $dados["ano_lançamento"],
        $dados["preco"],
        $dados["estoque"]
    ]);

    echo json_encode([
        "Mensagem" => "Jogo cadastrado com sucesso!"
    ]);
}

if($metodo == "GET"){
    $sql = "SELECT * FROM jogos ORDER BY titulo";

    $comando = $pdo -> query($sql);

    $jogos = $comando -> fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($jogos);
};

