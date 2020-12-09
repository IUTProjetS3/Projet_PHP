<?php
if($tab_c){

        foreach ($tab_c as $p) :?>
            <p>Commande n°<?= htmlspecialchars($p[0]) ?>: <?=htmlspecialchars($p[2])?>€</p>
        <?php foreach ($p[1] as $l) :
                $livre = Livre::select($l[0])
                ?>
            <p><?= htmlspecialchars($livre->getAttr('nom')) ?>: x<?= htmlspecialchars($l[1]) ?></p>
<?php endforeach;
        endforeach;
    
}
else {
    echo "Aucune Commande";
}

?>