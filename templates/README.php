Level <?= $this->level->number ?>


<?= $this->level->description ?>


Tip: <?= $this->level->tip ?>


<?= $this->level->floor->character() ?>

  > = Stairs
<?php foreach ($this->level->floor->unique_units() as $unit): ?>
  <?= $unit->character(); ?> = <?= $unit->name(); ?> (<?= $unit->max_health() ?> HP)
<?php endforeach; ?>

Warrior Abilities:
<?php foreach ($this->level->warrior->abilities() as $name => $ability): ?>

  $warrior-><?= $name ?>();
    <?= $ability->description(); ?>
<?php endforeach; ?>


When you're done editing player.php, run the php-warrior command again.
