<?php if(isset($hunt)):?>
    <?php if($status === 'vote'):?>
        <h1><?= $hunt->name ?> -- Open For Voting</h1>
        <ul>
            <?php foreach($marks as $mark): ?>
                <li><?= $mark->name ?><br />
                    <?php foreach($mark['Pictures'] as $mpic): ?>
                    <div style="float: left">
                        <?= $this->Html->image('pictures/'. $mpic->guid . '_thumb.png'); ?> <br />
                        <?= $mpic->user->username ; ?>
                    </div>
                    <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif($status === 'open'): ?>
        <h1><?= $hunt->name ?> -- Open For Submission</h1>
        <ul>
            <?php foreach($marks as $mark): ?>
                 <li><?= $mark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h1><?= $hunt->name ?> -- Archived</h1>
        <ul>
            <?php foreach($marks as $mark): ?>
                 <li><?= $mark->name ?></li>
            <?php endforeach; ?>
        </ul>
<?php endif; ?>
        
<?php // VIEW LISTS. WOULD ALSO BE GOOD INDEX.CTP CODE ?>
        
<?php else: ?>
    <?php foreach($openhunts as $ohunt): ?>
        <?= $ohunt->game->name ?> - <?= $ohunt->name ?>
        <ul>
            <?php foreach($ohunt['marks'] as $omark): ?>
            <li><?= $omark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <hr />
    <?php foreach($openvotes as $ovote): ?>
        <?= $ovote->game->name ?> - <?= $ovote->name ?>
        <ul>
            <?php foreach($ovote['marks'] as $ovmark): ?>
            <li><?= $ovmark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    <hr />
    <?php foreach($pasthunts as $pasthunt): ?>
        <?= $pasthunt->game->name ?> - <?= $pasthunt->name ?>
        <ul>
            <?php foreach($pasthunt['marks'] as $pmark): ?>
            <li><?= $pmark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>

<?php endif; ?>
