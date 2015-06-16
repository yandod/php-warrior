<?php __('Level'); ?> <?= $this->level->number ?>


<?= $this->level->description ?>


<?php __('Tip'); ?>: <?= $this->level->tip ?>


<?= $this->level->floor->character() ?>

  > = <?php echo __('Stairs'); ?>
<?php foreach ($this->level->floor->unique_units() as $unit): ?>
  <?= $unit->character(); ?> = <?= $unit->name(); ?> (<?= $unit->max_health() ?> HP)
<?php endforeach; ?>

<?php echo __('Warrior Abilities');?>:
<?php foreach ($this->level->warrior->abilities() as $name => $ability): ?>

  $warrior-><?= $name ?>();
    <?= $ability->description(); ?>
<?php endforeach; ?>


<?php echo __("When you're done editing player.php, run the php-warrior command again.");?>
