<?php
namespace charlymatloc\api\dto;

class UserDTO{
    public function __construct(
        public  string $email,
        public  string $password
    ){}
}