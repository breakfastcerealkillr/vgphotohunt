<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Picture'), ['action' => 'edit', $picture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Picture'), ['action' => 'delete', $picture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $picture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pictures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture'), ['action' => 'add']) ?> </li>
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
<div class="pictures view large-10 medium-9 columns">
    <h2><?= h($picture->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $picture->has('user') ? $this->Html->link($picture->user->id, ['controller' => 'Users', 'action' => 'view', $picture->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Set') ?></h6>
            <p><?= $picture->has('set') ? $this->Html->link($picture->set->name, ['controller' => 'Sets', 'action' => 'view', $picture->set->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Guid') ?></h6>
            <p><?= h($picture->guid) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($picture->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?= h($picture->date) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related PictureComments') ?></h4>
    <?php if (!empty($picture->picture_comments)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Picture Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Comment') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($picture->picture_comments as $pictureComments): ?>
        <tr>
            <td><?= h($pictureComments->id) ?></td>
            <td><?= h($pictureComments->picture_id) ?></td>
            <td><?= h($pictureComments->user_id) ?></td>
            <td><?= h($pictureComments->comment) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'PictureComments', 'action' => 'view', $pictureComments->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'PictureComments', 'action' => 'edit', $pictureComments->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'PictureComments', 'action' => 'delete', $pictureComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pictureComments->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Upvotes') ?></h4>
    <?php if (!empty($picture->upvotes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Set Id') ?></th>
            <th><?= __('Picture Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($picture->upvotes as $upvotes): ?>
        <tr>
            <td><?= h($upvotes->id) ?></td>
            <td><?= h($upvotes->user_id) ?></td>
            <td><?= h($upvotes->set_id) ?></td>
            <td><?= h($upvotes->picture_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Upvotes', 'action' => 'view', $upvotes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Upvotes', 'action' => 'edit', $upvotes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Upvotes', 'action' => 'delete', $upvotes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $upvotes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
