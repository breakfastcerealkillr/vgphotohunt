<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Picture'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sets'), ['controller' => 'Sets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Set'), ['controller' => 'Sets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Picture Comments'), ['controller' => 'PictureComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture Comment'), ['controller' => 'PictureComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Upvotes'), ['controller' => 'Upvotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Upvote'), ['controller' => 'Upvotes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="pictures index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th><?= $this->Paginator->sort('set_id') ?></th>
            <th><?= $this->Paginator->sort('guid') ?></th>
            <th><?= $this->Paginator->sort('date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($pictures as $picture): ?>
        <tr>
            <td><?= $this->Number->format($picture->id) ?></td>
            <td>
                <?= $picture->has('user') ? $this->Html->link($picture->user->id, ['controller' => 'Users', 'action' => 'view', $picture->user->id]) : '' ?>
            </td>
            <td>
                <?= $picture->has('set') ? $this->Html->link($picture->set->name, ['controller' => 'Sets', 'action' => 'view', $picture->set->id]) : '' ?>
            </td>
            <td><?= h($picture->guid) ?></td>
            <td><?= h($picture->date) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $picture->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $picture->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $picture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $picture->id)]) ?>
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
