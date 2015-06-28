<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $game->name ?></h2>
        <?php if ($game->pic_url != 'default') : ?>
        <?= $this->Html->image('/gamepics/' . $game->pic_url . '_100.png'); ?><br />
        <?= $this->Html->link('Delete', ['action' => 'deleteGamePic', $game->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']) ?>
        <?php else  : ?>
        <?= $this->Html->image('/gamepics/default_100.png'); ?>
        <?php endif; ?>
        <?= $this->Form->create('adminEdit', ['type' => 'file']) ?>
        <?= $this->Form->input('name', ['label' => 'Name', 'default' => $game->name]) ?>
        <?= $this->Form->input('short_name', ['label' => 'Short Name', 'default' => $game->short_name]) ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Game Picture']); ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'games'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>