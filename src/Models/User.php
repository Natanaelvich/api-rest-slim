<?php

namespace Src\Models;

class User
{

    private $id;
    private $name_user;
    private $password_user;
    private $email;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name_user
     */
    public function getName_user()
    {
        return $this->name_user;
    }

    /**
     * Set the value of name_user
     *
     * @return  self
     */
    public function setName_user($name_user)
    {
        $this->name_user = $name_user;

        return $this;
    }

    /**
     * Get the value of password_user
     */
    public function getPassword_user()
    {
        return $this->password_user;
    }

    /**
     * Set the value of password_user
     *
     * @return  self
     */
    public function setPassword_user($password_user)
    {
        $this->password_user = $password_user;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
