<?php


class Magazine {

    public $id;
    public $name;
    public $price;
    public $checked;

    public function __construct($id, $name, $price){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $checked = false;
    }




}

$metal = new Magazine(1,"Metalcore", 500);
$festival = new Magazine(2,"Festival life", 1000);
$retro = new Magazine(3,"Retro ", 1850);
$animals = new Magazine(4,"Animals", 960);

$magazines_array = array($metal,$festival,$retro, $animals);

?>