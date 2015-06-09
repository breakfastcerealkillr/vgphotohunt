<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'Portraits', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('name', 'Name'); ?></th>
                <th>Description</th>
                <th>Preview</th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($portraits as $portrait): ?>
                <tr>
                    <td><?= $this->Html->link($portrait->id, ['controller' => 'portraits', 'action' => 'editAdmin', $portrait->id]) ?></td>
                    <td><?= $portrait->name ?></td>
                    <td><?= $portrait->description ?></td>
                    <td><?= $this->Html->image('/portraits/' . $portrait->pic_url . '_small.png') ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Portraits', 'action' => 'adminEdit', $portrait->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Portraits', 'action' => 'adminDelete', $portrait->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>