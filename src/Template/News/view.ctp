<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Game'), ['action' => 'edit', $game->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Game'), ['action' => 'delete', $game->id], ['confirm' => __('Are you sure you want to delete # {0}?', $game->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Games'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Game'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sets'), ['controller' => 'Sets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Set'), ['controller' => 'Sets', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="games view large-10 medium-9 columns">
    <h2><?= h($game->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($game->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($game->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Sets') ?></h4>
    <?php if (!empty($game->sets)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Game Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Set Start Date') ?></th>
            <th><?= __('Set End Date') ?></th>
            <th><?= __('Voting Start Date') ?></th>
            <th><?= __('Voting End Date') ?></th>
            <th><?= __('Winner User Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($game->sets as $sets): ?>
        <tr>
            <td><?= h($sets->id) ?></td>
            <td><?= h($sets->game_id) ?></td>
            <td><?= h($sets->name) ?></td>
            <td><?= h($sets->description) ?></td>
            <td><?= h($sets->set_start_date) ?></td>
            <td><?= h($sets->set_end_date) ?></td>
            <td><?= h($sets->voting_start_date) ?></td>
            <td><?= h($sets->voting_end_date) ?></td>
            <td><?= h($sets->winner_user_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Sets', 'action' => 'view', $sets->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Sets', 'action' => 'edit', $sets->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sets', 'action' => 'delete', $sets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sets->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
