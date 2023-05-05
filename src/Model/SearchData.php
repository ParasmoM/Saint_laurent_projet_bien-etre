<?php

namespace App\Model;

class SearchData
{
    /** @var int */
    public $page = 1;

    /** @var string */
    public string $name = '';

    /** @var mixed */
    public $service;
    
    /** @var mixed */
    public $code;
    
    /** @var mixed */
    public $town;
    
    /** @var mixed */
    public $locality;
}