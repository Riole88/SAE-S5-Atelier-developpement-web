<?php

namespace charlymatloc\core\domain\entities\User;

use Exception;

class User {

    private string $id;
    private string $email;
    private string $password_hash;
    private int $role;
    private ?string $cree_par;
    private string $cree_quand;
    private ?string $modifie_par;
    private string $modifie_quand;

    public function __construct(string $id, string $email, string $password_hash, int $role, ?string $cree_par, string $cree_quand, ?string $modifie_par, string $modifie_quand)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->role = $role;
        $this->cree_par = $cree_par;
        $this->cree_quand = $cree_quand;
        $this->modifie_par = $modifie_par;
        $this->modifie_quand = $modifie_quand;
    }

    /**
     * @throws Exception
     */
    public function __get(string $name){
        if(property_exists($this,$name)) {
            return $this->$name;
        }
        throw new Exception("Propriété '$name' inexistante dans " . __CLASS__);
    }

}