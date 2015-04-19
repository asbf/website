<?php
require './includes/parsedown/Parsedown.php';
require './includes/parsedown-extra/ParsedownExtra.php';
$md = new ParsedownExtra();

require './includes/header.php';
require './includes/nav.php';
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">
					<?php echo $md->text(file_get_contents('README.md')); ?>
				</div>
			</div>

<?php require './includes/footer.php';
