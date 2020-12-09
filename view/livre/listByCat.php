<?php 

echo "<h3>Livres de la catégorie ".htmlspecialchars($categorie->getAttr('nom')). " : </h3>";

if($tab_l){
	require File::build_path(['view', 'livre', 'list.php']);
}else{
	echo "<p>Aucun livre trouvé dans la catégorie ".htmlspecialchars($categorie->getAttr('nom')).".</p>";
}

?>