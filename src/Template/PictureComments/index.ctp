<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Picture Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pictures'), ['controller' => 'Pictures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture'), ['controller' => 'Pictures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="pictureComments index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('picture_id') ?></th>
            <th><?= $this->Paginator->sort('user_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($pictureComments as $pictureComment): ?>
        <tr>
            <td><?= $this->Number->format($pictureComment->id) ?></td>
            <td>
                <?= $pictureComment->has('picture') ? $this->Html->link($pictureComment->picture->id, ['controller' => 'Pictures', 'action' => 'view', $pictureComment->picture->id]) : '' ?>
            </td>
            <td>
                <?= $pictureComment->has('user') ? $this->Html->link($pictureComment->user->id, ['controller' => 'Users', 'action' => 'view', $pictureComment->user->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $pictureComment->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pictureComment->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pictureComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pictureComment->id)]) ?>
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
