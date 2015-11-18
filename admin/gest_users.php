<?php

require_once __DIR__ . '/pages/header.php';

if (isset($_POST['sup'])) {
    $id = htmlspecialchars($_POST['id']);

    $bdd->execute('DELETE FROM users WHERE id = :id', [':id' => $id]);
}

if (isset($_POST['mdp'])) {
    $login = htmlspecialchars($_POST['login']);
    $id = htmlspecialchars($_POST['id']);
    $mail = htmlspecialchars($_POST['mail']);

    $mdp = Password::random(5);

    mail($mail, '[ASBF] Compte admin', "Changement de mot de passe. \n Utilisateur : $login\n Mot de passe : $mdp", 'FROM: contact@asbf.fr');

    $hmdp = Password::hash($mdp);

    $bdd->execute('UPDATE users SET pass = :pass WHERE id = :id', [':pass' => $hmdp, ':id' => $id]);
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
                $data = $bdd->query('SELECT * FROM users WHERE login <> \'root\'');

                foreach ($data as $row):
                ?>
                    <tr>
                        <td><?= $row->login ?></td>
                        <td><?= $row->mail ?></td>
                        <td>
                            <form class="lb" method="POST" action="">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <input type="submit" value="Suprimer" name="sup" class="btn btn-danger">
                            </form>
                            <form class="lb" method="POST" action="">
                                <input type="hidden" name="login" value="<?= $row->login ?>">
                                <input type="hidden" name="id" value="<?= $row->id ?>">
                                <input type="hidden" name="mail" value="<?= $row->mail ?>">
                                <input type="submit" value="Changer MDP" name="mdp" class="btn btn-primary">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
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
