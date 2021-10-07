<?php
session_start();
// var_dump($_SESSION);

if(!$_SESSION['logged']) return header("location:index.php");


require_once 'head.php';
require_once 'nav.php';
?>

<div class="row mt-5">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Etudiants</h5>
        <p class="card-text">Gérer les étudiants</p>
        <a href="etudiants.php" class="btn btn-primary">Gérer</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Cours</h5>
        <p class="card-text">Gérer les cours</p>
        <a href="#" class="btn btn-primary">Gérer</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Notes</h5>
        <p class="card-text">Gérer les notes</p>
        <a href="#" class="btn btn-primary">Gérer</a>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'foot.php';
?>

