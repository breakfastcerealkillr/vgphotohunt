<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'Awards', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User ID'); ?></th>
                <th><?= $this->Paginator->sort('portrait_id', 'Portrait ID'); ?></th>
                <th><?= $this->Paginator->sort('timestamp', 'Date Achieved'); ?></th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($awards as $award): ?>
                <tr>
                    <td><?= $this->Html->link($award->id, ['controller' => 'Awards', 'action' => 'adminEdit', $award->id]) ?></td>
                    <td><?= $award->user->username ?></td>
                    <td><?= $award->portrait->name ?></td>
                    <td><?= $this->Time->format($award->timestamp, 'M/d/Y', 'Undefined', $timezone) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Awards', 'action' => 'adminEdit', $award->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Awards', 'action' => 'adminDelete', $award->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>