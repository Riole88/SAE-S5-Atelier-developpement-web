<?php


namespace charlymatloc\api\dto\auth;

class UserDTO
{
    private string $id;
    private string $email;
    private int $role;

    public function __construct(string $id,string $email, int $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new \Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }
}