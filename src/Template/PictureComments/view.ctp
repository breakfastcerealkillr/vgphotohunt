<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Picture Comment'), ['action' => 'edit', $pictureComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Picture Comment'), ['action' => 'delete', $pictureComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pictureComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Picture Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pictures'), ['controller' => 'Pictures', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Picture'), ['controller' => 'Pictures', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="pictureComments view large-10 medium-9 columns">
    <h2><?= h($pictureComment->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Picture') ?></h6>
            <p><?= $pictureComment->has('picture') ? $this->Html->link($pictureComment->picture->id, ['controller' => 'Pictures', 'action' => 'view', $pictureComment->picture->id]) : '' ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $pictureComment->has('user') ? $this->Html->link($pictureComment->user->id, ['controller' => 'Users', 'action' => 'view', $pictureComment->user->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($pictureComment->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Comment') ?></h6>
            <?= $this->Text->autoParagraph(h($pictureComment->comment)); ?>

        </div>
    </div>
</div>
