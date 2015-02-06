<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Name</th>
            </thead>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= $this->Html->link($game->id, ['action' => 'gameView', $game->id]) ?></td>
                    <td><?= $game->name ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $this->element('paginator') ?>