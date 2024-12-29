<?php

namespace http\model;

use core\Authenticator;

class EntityModel
{
    public static function getEntity()
    {
        return Authenticator::get()
                ->query("SELECT `entity_name` FROM `company_entity` WHERE soft_deleted = :soft_deleted", [
                    'soft_deleted' => 'NTDEL',
                ])
                ->get();
    }
} 