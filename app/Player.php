<?php

namespace App;

class Player
{
    public $football;

    public function __construct(Football $football)
    {
        $this->football = $football;
    }
}
