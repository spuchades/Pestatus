<?php
//creamos clase Conexion a traves de la cual accederemos por mediadion del PDO a los datos 
//contenidos en nuestra base de datos
class Conexion {

    private $conexion;

    //array que contendra cada uno de los datos referentes a nuestra conexion
    private $configuracion = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "wordpress28",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "charset" => "utf8mb4"
    ];

    public function __construct() {
        
    }
//funcion que permitira hacer global y accesible en toda la aplicacion a los datos de nuestra conexion
    public function conectar() {
        try {
            $CONTROLADOR = $this->configuracion["driver"];
            $SERVIDOR = $this->configuracion["host"];
            $BASE_DATOS = $this->configuracion["database"];
            $PUERTO = $this->configuracion["port"];
            $USUARIO = $this->configuracion["username"];
            $CLAVE = $this->configuracion["password"];
            $CODIFICACION = $this->configuracion["charset"];

            $url = "{$CONTROLADOR}:host={$SERVIDOR}:{$PUERTO};"
                    . "dbname={$BASE_DATOS};charset={$CODIFICACION}";
            //creamos conexion
            $this->conexion = new PDO($url, $USUARIO, $CLAVE);
            return $this->conexion;
            //catch excepcional que arroja echo en caso de no poder conectar
        } catch (Exception $exc) {
            echo "PROBLEM CONNECT";
            echo $exc->getTraceAsString();
        }
    }

}
