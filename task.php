<?php
    try {
        $bdd= new PDO('mysql:host=localhost;dbname=appli_taches2','','');
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
    if (isset($_POST['nom']) AND isset($_POST['poids']) AND $_POST['poids']>=0 AND $_POST['poids']<=99) {
        $req2= $bdd->prepare('INSERT INTO level(level_name,poids) VALUES(?,?)' );
        $req2->execute(array($_POST['nom'],$_POST['poids']));
    }else{
        $erreure2=["veillez remplir tout les champs"];
    }

    if (isset($_POST['task_name']) AND isset($_POST['description']) AND isset($_POST['deadline']) AND isset($_POST['niveau']) AND isset($_POST['accomplie'])) {
        $req1= $bdd->prepare('INSERT INTO task(name,description,deadline,level_id,accomplished) VALUES(?,?,?,?,?)');
        $req1->execute(array($_POST['task_name'],$_POST['description'],$_POST['deadline'],$_POST['niveau'],$_POST['accomplie']));

    }else {
        $erreure1=["veillez remplir tout les champs"];
    }


    $getLevel=$bdd->query('SELECT * FROM level');
    $levels=$getLevel->fetchAll();

    $getTask=$bdd->query('SELECT * FROM task INNER JOIN level on level_id=id ORDER BY poids DESC');
    $task=$getTask->fetchAll();

?>
<!DOCTYPE html>
<html>
 <head>
     <meta charset="utf-8">
     <title></title>
     <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="/css/task.css">
 </head>
 <body>
     <div class="container-fluid header">
         <p>à faire.com</p>
     </div>
     <div class="container-fluid corps">
         <div class="row form">
             <div class="col-md-6 a_faire">
                 <p>ajouter une tache</p>
                 <form class="" action="task.php" method="post">
                     <input type="text" name="task_name" value="" placeholder="nom de la tache">
                     <input type="textarea" name="description" value="" placeholder="description">
                     <input type="date" name="deadline" value="" placeholder="deadline yyyy-mm-jj">
                     <select class="" name="niveau">
                         <option value="">niveau</option>
                         <?php
                            foreach ($levels as $value) {
                                ?>
                                <option value="<?php echo $value['id'] ;?> "><?php echo $value['level_name'].'('.$value['poids'].')';?></option>
                                <?php
                            }
                          ?>
                     </select>


                     <p>accomplie</p><br>
                     <p>oui</p>
                     <input type="radio" name="accomplie" value="oui">
                     <p>non</p>
                     <input type="radio" name="accomplie" value="non" checked="checked">

                     <button type="submit" name="button">ajouter</button>
                     <div class="alert-danger">
                         <?php if (isset($erreure1)) {
                             echo "veillez remplir tout les champs";
                         } ?>
                     </div>
                 </form>
             </div>
             <div class="col-md-6 fait">
                 <p>ajouter un niveau</p>
                 <form class="" action="task.php" method="post">
                     <input type="text" name="nom" value="">
                     <input type="" name="poids" value="0">
                     <button type="submit" name="button">ajouter</button>
                 </form>
                 <div class="alert-danger">
                     <?php if (isset($erreure2)) {
                         echo "veillez remplir tout les champs";
                     } ?>
                 </div>
                 <h3>listes des niveau</h3>
                 <?php
                    foreach ($levels as $value) {


                        echo $value['level_name'].'<br>';
                        ?>
                        <a href="level_modification.php?id=<?php echo $value['id']?>">modifier</a><br>
                        <?php

                    }
                  ?>
             </div>
         </div>
         <div class="liste col-md-4 col-md-offset-1">
             <h2>taches à faire</h2>
             <?php
                foreach ($task as $value) {
                    if ($value['accomplished'] == 'non') {
                        echo $value['name'].'<br>';
                        echo $value['description'].'<br>';
                        echo $value['deadline'].'<br>';
                        ?>
                        <a href="task_modification.php?id2=<?php echo $value['id2']?>">modifier</a><br>
                        <?php
                    }

                }
              ?>
         </div>
         <div class="liste col-md-4 col-md-offset-1">
             <h2>taches faites</h2>
             <?php
                foreach ($task as $value) {
                    if ($value['accomplished'] == 'oui') {
                        echo $value['name'].'<br>';
                        echo $value['description'].'<br>';
                        echo $value['deadline'].'<br>';
                        ?>
                        <a href="task_modification.php?id2=<?php echo $value['id2']?>">modifier</a><br>
                        <?php
                    }
                }
              ?>
         </div>
     </div>
 </body>
</html>
