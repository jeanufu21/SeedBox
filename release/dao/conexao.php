<?php

class Conexao extends PDO
{
private static $conexao;
private static $local = 'mysql:host=localhost;dbname=seedboxdb';
private static $user = 'eagleseedbox';
private static $pass = 'eagleflores';

public function Conexao() 
   {
       parent::__construct(self::$local, self::$user, self::$pass);
       
   }

   public static function getInstance() {
       if(!isset( self::$conexao )){
           try {
               self::$conexao = new Conexao();
           } catch ( Exception $e ) {
               echo 'Erro ao conectar';
               exit ();
           }
       }
       self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return self::$conexao;
   }
}

?>