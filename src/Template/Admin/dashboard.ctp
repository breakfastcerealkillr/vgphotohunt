<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h3>Stats</h3>
        <ul>
            <li><?= $totalusers ?> Total Users</li>
            <li><?= $totalpics ?> Total Submissions</li>
            <li><?= $totalgames ?> Games, <?= $totalhunts ?> Hunts, <?= $totalmarks ?> Marks</li>
            <li><?= $totalvotes ?> Total Votes</li>
            <li><?= $totalcomments ?> Total Comments</li>
        </ul>
    </div>
    <div class="col-md-4">
        <h3>Top 5 Users</h3>
        <ul>
            <?php foreach($topfive as $user): ?>
            <li><b><?= $user->username ?></b> - <?= $user->level ?> <sup><?= $user->xp ?></sup></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-4">
        <h3>Toolbox</h3>
        <p><?= $unresolved ?> Unresolved Marks</p>
        <?= $this->Html->link('Resolve Marks!', ['controller' => 'Marks', 'action' => 'resolveMarks'], ['class' => 'btn btn-warning']) ?>
    </div>
</div>