<?php
namespace charlymatloc\infra\repositories;

use charlymatloc\api\dto\auth\CredentialsDTO;
use charlymatloc\core\domain\entities\user\User;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\infra\repositories\interface\UserRepositoryInterface;
use PDO;
use DI\NotFoundException;



class PDOUserRepository implements UserRepositoryInterface {

    private PDO $pdo_user;

    public function __construct(PDO $pdo){
        $this->pdo_user = $pdo;
    }

    public function findById(string $id): User
    {
        try{
            $stmt = $this->pdo_user->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception du user");
        }

        if(!$user){
            throw new EntityNotFoundException("User avec l'id $id pas trouver");
        }

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

    public function saveUser(CredentialsDTO $cred): void
    {
        try{
            $stmt = $this->pdo_user->prepare("INSERT INTO users (email, password_hash) VALUES (:email, :password_hash)");
            $stmt->execute(['email' => $cred->email, 'password_hash' => $cred->password_hash]);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable $e){
            throw new \Exception("Erreur lors de la sauvegarde d'un utilisateur");
        }
    }

    public function findByEmail(string $email): User
    {
        try{
            $stmt = $this->pdo_user->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e){
            throw new \Exception("Erreur lors de l'execution de la requête");
        } catch(\Throwable){
            throw new \Exception("Erreur lors de la reception du user");
        }

        if(!$user){
            throw new EntityNotFoundException("User avec l'email $email pas trouver");
        }
        return new User(
            id: $user['id'],
            email: $user['email'],
            password_hash: $user['password_hash'],
            role: $user['role'],
            cree_par: $user['cree_par'],
            cree_quand: $user['cree_quand'],
            modifie_par: $user['modifie_par'],
            modifie_quand: $user['modifie_quand']
        );
    }
}