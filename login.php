<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_geek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $ano = $_POST['ano'];

    $nome = $conn->real_escape_string($nome);
    $curso = $conn->real_escape_string($curso);
    $ano = $conn->real_escape_string($ano);

    $valid_anos = ['1º Ano', '2º Ano', '3º Ano'];
    if (!in_array($ano, $valid_anos)) {
        die("Ano inválido.");
    }

    $sql = "INSERT INTO users (nome, curso, ano) VALUES ('$nome', '$curso', '$ano')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
