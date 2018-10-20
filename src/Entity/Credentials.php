<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Credentials
{
    /**
     * @Assert\NotBlank(message="le login ne peut être vide")
     * @Assert\Type("string")
     */
    protected $login;

    /**
     * @Assert\NotBlank(message="le mot de passe ne peut être vide")
     * @Assert\Type("string")
     */
    protected $password;

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}