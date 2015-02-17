<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $game->name ?></h2>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('name', ['label' => 'Name', 'default' => $game->name]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'games'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>