<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $mark->name ?></h2>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('name', ['label' => 'Name', 'default' => $mark->name]) ?>
        <?= $this->Form->input('description', ['label' => 'Description', 'default' => $mark->description]) ?>
        <?= $this->Form->input('hunt_id', ['options' => $hunts, 'label' => 'Hunt ID', 'default' => $mark->hunt_id]) ?>
        <?= $this->Form->input('winner_id', ['empty' => 'None', 'options' => $users, 'label' => 'Winner', 'default' => $mark->winner_id]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'marks'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>