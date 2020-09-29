<?php

namespace App\Library\App\Query;

class FindAllRecordsQuery
{
    public static function findAll(): FindAllRecordsQuery
    {
        return new static();
    }
}