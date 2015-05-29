<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('hunt_id', ['options' => $hunts]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>