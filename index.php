<?php include 'pages/header.php'; ?>
        <div class="col-lg-3">
            <div class="panel panel-primary">
                <ul class="nav">
                    <br />
                    <center>
                        <span><a href="https://twitter.com/asbf_fr" target="_blank"><i class="fa fa-twitter-square fa-3x">&nbsp;&nbsp;</i></a></span>
                        <span><a href="https://www.facebook.com/ASBF.FR" target="_blank"><i class="fa fa-facebook-square fa-3x">&nbsp;&nbsp;</i></a></span>
                        <span><a href="https://plus.google.com/115060737872961442885/about" target="_blank"><i class="fa fa-google-plus-square fa-3x">&nbsp;&nbsp;</i></a></span>
                        <span><a href="https://github.com/asbf/" target="_blank"><i class="fa fa-github-square fa-3x"></i></a></span>
                    </center>
                    <br />
                    <li><a href="actualites.php"><i class="fa fa-comments"></i> Actualités</a></li>
                    <li><a href="contact.php"><i class="fa fa-envelope-o"></i> Contact</a></li>
                    <li><a href="http://wiki.asbf.fr/wiki/asbf/agenda"><i class="fa fa-calendar"></i> Agenda</a></li>
                </ul>
                <br />
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-users"></i><b>&nbsp;> Espace membres</b></div>
                <ul class="nav">
                    <br />
                    <li><a href="http://pad.asbf.fr/"><i class="fa fa-sticky-note"></i> Pad</a></li>
                    <li><a href="http://wiki.asbf.fr/"><i class="fa fa-book"></i> Wiki</a></li>
                    <li><a href="https://app.azendoo.com/"><i class="fa fa-tasks"></i> Tâches</a></li>
                    <li><a href="http://mail.asbf.fr/"><i class="fa fa-paper-plane"></i> Serveur mail</a></li>
                </ul>
                <br />
            </div>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-info"></i><strong>&nbsp;> Accueil</strong></h3>
                </div>
                <div class="panel-body">
                    <div align="justify">
                        <strong>Actions Solidaires Brony Francophone</strong> est une association dont l'objectif est la <b>création</b> de rencontres et d'actions dans le but de <b>sensibiliser</b> le public à des associations caritatives et de <b>promouvoir</b> leurs actions. Son ambition est d’apporter une <b>aide humaine aux autres</b>, ainsi que d’aider à la prise de conscience de chacun envers ces actions par la diffusion d’informations.<br><br>Son nom a pour origine la communauté <abbr title="Fans modernes de My Little Pony">brony</abbr>. Cette association s’inspire de <a href="http://broniesforgood.org" target="_blank">Bronies for Good</a>. L’association est partenaire avec nous depuis sa création, avec pour objectif des actions <b>humanitaires internationales</b>.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-comments"></i><strong>&nbsp;> Dernières actualités</strong></h3>
                </div>
                <div class="panel-body">
                <?php
                $sa = $bdd->query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 0,5");
                while($dsa=$sa->fetch()) {
                    $date = date("d/m/Y", strtotime($dsa['datefr']));
                ?>
                    <div>
                        <span><a href="actualites.php?id=<?php echo $dsa['id']; ?>"><?php echo $dsa['titre'] ?></a></span><span style="float:right"><?php echo $date; ?></span>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
<?php include("pages/footer.php"); ?>
