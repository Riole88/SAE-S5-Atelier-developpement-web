<?php
namespace charlymatloc\infra\repositories;

use charlymatloc\api\dto\UserDTO;
use charlymatloc\core\domain\entities\user\User;
use charlymatloc\infra\repositories\interface\UserRepositoryInterface;
use PDO;

class PDOUserRepository implements UserRepositoryInterface {

    private PDO $pdo_user;

    public function __construct(PDO $pdo){
        $this->pdo_user = $pdo;
    }

    public function findById(string $id): User
    {
        $stmt = $this->pdo_user->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return new User(
            id: $user['id'],
            email: $user['email'],
            password_hash: $user['passwordhash'],
            role: $user['role'],
            cree_par: $user['cree_par'],
            cree_quand: $user['cree_quand'],
            modifie_par: $user['modifie_par'],
            modifie_quand: $user['modifie_quand']
        );
    }

    public function saveUser(User $user): void
    {
        $stmt = $this->pdo_user->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password_hash)");
        $stmt->execute(['email' => $user->email, 'password_hash' => $user->password_hash]);
    }

    public function findByEmail(string $email): User
    {
        $stmt = $this->pdo_user->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return new User(
            id: $user['id'],
            email: $user['email'],
            password_hash: $user['passwordhash'],
            role: $user['role'],
            cree_par: $user['cree_par'],
            cree_quand: $user['cree_quand'],
            modifie_par: $user['modifie_par'],
            modifie_quand: $user['modifie_quand']
        );
    }
}