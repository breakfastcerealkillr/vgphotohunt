<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Pictures'), ['action' => 'index']) ?></li>
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
<div class="pictures form large-10 medium-9 columns">
    <?= $this->Form->create($picture); ?>
    <fieldset>
        <legend><?= __('Add Picture') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('set_id', ['options' => $sets]);
            echo $this->Form->input('guid');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
