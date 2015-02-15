<?= $this->element('adminNav') ?>
<div>
    <?= $this->Html->link('Add New', ['controller' => 'Users', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
    <?php
    if (isset($this->request->query['status'])) {
        if ($this->request->query['status'] === 'enabled') {
            echo $this->Html->link('Show Disabled', ['action' => 'users', 'status' => 'disabled'], ['class' => 'btn btn-xs btn-warning']);
        } else {
            echo $this->Html->link('Show Enabled', ['action' => 'users', 'status' => 'enabled'], ['class' => 'btn btn-xs btn-warning']);
        }
    } else {
        echo $this->Html->link('Show Disabled', ['action' => 'users', 'status' => 'disabled'], ['class' => 'btn btn-xs btn-warning']);
    }
    ?>
</div>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Enabled</th>
            <th>Last Login</th>
            <th>Join Date</th>
            <th>Edit</th>
            <th>Delete?</th>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Html->link($user->id, ['controller' => 'Users', 'action' => 'View', $user->id]) ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->enabled ?></td>
                    <td><?= $this->Time->format($user->last_login, 'M/d/Y', 'Never Logged In', $timezone) ?></td>
                    <td><?= $this->Time->format($user->join_date, 'M/d/Y', 'Not Available', $timezone) ?></td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'Users', 'action' => 'adminEdit', $user->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'Users', 'action' => 'adminDelete', $user->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php
if ($this->Paginator->counter('{{count}}') > 9) {
    echo $this->element('paginator');
}
?>
