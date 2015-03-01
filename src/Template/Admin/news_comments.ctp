<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'newsComments', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User Name'); ?></th>
                <th><?= $this->Paginator->sort('news_id', 'Article'); ?></th>
                <th>Comment</th>
                <th><?= $this->Paginator->sort('timestamp', 'Date'); ?></th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($newscomments as $nc): ?>
                <tr>
                    <td><?= $this->Html->link($nc->id, ['controller' => 'newsComments', 'action' => 'editAdmin', $nc->id]) ?></td>
                    <td><?= $nc->user->username ?></td>
                    <td><?= $nc->news->title ?></td>
                    <td><?= $nc->comment ?></td>
                    <td><?= $this->Time->format($nc->timestamp, 'M/d/Y H:m', 'Date Not Set', $timezone) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'newsComments', 'action' => 'adminEdit', $nc->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'newsComments', 'action' => 'adminDelete', $nc->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>