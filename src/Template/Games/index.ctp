<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Game'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sets'), ['controller' => 'Sets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Set'), ['controller' => 'Sets', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="games index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($games as $game): ?>
        <tr>
            <td><?= $this->Number->format($game->id) ?></td>
            <td><?= h($game->name) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $game->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $game->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $game->id], ['confirm' => __('Are you sure you want to delete # {0}?', $game->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
