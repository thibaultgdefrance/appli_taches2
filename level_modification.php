<?php
    try {
        $bdd= new PDO('mysql:host=localhost;dbname=appli_taches2','','');
    } catch (Exception $e) {
        die('Erreure '.$e->getMessage());
    }

    if (isset($_POST['level_name']) AND isset($_POST['poids']) AND $_POST['poids']>=0 AND $_POST['poids']<=99) {
        $req= $bdd->prepare('UPDATE level SET level_name=?, poids=? WHERE id=?');
        $req->execute(array($_POST['level_name'],$_POST['poids'],$_GET['id']));
    }else {
        $erreure= 'veillez renseigner tout les champs';
    }

    $data=$bdd->prepare('SELECT * FROM level WHERE id=?');
    $data->execute(array($_GET['id']));
    $data2=$data->fetch();


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h2>
        <a href="task.php">Retour à la page d'accueil</a>
        </h2>
        <form class="" action="" method="post">
            <input type="text" name="level_name" value="<?php echo $data2['level_name'];?>" placeholder="nom"><br>
            <input type="text" name="poids" value="<?php echo $data2['poids'];?>" placeholder="poids entre 0 et 99"><br>
            <button type="submit" name="button">modifier</button>
        </form>
        <div class="alert-danger">
            <?php echo $erreure; ?>
        </div>
    </body>
</html>
