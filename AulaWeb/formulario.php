<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="id">ID:</label><br>
        <input type="text" id="id" name="id"><br>
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <input type="submit" value="Enviar">
    </form>

<?php
    include_once 'database.php';
    include_once 'dbclientes.php';

    // Criação da conexão com o banco de dados
    $database = new Database('localhost', 'sistema_banco', 'root', '');
    $db = $database->getConnection();

    if ($db === null) {
        die("Não foi possível conectar ao banco de dados.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta dos dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];

        // Instanciação da classe DBClientes
        $bdClientes = new DBClientes($db);

        // Criação do cliente
        if ($bdClientes->create($id, $nome, $cpf, $email)) {
            echo "Cliente inserido com sucesso!<br>";
        } else {
            echo "Erro ao incluir cliente.<br>";
        }

        // Exibição dos dados recebidos
        echo "<h2>Dados Recebidos:</h2>";
        echo "ID: " . htmlspecialchars($id) . "<br>";
        echo "Nome: " . htmlspecialchars($nome) . "<br>";
        echo "CPF: " . htmlspecialchars($cpf) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";

        // Recuperação e exibição de todos os clientes
        $clientes = $bdClientes->recovery();
        if ($clientes) {
            echo "<h2>Lista de Clientes:</h2>";
            foreach ($clientes as $cliente) {
                echo "ID: " . htmlspecialchars($cliente['id']) . "<br>";
                echo "Nome: " . htmlspecialchars($cliente['nome']) . "<br>";
                echo "CPF: " . htmlspecialchars($cliente['cpf']) . "<br>";
                echo "Email: " . htmlspecialchars($cliente['email']) . "<br><hr>";
            }
        } else {
            echo "Nenhum cliente encontrado.<br>";
        }

        // Recuperação e exibição de cliente por ID
        $idBusca = 1; 
        $cliente = $bdClientes->recoveryById($idBusca);
        if ($cliente) {
            echo "<h2>Cliente com ID $idBusca:</h2>";
            echo "ID: " . htmlspecialchars($cliente['id']) . "<br>";
            echo "Nome: " . htmlspecialchars($cliente['nome']) . "<br>";
            echo "CPF: " . htmlspecialchars($cliente['cpf']) . "<br>";
            echo "Email: " . htmlspecialchars($cliente['email']) . "<br>";
        } else {
            echo "Cliente não encontrado.<br>";
        }

        // Recuperação e exibição de cliente por nome
        $nomeBusca = "Nathaly";
        $clientes = $bdClientes->recoveryByName($nomeBusca);
        if ($clientes) {
            echo "<h2>Clientes com nome $nomeBusca:</h2>";
            foreach ($clientes as $cliente) {
                echo "ID: " . htmlspecialchars($cliente['id']) . "<br>";
                echo "Nome: " . htmlspecialchars($cliente['nome']) . "<br>";
                echo "CPF: " . htmlspecialchars($cliente['cpf']) . "<br>";
                echo "Email: " . htmlspecialchars($cliente['email']) . "<br><hr>";
            }
        } else {
            echo "Nenhum cliente encontrado com o nome '$nomeBusca'.<br>";
        }

        // Atualização de cliente
        $id = 1; 
        $nome = "Lindsay";
        $cpf = "12345678910";
        $email = "Lyndsay@email.com";
        if ($bdClientes->update($id, $nome, $cpf, $email)) {
            echo "Cliente atualizado com sucesso!<br>";
        } else {
            echo "Erro ao atualizar o cliente.<br>";
        }

        // Exclusão de cliente
        $id = 2; 
        if ($bdClientes->delete($id)) {
            echo "Cliente excluído com sucesso!<br>";
        } else {
            echo "Erro ao excluir o cliente.<br>";
        }
    }
?>
</body>
</html>
