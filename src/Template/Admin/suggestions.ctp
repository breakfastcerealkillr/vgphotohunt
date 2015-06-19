<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'suggestions', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('type', 'Type'); ?></th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($suggestions as $suggestion): ?>
                <tr>
                    <td><?= $this->Html->link($suggestion->id, ['controller' => 'suggestions', 'action' => 'editAdmin', $suggestion->id]) ?></td>
                    <td><?= $suggestion->type ?></td>
                    <td><?= $suggestion->description ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'suggestions', 'action' => 'adminEdit', $suggestion->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'suggestions', 'action' => 'adminDelete', $suggestion->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>