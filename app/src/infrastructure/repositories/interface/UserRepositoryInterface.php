<?php
namespace charlymatloc\infra\repositories\interface;


use charlymatloc\api\dto\UserDTO;
use charlymatloc\core\domain\entities\user\User;

interface UserRepositoryInterface {
    public function findById(string $id): User;
    public function saveUser(User $user): void;
    public function findByEmail(string $email): User;
}