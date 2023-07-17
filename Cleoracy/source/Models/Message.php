<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Message extends DataLayer {

    public function __construct() {

        parent::__construct("mensagens", ["Assunto", "Message", "Autor", "Anon"], "Id", false);
        
    }


    public function save() : bool {

        return parent::save();
    }
}