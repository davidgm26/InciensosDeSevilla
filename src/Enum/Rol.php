<?php

enum Rol: int
{
    case Administrador = 1;
    case Cliente = 2;


    public function getLabel()
    {
        return match ($this) {
            self::Administrador => 'ROLE_ADMIN',
            self::Cliente => 'ROLE_CLIENTE',
        };
    }

}

