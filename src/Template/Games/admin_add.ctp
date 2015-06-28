<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd', ['type' => 'file']) ?>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('short_name', ['label' => 'Short Name (For Badge Labels)']) ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Game Picture']); ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>