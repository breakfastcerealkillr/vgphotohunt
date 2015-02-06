<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Hunt</th>
            <th>Winner</th>
            </thead>
            <?php foreach ($marks as $mark): ?>
                <tr>
                    <td><?= $this->Html->link($mark->id, ['action' => 'markView', $mark->id]) ?></td>
                    <td><?= $mark->name ?></td>
                    <td><?= $this->Html->link($mark->hunt->name, ['action' => 'huntView', $mark->hunt->id]) ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $this->element('paginator') ?>