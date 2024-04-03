<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ . '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        # $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        # $password = filter_input(INPUT_POST, 'password');

        $queryParams = $request->getParsedBody();
        $email = filter_var($queryParams['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($queryParams['password']);
    
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

        if(!$correctPassword){
            $this->addErrorMessage('Usuario ou Senha inválidos!');
            return new Response(302, ['Location' => '/Login']);
        }

        # atualizando o hash de senha "antigas", se vier a surgir um hash melhor que o atual
        if(password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
            $statement = $this->pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $userData["id"]);
            $statement->execute();
        }

        $_SESSION['logado'] = true;
        return new Response(302, ['Location' => '/']);

    }
}
