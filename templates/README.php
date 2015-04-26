Level <?= $this->level->number ?>

<?= $this->level->description ?>

Tip: <?= $this->level->tip ?>

<?= //$this->level->floor->character() ?>

  > = Stairs
<%- for unit in $this->level->floor.unique_units -%>
  <?= unit.character ?> = <?= unit.name ?> (<?= unit.max_health ?> HP)
<%- end -?>


Warrior Abilities:
<%- $this->level->warrior.abilities.each do |name, ability| -?>

  warrior.<?= name ?>
    <?= ability.description ?>
<%- end -?>


When you're done editing player.php, run the php-warrior command again.
