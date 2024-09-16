<?php
class DBClientes {
    private $conexao;
    private $tableName = 'clientes';
 
    public function __construct($db) {
        $this->conexao = $db;
    }
 
    public function create($id, $nome, $cpf, $email) {
        try {
            $query = "INSERT INTO " . $this->tableName . " (id, nome, cpf, email) VALUES (:id, :nome, :cpf, :email)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erro ao inserir cliente: " . $exception->getMessage();
            return false;
        }
    }

    public function recovery() {
        try {
            $query = "SELECT * FROM " . $this->tableName;
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erro ao recuperar clientes: " . $exception->getMessage();
            return false;
        }
    }

    public function recoveryById($idBusca) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id', $idBusca);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erro ao recuperar cliente por ID: " . $exception->getMessage();
            return false;
        }
    }


    public function recoveryByName($nomeBusca) {
        try {
            $query = "SELECT * FROM " . $this->tableName . " WHERE nome = :nome";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome', $nomeBusca);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Erro ao recuperar cliente por nome: " . $exception->getMessage();
            return false;
        }
    }

    public function update($id, $nome, $CPF, $email) {
        try {
            $query = "UPDATE " . $this->tableName . " SET nome = :nome, cpf = :cpf, email = :email WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $CPF);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erro ao atualizar cliente: " . $exception->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $exception) {
            echo "Erro ao excluir cliente: " . $exception->getMessage();
            return false;
        }
    }
}
 
 