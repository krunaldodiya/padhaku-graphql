<?php

namespace App;

class Football
{
    public $religion;

    public function __construct(Religion $religion)
    {
        $this->religion = $religion;
    }
}
