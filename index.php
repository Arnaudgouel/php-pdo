<?php
require_once("head.php");

function badLogin(){
    session_start();

    if(isset($_SESSION["bad_login"])){

        unset($_SESSION["bad_login"]);

        return "<div class=\"alert alert-danger\" role=\"alert\">
        Vos identifiants ne correpondent pas!
    </div>";

    
    }
}


?>


<div class="text-center m-auto div-flex">
    <main class="form-signin">
        <?php echo badLogin(); ?>
        <form class="text-center" action="traitement_user.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            
            <div class="form-floating">
                <input type="email" class="form-control" id="login" name="login" placeholder="name@example.com" required>
                <label for="login">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <a href="register.php">Sign up</a>

        </form>
    </main>
</div>

<?php
require_once("foot.php");
?>