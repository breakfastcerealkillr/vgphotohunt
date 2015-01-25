<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pictureComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pictureComment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Picture Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pictures'), ['controller' => 'Pictures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture'), ['controller' => 'Pictures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="pictureComments form large-10 medium-9 columns">
    <?= $this->Form->create($pictureComment); ?>
    <fieldset>
        <legend><?= __('Edit Picture Comment') ?></legend>
        <?php
            echo $this->Form->input('picture_id', ['options' => $pictures]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
