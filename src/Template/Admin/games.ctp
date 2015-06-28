<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'Games', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('name', 'Name'); ?></th>
                <th><?= $this->Paginator->sort('short_name', 'Short Name'); ?></th>
                <th>Picture</th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= $this->Html->link($game->id, ['controller' => 'Games', 'action' => 'view', $game->id]) ?></td>
                    <td><?= $game->name ?></td>
                    <td><?= $game->short_name ?></td>
                    <td><?= $this->Html->image('/gamepics/' . $game->pic_url . '_60.png'); ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Games', 'action' => 'adminEdit', $game->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Games', 'action' => 'adminDelete', $game->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>