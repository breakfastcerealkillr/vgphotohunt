<?php if (isset($list)): ?>
    <?php foreach ($list as $item): ?>
        <h3><?=$this->Html->link($item->name, ['controller' => 'Hunts', 'action' => 'view', $item->id ])  ?></h3>
    <?php endforeach; ?>
<?php else: ?>
        <h1><?= $game->name ?></h1>
        <div>
            <?php foreach ($openhunts as $ohunt): ?>
                <h3><?= $ohunt->name ?></h3>
                <p><?= $ohunt->start_date ?> - <?= $ohunt->end_date ?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <?php foreach ($openvotes as $vhunt): ?>
                <h3><?= $vhunt->name ?></h3>
                <p><?= $vhunt->voting_start_date ?> - <?= $vhunt->voting_end_date ?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <?php foreach ($pasthunts as $phunt): ?>
                <h3><?= $phunt->name ?></h3>
            <?php endforeach; ?>
        </div>
        <div>
            <?php foreach ($pics as $pic): ?>
                <?= $this->Html->image('/pictures/' . $pic->guid . '_thumb.png') ?>
            <?php endforeach; ?>
        </div>
<?php endif; ?>

