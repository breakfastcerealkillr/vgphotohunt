<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $award->name ?></h2>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('portrait_id', ['options' => $portraits, 'label' => 'Portrait ID', 'default' => $award->portrait_id]) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'Portrait ID', 'default' => $award->user_id]) ?>
        <label class="control-label"  for="timestamp[year]">Awarded At</label><?= $this->Form->dateTime('timestamp', ['default' => $award->timestamp]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'awards'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>