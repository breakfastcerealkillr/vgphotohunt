<?= $this->Html->script('fancy'); ?>
<?php if (isset($list)): ?>
<div class="row">
    <h2 class="text-center">Game List</h2>
    <div class="col-md-7 col-centered">
    <?php foreach ($list as $item): ?>
        <p class="text-big"><?=$this->Html->link($item->name, ['controller' => 'Games', 'action' => 'view', $item->id ])?></p>
    <?php endforeach; ?>
    </div>

        
</div>
    
<?php else: ?>
    <h2 class="text-center"><?= $game->name ?></h2>
        <div class="row">
            <div class="col-md-4">
                <h1>Open Hunts</h1>
                <?php foreach ($openhunts as $ohunt): ?>
                    <p class="text-big"><?=$this->Html->link($ohunt->name, ['controller' => 'Hunts', 'action' => 'view', $ohunt->id ])?></p>
                    <p><?= $ohunt->start_date ?> - <?= $ohunt->end_date ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <h1>Open for Votes</h1>
                <?php foreach ($openvotes as $vhunt): ?>
                    <p class="text-big"><?=$this->Html->link($vhunt->name, ['controller' => 'Hunts', 'action' => 'view', $vhunt->id ])?></p>
                    <p class="small-text"><?= $vhunt->voting_start_date ?> - <?= $vhunt->voting_end_date ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <h1>Past Hunts</h1>
                <?php foreach ($pasthunts as $phunt): ?>
                    <p class="text-big"><?=$this->Html->link($phunt->name, ['controller' => 'Hunts', 'action' => 'view', $phunt->id ])?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Pictures from the Game</h1>
            <?php foreach ($pics as $pic): ?>
                <div class="thumb-container">
                    <div class="thumb-pic" style="background-image: url('../../pictures/<?= $pic->guid ?>_thumb.png');">
                        <a href="../../pictures/<?= $pic->guid ?>.png" class="fancybox" rel="<?= $game->name; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
<?php endif; ?>

