<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>User</th>
            <th>Mark</th>
            <th>Date</th>
            <th>Picture</th>
            </thead>
            <?php foreach ($pictures as $picture): ?>
                <tr>
                    <td><?= $this->Html->link($picture->id, ['controller' => 'pictures','action' => 'editAdmin', $picture->id]) ?></td>
                    <td><?= $this->Html->link($picture->user->username, ['action' => 'userView', $picture->user->id]) ?></td>
                    <td><?= $this->Html->link($picture->mark->name, ['action' => 'markView', $picture->mark->id]) ?></td>
                    <td><?= $this->Time->format($picture->date, null, null, $timezone) ?></td>
                    <td><?= $this->Html->image('/pictures/' . $picture->guid . '_thumb.png', ['url' => ['controller' => 'pictures','action' => 'editAdmin', $picture->id]]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $this->element('paginator') ?>