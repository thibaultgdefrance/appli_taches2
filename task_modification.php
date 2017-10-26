<?php
try {
    $bdd= new PDO('mysql:host=localhost;dbname=appli_taches2','','');
} catch (Exception $e) {
    die('Erreure '.$e->getMessage());
}


if (isset($_POST['task_name']) AND isset($_POST['description']) AND isset($_POST['deadline']) AND isset($_POST['niveau']) AND isset($_POST['accomplie'])) {
    $req1= $bdd->prepare('UPDATE task SET name=?, description=?, deadline=?, level_id=?, accomplie=? WHERE id2=?');
    $req1->execute(array($_POST['task_name'],$_POST['description'],$_POST['deadline'],$_POST['niveau'],$_POST['accomplie'],$_GET['id2']));

}else {
    $erreure1=["veillez remplir tout les champs"];
}
$getLevel=$bdd->query('SELECT * FROM level');
$levels=$getLevel->fetchAll();

$data=$bdd->prepare('SELECT * FROM task WHERE id2=?');
$data->execute(array($_GET['id2']));
$data2=$data->fetch();

/*print($_POST['name']);
print($_POST['description']);
print($_POST['deadline']);
print($_POST['accomplie']);*/
print($_POST['level_id']);
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
            <input type="text" name="task_name" value="<?php echo $data2['name'];?>" placeholder="nom de la tache">
            <input type="textarea" name="description" value="<?php echo $data2['description'];?>" placeholder="description">
            <input type="date" name="deadline" value="<?php echo $data2['deadline'];?>" placeholder="deadline yyyy-mm-jj">
            <select class="" name="niveau">
                <option value="">niveau</option>
                <?php
                   foreach ($levels as $value) {
                       ?>
                       <option value="<?php echo $value['id'] ;?> "><?php echo $value['level_name'].'('.$value['poids'].')'.'('.$value['id'].')';?></option>
                       <?php
                   }
                 ?>
            </select>


            <p>accomplie</p><br>
            <p>oui</p>
            <input type="radio" name="accomplie" value="oui">
            <p>non</p>
            <input type="radio" name="accomplie" value="non" checked="checked">

            <button type="submit" name="button">modifier</button>
            <div class="alert-danger">
                <?php if (isset($erreure1)) {
                    echo "veillez remplir tout les champs";
                } ?>
            </div>
        </form>
    </body>
</html>
