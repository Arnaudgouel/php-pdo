<?php

    //1-    Récupération des données du formulaire via POST
        $login = isset($_POST['login']) ? $_POST['login'] : '' ;
        $password = isset($_POST['password']) ? $_POST['password'] : '' ;
        $admin = isset($_POST['admin']) ? $_POST['admin'] : 0;

        var_dump($_POST);
        var_dump($login);
        var_dump($password);
        var_dump($admin);

        if($admin == true)
        {
            $admin = "admin";
        }
        else{
            $admin = "user";
        }
    // //2-    Affichage des variables

    // if(isset($_POST['save']))
    //      echo 'Nom : ' . $nomProd  .'- Description : '. $descriptionProd .'- Prix : '. $prix .'- stock : '. $stock;
    // else
    //     echo 'Pas de save !';
    //3-    Création de la connexion à la base de données
        try{
            $connect = new PDO('mysql:host=localhost;dbname=gestion_notes;charset=utf8','root','');
                if($connect){
                    /**
                     * les différents traitements : INSERT, UPDATE, DELETE
                     */
                    //1-    INSERT 
                    if(isset($_POST['login'])){
                            $query = $connect->prepare('SELECT * from users WHERE login LIKE :login');
                        //b-    Liaison des paramètres (Injecte les données dans la requêtes)
                            $query->bindParam('login',$login,PDO::PARAM_STR);
                        //c-    Exécution de la requête
                            $query->execute();
                            $result = $query->fetch();
                        //d-    Rediriger vers la page principale
                            var_dump($result);
                            if(is_array($result)){
                                session_start();
                                $_SESSION["user_exists"] = true;
                                return header("location:register.php");
                            }
                        //a-    Préparation de la requête
                            $query = $connect->prepare('INSERT INTO users VALUES(:login,:password,:type)');
                        //b-    Liaison des paramètres (Injecte les données dans la requêtes)
                            $query->bindParam('login',$login,PDO::PARAM_STR);
                            $query->bindParam('password',$password,PDO::PARAM_STR);
                            $query->bindParam('type',$admin,PDO::PARAM_STR);
                        //c-    Exécution de la requête
                            $result = $query->execute();
                        //d-    Rediriger vers la page principale
                            if($result){
                                echo("success");
                                session_start();
                                $_SESSION['logged'] = true;
                                header("location:dashboard.php");
                            }
                            else{
                                echo("fail");
                            }
                        return;
                    }
                    //2-    UPDATE    
                    else if(isset($_POST['edit']) && $idProd !=0){
                          //3-1   Préparation de la requête
                            $query = $connect->prepare("UPDATE produit 
                                        SET 
                                            nomProd = :nom ,
                                            descriptionProd = :descrip,
                                            prixProd = :prix,
                                            stockProd = :stock
                                        WHERE idProd = :id
                            ");
                        //3-2   Passage de paramètres à la requête
                            $query->bindValue(':nom',$nomProd);
                            $query->bindValue(':descrip',$descriptionProd);
                            $query->bindValue(':prix',$prixProd);
                            $query->bindValue(':stock',$stockProd);
                            $query->bindValue(':id',$idProd);

                        //3-3   Exécution de la requête
                            $query->execute();
                        //3-4   Redirection vers la page principale index.php  
                            header("location:index.php");  
                    }
                    // else if(isset($_GET['edit'])){
                    //     echo 'je suis dans le get et id :' . $_GET['edit'];
                    // }
                     //2-    DELETE
                    else if(isset($_GET['delete']) && !empty($_GET['delete'])){
                        $query = $connect->prepare("DELETE FROM produit WHERE idProd = ?");
                        $query->bindParam(1,$_GET['delete'],PDO::PARAM_INT);
                        $query->execute();
                        header("location:index.php");
                    }
                }
        }catch(Exception $e){
            die('Problème de connexion '. $e->getMessage());
        }
           
?>