<?php 

require_once "config.php";

$connectDB = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME, DB_PORT);

if(!$connectDB){
    die("Problème lors de la connexion : ".mysqli_connect_error());
}

$sql = "SELECT pseudo, msg, date_msg
FROM messages
ORDER BY date_msg DESC;";

$requestDB = mysqli_query($connectDB,$sql) or die("probléme lors de la requète : ".mysqli_error($connectDB));


$nbMessage = mysqli_num_rows($requestDB);


if($nbMessage){
    $messages = mysqli_fetch_all($requestDB,MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon livre d'or</title>
        <link type="text/css" rel="stylesheet" href="livre.css" />
    </head>
    <body>
        <nav>
            <?=include "menu.php";?>
        </nav>
        <header>
            <h1>Lire les messages</h1>
        </header>
        <main>
            <div class="bouton">
                <a href="ajout.php">Ajouter un nouveau message</a>
            </div>
            <?php
            // pas de message
            if(empty(nbMessage)){
            ?>
            <section class="no-msg">
                <h2>Il n'y a pas de message à afficher</h2>
                <p>Utiliser le bouton "Ajouter un message" pour en créer un.</p>
            </section>
            <?php
            }else{
            ?>
            <section class="msgs">

                <h2>Les derniers messages</h2>
                <?php
                foreach($messages as $item):
                ?>
                <article>
                    <h3><?=$item['pseudo']?></h3>
                    <div><?=$item['msg']?></div>
                    <p><?=$item['date_msg']?></p>
                </article>
                <?php
                endforeach
                ?>
                <?php
                }
                ?>
                
            </section>
        </main>
        <nav>
             <?php if(nbMessage>4){
            include "menu.php";
        }
        ?>
        </nav>
        <footer>
            <p>Réalisé par Pierre, dans le cadre de la formation Web Développeur du ©CF2m <?=date('Y');?> </p>
        </footer>
    </body>
</html>