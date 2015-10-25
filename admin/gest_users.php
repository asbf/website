<?php
include("pages/header.php");

if (isset($_POST["sup"])) {
    extract($_POST);

    $d = $bdd->prepare("DELETE FROM `users` WHERE id = ?");
    $d->execute(array($id));
}

if (isset($_POST["mdp"])) {
    extract($_POST);

    $mdp = random(5);

    mail($mail, "[ASBF] compte admin", "Changemement de mot de passe : Utilisateur : ".$login." mdp : ".$mdp,"FROM: contact@asbf.fr");

    $hmdp = hashMdp($mdp);

    $d = $bdd->prepare("UPDATE `users` SET `pass` = ? WHERE id = ?");
    $d->execute(array($hmdp,$id));
}

?>
        <style type="tzxt/css">
            .lb {
                display: inline;
            }
        </style>
         <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <h2>Gestion des utilisateurs</h2>

              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>Login</th>
                      <th>Mail</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $su = $bdd->query("SELECT * FROM `users` WHERE `login` <> 'root'");

                while ($du = $su->fetch()) {
                ?>
                    <tr>
                        <td><?php echo $du["login"] ?></td>
                        <td><?php echo $du["mail"] ?></td>
                        <td>
                            <form class="lb" method="POST" action="">
                                <input type="hidden" name="id" value="<?php echo $du["id"]; ?>">
                                <input type="submit" value="Suprimer" name="sup" class="btn btn-danger">
                            </form>
                            <form class="lb" method="POST" action="">
                                <input type="hidden" name="login" value="<?php echo $du["login"]; ?>">
                                <input type="hidden" name="id" value="<?php echo $du["id"]; ?>">
                                <input type="hidden" name="mail" value="<?php echo $du["mail"]; ?>">
                                <input type="submit" value="Changer MDP" name="mdp" class="btn btn-primary">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
