<?= $this->element('adminNav') ?>
<div>
    <?= $this->Html->link('Add New', ['controller' => 'Hunts', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
</div>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?= $this->Paginator->sort('game_id', 'Game'); ?></th>
            <th><?= $this->Paginator->sort('name', 'Name'); ?></th>
            <th>Description</th>
            <th><?= $this->Paginator->sort('start_date', 'Start Date'); ?></th>
            <th><?= $this->Paginator->sort('end_date', 'End Date'); ?></th>
            <th><?= $this->Paginator->sort('voting_start_date', 'Voting Start Date'); ?></th>
            <th><?= $this->Paginator->sort('voting_end_date', 'Voting End Date'); ?></th>
            <th>Edit</th>
            <th>Delete?</th>
        </thead>
            <?php foreach ($hunts as $hunt): ?>
                <tr>
                    <td><?= $this->Html->link($hunt->id, ['action' => 'huntView', $hunt->id]) ?></td>
                    <td><?= $this->Html->link($hunt->game->name, ['action' => 'gameView', $hunt->game->id]) ?></td>
                    <td><?= $hunt->name ?></td>
                    <td><?= $hunt->description ?></td>
                    <td><?= $this->Time->format($hunt->start_date, 'M/d/Y', 'Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->end_date, 'M/d/Y', 'End Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->voting_start_date, 'M/d/Y', 'Voting Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->voting_end_date, 'M/d/Y', 'Voting End Date Not Set', $timezone) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Hunts', 'action' => 'adminEdit', $hunt->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Hunts', 'action' => 'adminDelete', $hunt->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
if ($this->Paginator->counter('{{count}}') > $pageLimit) {
    echo $this->element('paginator');}
?>