<?= $this->element('adminNav') ?>
<p>This kinda completely betrays the logic of the website, so if you need to use it, chances are there's something wrong....</p>
<?= $this->Html->link('Add New', ['controller' => 'Votes', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('user_id', 'User ID'); ?></th>
                <th><?= $this->Paginator->sort('picture_id', 'Picture ID'); ?></th>
                <th><?= $this->Paginator->sort('mark_id', 'Mark ID'); ?></th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($votes as $vote): ?>
                <tr>
                    <td><?= $this->Html->link($vote->id, ['controller' => 'votes', 'action' => 'adminEdit', $vote->id]) ?></td>
                    <td><?= $vote->user->username ?></td>
                    <td><?= $this->Html->image('/pictures/' . $vote->picture->guid . '_thumb.png'); ?> </td>
                    <td><?= $vote->mark->name ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Votes', 'action' => 'adminEdit', $vote->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Votes', 'action' => 'adminDelete', $vote->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>