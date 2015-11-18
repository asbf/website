<?php

require_once __DIR__ . '/pages/header.php';

$ok = NULL;
$error = NULL;

if (isset($_POST['nu'])) {

    $mail = htmlspecialchars($_POST['mail']);
    $login = htmlspecialchars($_POST['login']);
    $rank = htmlspecialchars($_POST['rank']);

    $mdp = Password::random(10);
    $hmdp = Password::hash($mdp);

    $data = $bdd->query('SELECT * FROM users WHERE login = :login OR mail = :mail', [':login' => $login, ':mail' => $mail]);

    if(empty($data)) {
        $bdd->execute('INSERT INTO users (login, mail, pass, rank) VALUES(:login, :mail, :pass, :rank)', [':login' => $login, ':mail' => $mail, ':pass' => $hmdp, ':rank' => $rank]);
        mail($mail, '[ASBF] Compte admin', "Utilisateur : $login\n Mot de passe : $mdp", 'FROM: contact@asbf.fr');
        $ok = 'Ok !';
    } else {
        $error = 'Nom d\'utilisateur ou mail déjà pris';
    }
}

?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            New
                            <small>User</small>
                        </h1>
                    </div>
                    <?php
                    if ($user->rank != 1):
                        echo "<h1>CETTE PAGE VOUS EST INTERDITE</h1> <a href='index.php'>retour index</a>";
                    else:
                    ?>
                    <span style="color:green;"><?= $ok ?></span><span style="color:red;"><?= $error ?></span>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Mail</label>
                            <input type="email" name="mail" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="login" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label>Rank</label>
                            <select class="form-control" name="rank">
                                <?php
                                $data = $bdd->query('SELECT * FROM rank ORDER BY id DESC');

                                foreach ($data as $row):
                                ?>
                                <option value="<?= $row->id ?>"><?= $row->rank ?></option>

                                <?php endforeach ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success" name="nu" value="Nouveau Utilisateur" />
                    </form>
                </div>
            </div>
        </div>
<?php endif ?>
