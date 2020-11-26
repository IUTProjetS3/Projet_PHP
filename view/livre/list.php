<?php 
var_dump($tab_l);
if($tab_l) : ?>
	<ul>
	<?php foreach ($tab_l) : ?>
		<li><a href="?controller=livre&action=read&idLivre=<?= $tab_l->getAttr('idLivre') ?>"><?= $tab_l->getAttr('nom') ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?>
	<p> Aucun livre trouvé </p>
<?php endif; ?>