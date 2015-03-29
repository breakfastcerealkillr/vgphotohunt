<?= $this->element('adminNav') ?>
<div>
    <?= $this->Html->link('Add New', ['controller' => 'Marks', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
</div>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?= $this->Paginator->sort('hunt.game_id', 'Game'); ?> - <?= $this->Paginator->sort('hunt_id', 'Hunt'); ?></th>
            <th><?= $this->Paginator->sort('name', 'Name'); ?></th>
            <th><?= $this->Paginator->sort('winner_id', 'Winner'); ?></th>
            <th>Edit</th>
            <th>Delete?</th>
            </thead>
            <?php foreach ($marks as $mark): ?>
                <tr>
                    <td><?= $this->Html->link($mark->id, ['controller' => 'Marks', 'action' => 'view', $mark->id]) ?></td>
                    <td><?= $this->Html->link($mark->hunt->game->name, ['controller' => 'Games', 'action' => 'view', $mark->hunt->game->id]) ?> - <?= $this->Html->link($mark->hunt->name, ['controller' => 'Hunts', 'action' => 'view', $mark->hunt->id]) ?></td>
                    <td><?= $mark->name ?></td>
                    <td><?php
                    if ($mark->winner_id){echo $mark->picture->user->username;}?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Marks', 'action' => 'adminEdit', $mark->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Marks', 'action' => 'adminDelete', $mark->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>