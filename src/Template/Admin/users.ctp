<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Enabled</th>
            <th>Last Login</th>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Html->link($user->id, ['action' => 'userView', $user->id]) ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->enabled ?></td>
                    <td><?= $this->Time->format($user->last_login, 'M/d/Y', 'Never Logged In', $timezone) ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $this->element('paginator') ?>