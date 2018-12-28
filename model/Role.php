<?php

class Role
{
    private $id_role;
    private $role;

    public function __construct($id_role, $role)
    {
        $this->id_role = $id_role;
        $this->role = $role;
    }

    public function getIdRole()
    {
        return $this->id_role;
    }

    public function setIdRole($id_role): void
    {
        $this->id_role = $id_role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }


}