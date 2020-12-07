<?php 
	echo "<h2> Livres : </h2>";
	if($livres) {
		$tab_l = $livres;
		require File::build_path(['view', 'livre', 'list.php']);
	}else{
		echo '<p> Aucun livre trouvé</p>';
	}

	echo "<h2> Catégories : </h2>";
	if($categories) {
		require File::build_path(['view', 'categorie', 'list.php']);
	}else{
		echo '<p> Aucune catégorie trouvée</p>';
	}


	?>

