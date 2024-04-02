<?php

namespace Alura\Mvc\Controller;

use PDO;

class LoginController implements Controller
{
    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ . '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }

    public function processarRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
    
        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        // die('chegou');
        $statement->bindValue(1, $email);
        $statement->execute();
    
        $userData = $statement->fetch(PDO::FETCH_ASSOC);
        
        # não posso fazer a verificacao dessa forma
        // $userData['password'] === password_hash($password);

        # ao invés disso, vamos utilizar uma função que faz esse trabalho
        $correctPassword = password_verify($password, $userData['password'] ?? '');

        # atualizando o hash de senha "antigas", se vier a surgir um hash melhor que o atual
        if(password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
            $statement = $this->pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $userData["id"]);
            $statement->execute();
        }

        if($correctPassword){
            $_SESSION['logado'] = true;
            header('Location: /');
        } else {
            header('Location: /login?sucesso=0');
        }
    }
}