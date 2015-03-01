<?= $this->element('adminNav') ?>
<p>This will be used to create the DB objects and picture files for the portraits. Keep in mind that the logic for each portrait will be handled somewhere else.</p>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd', ['type' => 'file']) ?>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('description') ?>
        <?= $this->Form->hidden('pic_url') ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Picture']); ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>