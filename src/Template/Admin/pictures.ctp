<?= $this->element('adminNav') ?>
<div>
    <?= $this->Html->link('Add New', ['controller' => 'Pictures', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
</div>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?= $this->Paginator->sort('user_id', 'User'); ?></th>
            <th><?= $this->Paginator->sort('mark.hunt_id', 'Hunt'); ?> - <?= $this->Paginator->sort('mark_id', 'Mark'); ?></th>
            <th><?= $this->Paginator->sort('timestamp', 'Date'); ?></th>
            <th><?= $this->Paginator->sort('vote_count', 'Vote Count'); ?></th>
            <th>Picture</th>
            <th>Edit</th>
            <th>Delete?</th>
            </thead>
            <?php foreach ($pictures as $picture): ?>
                <tr>
                    <td><?= $this->Html->link($picture->id, ['controller' => 'pictures','action' => 'adminEdit', $picture->id]) ?></td>
                    <td><?= $this->Html->link($picture->user->username, ['action' => 'userView', $picture->user->id]) ?></td>
                    <td><?= $this->Html->link($picture->mark->hunt->name, ['action' => 'markView', $picture->mark->hunt->id]) ?> - <?= $this->Html->link($picture->mark->name, ['action' => 'markView', $picture->mark->id]) ?></td>
                    <td><?= $this->Time->format($picture->timestamp, null, null, $timezone) ?></td>
                    <td><?= $picture->vote_count ?></td>
                    <td><?= $this->Html->image('/pictures/' . $picture->guid . '_thumb.png', ['url' => ['controller' => 'pictures','action' => 'adminEdit', $picture->id], 'class' => '', 'title' => $picture->caption]) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Pictures', 'action' => 'adminEdit', $picture->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Pictures', 'action' => 'adminDelete', $picture->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>