<?php 

if($tab_c) : ?>
	<ul>
	<?php foreach ($tab_c as $c) : ?>
		<li>
			<a href="?controller=commande&action=read&idCommande=<?= rawurlencode($c->getAttr('idCommande')) ?>">Commande n°<?= $c->getAttr('idCommande') ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?> 
	<p> Aucun livre trouvé </p>
<?php endif; ?>