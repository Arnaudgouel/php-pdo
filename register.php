<?php
require_once("head.php");

function userExists(){
    session_start();

    if(isset($_SESSION["user_exists"])){

        unset($_SESSION["user_exists"]);

        return "<div class=\"alert alert-danger\" role=\"alert\">
        Vous avez déjà un compte chez nous!
        </div>";
    }
}

?>


<div class="text-center m-auto div-flex">
    <main class="form-signin">
        <?php echo userExists(); ?>
        <form class="text-center" action="traitement_register.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Please register</h1>
            
            <div class="form-floating">
                <input type="email" class="form-control" id="login" placeholder="name@example.com" name="login" required>
                <label for="login">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="admin" name="admin" value="true">
                <label class="form-check-label" for="admin">Admin</label>
            </div>
            
            <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            <a href="index.php">Sign in</a>
        </form>
    </main>
</div>

<?php
require_once("foot.php");
?>