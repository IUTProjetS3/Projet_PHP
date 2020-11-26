<?php 

if($tab_l) : ?>
	<ul>
	<?php foreach ($tab_l as $l) : ?>
		<li><a href="?controller=livre&action=read&idLivre=<?= rawurlencode($l->getAttr('idLivre')) ?>"><?= $l->getAttr('nom') ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?>
	<p> Aucun livre trouvé </p>
<?php endif; ?>

<?php if(isset($_SESSION['projet_user_connected']) && $_SESSION['projet_user_connected']->getAttr('role') == "admin") : ?>
	<a href="?controller=livre&action=create">Ajouter un livre</a>
	<?php endif; ?>