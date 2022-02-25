<?php

/**
 * Commencez par importer le fichier sql live.sql via PHPMyAdmin.
 * 1. Sélectionnez tous les utilisateurs.
 * 2. Sélectionnez tous les articles.
 * 3. Sélectionnez tous les utilisateurs qui parlent de poterie dans un article.
 * 4. Sélectionnez tous les utilisateurs ayant au moins écrit deux articles.
 * 5. Sélectionnez l'utilisateur Jane uniquement s'il elle a écris un article ( le résultat devrait être vide ! ).
 *
 * ( PS: Sélectionnez, mais affichez le résultat à chaque fois ! ).
 */

require __DIR__ . "/Classes/DBSingleton.php";

$pdo = DBSingleton::PDO();

/*================================1===========================================

$stm = $pdo->prepare("
    SELECT *
    FROM user 
");

if ($stm->execute()) {
    echo "<pre>";
    print_r($stm->fetchAll());
    echo "</pre>";
}
*/

/*===================================2===================================
$stm = $pdo->prepare("
    SELECT *
    FROM article 
");

if ($stm->execute()) {
    echo "<pre>";
    print_r($stm->fetchAll());
    echo "</pre>";
}
*/
/*====================================3============================================

$stm = $pdo->prepare("
    SELECT *
    FROM user 
    WHERE id = ANY (SELECT user_fk FROM article WHERE contenu LIKE '%poterie%')
");

if ($stm->execute()) {
    echo "<pre>";
    print_r($stm->fetchAll());
    echo "</pre>";
}
*/
/*====================================4=============================================*/

$stm = $pdo->prepare("
    SELECT *
    FROM user 
    WHERE id = ANY (SELECT user_fk FROM article GROUP BY user_fk HAVING count(user_fk) >= 2)
");

if ($stm->execute()) {
    echo "<pre>";
    print_r($stm->fetchAll());
    echo "</pre>";
}


/*=========================================5================================================

$stm = $pdo->prepare("
    SELECT *
    FROM user WHERE username LIKE 'jane%' AND id= ANY (SELECT user_fk FROM article)
    
");

if ($stm->execute()) {
    echo "<pre>";
    print_r($stm->fetchAll());
    echo "</pre>";
}
*/