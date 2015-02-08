<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Enabled</th>
            </thead>
            <?php foreach ($games as $game): ?>
                <tr>
                    <td><?= $this->Html->link($game->id, ['controller' => 'games', 'action' => 'editAdmin', $game->id]) ?></td>
                    <td><?= $game->name ?></td>
                    <td><?= $game->enabled ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= $this->Html->link('Add a New Game', ['controller' => 'games', 'action' => 'addAdmin'], ['class' => 'btn btn-default']) ?>
    </div>
</div>
<?= $this->element('paginator') ?>