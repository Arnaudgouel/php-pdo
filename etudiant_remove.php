<?php

$id = isset($_GET['id'])? intval($_GET['id']): null;

try{
    $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
        if($connect){
            $query = $connect->prepare('DELETE FROM etudiants WHERE id = :id');
            $query->bindParam("id", $id, PDO::PARAM_INT);
            $query->execute();
            return header("location:etudiants.php");
            
        }
}
catch(Exception $e){
    die($e->getMessage());
}