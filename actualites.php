<?php

require_once __DIR__ . '/pages/header.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $news = $bdd->queryOne('SELECT * FROM news WHERE id = :id', [':id' => $_GET['id']]);
}

?>
        <h1>Actualités ASBF</h1>
        <div class="panel panel-danger">
            <div class="panel-body">
                <br />
                <?php
                if (empty($_GET['id']) || !isset($_GET['id'])):
                    header('Location: index.php');
                else:
                    $data = $bdd->query('SELECT * FROM news ORDER BY id DESC');
                    foreach ($data as $row):
                        $date = date('d/m/Y', strtotime($row->datefr));
                        ?>
                        <div>
                            <span><a href="actualites.php?id=<?= $row->id ?>"><?= $row->titre ?></a></span><span style="float:right"><?= $date ?></span>
                        </div>
                    <?php
                        if(empty($row->article)):
                            header('Location: erreur.php');
                        else:
                            $dsate = date('d/m/Y', strtotime($row->datefr));
                            ?>
                            <!-- TODO: check car wtf -->
                            <h2><b><?= $row->titre ?></b></h2>
                            <hr />
                            <div>
                                <span class="text-primary"><b><?= $row->auteur ?></b></span>
                                <span class="text-primary" style="float:right;" ><b><?= $dsate ?></b></span>
                            </div>
                            <br />
                            <?php
                            echo $row->article . '<br/>';
                        endif;
                    endforeach;
                endif ?>
                <br />
            </div>
        </div>
<?php include_once __DIR__ . '/pages/footer.php' ?>
