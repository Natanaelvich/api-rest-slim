<?php

namespace Src\Models;

class Token
{

    private $id;
    private $token;
    private $refresh_token;
    private $expired_at;
    private $user_id;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of refresh_token
     */
    public function getRefresh_token()
    {
        return $this->refresh_token;
    }

    /**
     * Set the value of refresh_token
     *
     * @return  self
     */
    public function setRefresh_token($refresh_token)
    {
        $this->refresh_token = $refresh_token;

        return $this;
    }

    /**
     * Get the value of expired_at
     */
    public function getExpired_at()
    {
        return $this->expired_at;
    }

    /**
     * Set the value of expired_at
     *
     * @return  self
     */
    public function setExpired_at($expired_at)
    {
        $this->expired_at = $expired_at;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}
