<?php 

if($categories) : ?>
	<ul>
	<?php foreach ($categories as $c) : ?>
		<li>
			<a href="?controller=livre&action=readAllFromCat&idCategorie=<?= rawurlencode($c->getAttr('idCategorie')) ?>"><?= $c->getAttr('nom') ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
<?php else : ?> 
	<p> Aucune catégorie trouvée </p>
<?php endif; ?>
