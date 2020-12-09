<?php 

if(isset($_GET['idCategorie']) && $_GET['idCategorie'] >0){
	$idCategorie = $_GET['idCategorie'];
}else{
	$idCategorie = -1;
}

if($tab_l) : ?>
	<ul>
	<?php foreach ($tab_l as $l) : ?>
		<li>
			<?php if($l->getAttr('image') != "" && $l->getAttr('image') != NULL) : ?>
				<img alt="livre" width="100" src="view/img/livres/<?= htmlspecialchars($l->getAttr('image')) ?>">
			<?php endif; ?>
			<a href="?controller=livre&action=read&idLivre=<?= rawurlencode($l->getAttr('idLivre')) ?>"><?= htmlspecialchars($l->getAttr('nom')) ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?> 
	<p> Aucun livre trouvé </p>
<?php endif; ?>

<?php if(Session::is_admin() && !isset($_POST['recherche'])) : ?>
	<a href="?controller=livre&action=create&idCategorie=<?= rawurlencode($idCategorie) ?>">Ajouter un livre</a>
	<?php endif; ?>