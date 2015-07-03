<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'notifications', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
            <th><?= $this->Paginator->sort('user_id', 'User ID'); ?></th>
            <th><?= $this->Paginator->sort('timestamp', 'Time Stamp'); ?></th>
            <th><?= $this->Paginator->sort('is_read', $this->Html->image('unread.png'), ['escape' => false]); ?></th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete?</th>
        </thead>
            <?php foreach ($notifications as $note): ?>
                <tr>
                    <td></td>
                    <td><?= $note->user->username?></td>
                    <td><?= $this->Time->format($note->timestamp, 'M/d/Y HH:mm', 'Unknown', $timezone) ?></td>
                    <td><?php if(!$note->is_read) {echo $this->Html->image('unread.png');} ?></td>
                    <td><?= $this->Html->link($note->text, $this->Url->build('/' . $note->url, true)) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Notifications', 'action' => 'adminEdit', $note->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Notifications', 'action' => 'adminDelete', $note->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');}?>