<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'PictureComments', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?= $this->Paginator->sort('user_id', 'User ID'); ?></th>
            <th><?= $this->Paginator->sort('picture_id', 'Picture ID'); ?></th>
            <th>Comment</th>
            <th><?= $this->Paginator->sort('timestamp', 'Timestamp'); ?></th>
            <th>Edit</th>
            <th>Delete?</th>
            </thead>
            <?php foreach ($picturecomments as $pictureComment): ?>
                <tr>
                    <td><?= $this->Html->link($pictureComment->id, ['controller' => 'pictureComments','action' => 'editAdmin', $pictureComment->id]) ?></td>
                    <td><?= $this->Html->link($pictureComment->user->username, ['action' => 'userView', $pictureComment->user->id]) ?></td>
                    <td><?= $this->Html->image('/pictures/' . $pictureComment->picture->guid . '_thumb.png', ['url' => ['controller' => 'pictures','action' => 'editAdmin', $pictureComment->picture_id]]) ?></td>
                    <td><?= $pictureComment->comment ?></td>
                    <td><?= $this->Time->format($pictureComment->timestamp, null, null, $timezone) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'PictureComments', 'action' => 'adminEdit', $pictureComment->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'PictureComments', 'action' => 'adminDelete', $pictureComment->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>