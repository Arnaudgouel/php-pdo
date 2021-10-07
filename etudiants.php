<?php
session_start();
// var_dump($_SESSION);

if(!$_SESSION['logged']) return header("location:index.php");


require_once 'head.php';
require_once 'nav.php';

function displayEtudiants(){
    try{
        $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
            if($connect){
                
                $query = $connect->prepare('SELECT * FROM etudiants');
                $query->execute();
                return $query->fetchAll();
                
            }
    }
    catch(Exception $e){
        die($e->getMessage());
    }
}
?>

<a href="etudiant_add.php" class="btn btn-primary">Ajouter Etudiant</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Age</th>
      <th scope="col">Adresse</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

<?php

$etudiants = displayEtudiants();
foreach ($etudiants as $etudiant){
    echo "
        <tr>
            <th scope='row'>{$etudiant['id']}</th>
            <td>{$etudiant['nom']}</td>
            <td>{$etudiant['prenom']}</td>
            <td>{$etudiant['age']}</td>
            <td>{$etudiant['adresse']}</td>
            <td><a href='etudiant_edit.php?id={$etudiant['id']}' class='btn btn-warning'>Edit</a>
            <a href='etudiant_remove.php?id={$etudiant['id']}' class='btn btn-danger'>Remove</a></td>
        </tr>
    ";
}
?>
    
  </tbody>
</table>



<?php
require_once 'foot.php';
?>