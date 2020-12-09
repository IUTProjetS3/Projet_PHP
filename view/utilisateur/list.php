<?php 
if($tab_u) : ?>
	<ul>
	<?php foreach ($tab_u as $u) : ?>
		<li>
			<a href="?controller=utilisateur&action=read&idUtilisateur=<?= rawurlencode($u->getAttr('idUtilisateur')) ?>"><?= htmlspecialchars($u->getAttr('nomUtilisateur')) ?> <?= htmlspecialchars($u->getAttr('prenomUtilisateur'))?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?> 
	<p> Aucun utilisateur trouvé </p>
<?php endif; ?>
