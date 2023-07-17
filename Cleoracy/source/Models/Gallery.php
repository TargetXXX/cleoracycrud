<?php
 
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Exception;

class Gallery extends DataLayer {

    public function __construct() {
        parent::__construct("galeria", ["Text", "Image"], "Id", false);
    }




    public function saveImage() {



        if(!parent::save()) {
            throw new Exception('Não foi possível salvar imagem no banco de dados!');
        }
    }
}