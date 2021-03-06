<?php
/*
 * Retorna todos los manufacturer de la tienda
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type");
header("Access-Control-Allow-Methods", "POST, GET, PUT, DELETE, OPTIONS");
header('Content-Type: application/json');
require_once '../models/config.php';
require_once '../models/connection.php';

if(isset($_GET['operationType']) && strcasecmp($_GET['operationType'], 'selectManufacturer')==0 ) {
    $manuList = new manufacturers();
    echo $manuList->getManufacturer();
}
class manufacturers {
      public function __construct() {
        $this->BBDD = new \dbDriver;
        $this->driver = $this->BBDD->setPDO();
        $this->BBDD->setPDOConfig($this->driver);
    }
    public function getManufacturer() {
        $manufacturer = $this->BBDD->selectDriver(null,PREFIX.'manufacturer', $this->driver);
        $this->BBDD->runDriver(null, $manufacturer);
        if($this->BBDD->verifyDriver($manufacturer)) {
            return json_encode($this->BBDD->fetchDriver($manufacturer));
        } else {
            return null;
        }
    }
    protected $BBDD;
    protected $driver;
}
