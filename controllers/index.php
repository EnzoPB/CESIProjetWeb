<pre>
est connecté: <?php var_dump($session->estConnecte); ?>
utilisateur: <?php var_dump($session->utilisateur); ?>
type compte: <?php var_dump($session->typeCompte); ?>
<?php if ($session->typeCompte == 'eleve'): ?>
promo: <?php var_dump($session->utilisateur->getPromotion()); ?>
competences: <?php var_dump($session->utilisateur->getCompetences()); ?>
<?php endif; ?>
</pre>