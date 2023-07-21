<?php

/**
* Crée une clé de hachage pour un password
*/
function hashMake($password)
{
   
 
    $hash = password_hash($password, PASSWORD_BCRYPT);
 
    if ($hash === false) {
        throw new RuntimeException('Bcrypt hashing not supported.');
    }
 
    return $hash;
}
 
/**
* Vérifie qu'un password correspond à un hachage
*/
function hashCheck($password, $hashedPassword)
{
    if (strlen($hashedPassword) === 0) {
        return false;
    }
 
    return password_verify($password, $hashedPassword);
}

?>