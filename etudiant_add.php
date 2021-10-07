<?php
require_once 'head.php';
require_once 'nav.php';

$nom = isset($_POST['nom']) ? $_POST['nom'] : '' ;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$age = isset($_POST['age']) ? $_POST['age'] : null;
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";

if(isset($age)) add($nom, $prenom, $age, $adresse);

function add($nom, $prenom, $age, $adresse){
    try{
        $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
            if($connect){
                $query = $connect->prepare('INSERT INTO etudiants VALUES(DEFAULT, :nom, :prenom, :age, :adresse)');
                $query->bindParam("nom", $nom, PDO::PARAM_STR);
                $query->bindParam("prenom", $prenom, PDO::PARAM_STR);
                $query->bindParam("age", $age, PDO::PARAM_INT);
                $query->bindParam("adresse", $adresse, PDO::PARAM_STR);
                $success = $query->execute();
                var_dump($success);
                if($success) return header("location:etudiants.php");
                
            }
    }
    catch(Exception $e){
        die($e->getMessage());
    }
}

?>

<form method="POST" action="etudiant_add.php">
  <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" required>
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prénom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" required>
  </div>
  <div class="mb-3">
    <label for="age" class="form-label">Age</label>
    <input type="number" class="form-control" id="age" name="age" required>
  </div>
  <div class="mb-3">
    <label for="adresse" class="form-label">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once 'foot.php';
?>