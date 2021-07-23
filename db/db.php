<?php
    require 'rb-mysql.php';
    
//    R::setup( 'mysql:host=localhost;dbname=p-318571_','root', '' );
    try {
        R::setup( 'mysql:host=localhost;dbname=ali','root', '' );
    } catch (Exception $ex) {
        
    }
    
    
//    R::dispense("users");
// p-318571 z6tYmKBjPKo9!
//    $result = R::getAll("select * from users");
//    var_dump($result);
//    echo count($result);
//    foreach ($result as $value) {
//        echo $value['users_name'].'<br>';
//    } 
  
    if ( !R::testConnection() )
    {
        R::setup( 'mysql:host=localhost;dbname=p-318571_','p-318571', 'z6tYmKBjPKo9!' );
        if ( !R::testConnection() ) exit ('Ошибка при соединении к БД');
    }
 
        
        
        
    
    
            
     
 
    
