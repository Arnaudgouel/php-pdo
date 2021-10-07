<?php



require_once 'head.php';
require_once 'nav.php';


$id = isset($_GET['id'])? intval($_GET['id']): null;

$nom = isset($_POST['nom']) ? $_POST['nom'] : '' ;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$age = isset($_POST['age']) ? $_POST['age'] : 0;
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";

if($nom) edit($id, $nom, $prenom, $age, $adresse);

function getValues($id){
    try{
        $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
            if($connect){
                $query = $connect->prepare('SELECT * FROM etudiants WHERE id = :id');
                $query->bindParam("id", $id, PDO::PARAM_INT);
                $query->execute();
                return $query->fetch();
                
            }
    }
    catch(Exception $e){
        die($e->getMessage());
    }
}

if($id) $values = getValues($id);

// var_dump($values);

function edit($id, $nom, $prenom, $age, $adresse){

    try{
        $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
            if($connect){
                $query = $connect->prepare("UPDATE etudiants 
                SET 
                    nom = :nom ,
                    prenom = :prenom,
                    age = :age,
                    adresse = :adresse
                WHERE id = :id
    ");
                $query->bindParam("id", $id, PDO::PARAM_INT);
                $query->bindParam("nom", $nom, PDO::PARAM_STR);
                $query->bindParam("prenom", $prenom, PDO::PARAM_STR);
                $query->bindParam("age", $age, PDO::PARAM_INT);
                $query->bindParam("adresse", $adresse, PDO::PARAM_STR);
                $succes = $query->execute();
                if($succes) return header("location:etudiants.php");
                
            }
    }
    catch(Exception $e){
        die($e->getMessage());
    }

}



?>

<form method="POST" action="etudiant_edit.php?id=<?php echo $id ?>">
  <div class="mb-3">
    <label for="nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $values["nom"]?>" required>
  </div>
  <div class="mb-3">
    <label for="prenom" class="form-label">Prénom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $values["prenom"]?>" required>
  </div>
  <div class="mb-3">
    <label for="age" class="form-label">Age</label>
    <input type="number" class="form-control" id="age" name="age" value="<?php echo $values["age"]?>" required>
  </div>
  <div class="mb-3">
    <label for="adresse" class="form-label">Adresse</label>
    <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $values["adresse"]?>" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
require_once 'foot.php';
?>
