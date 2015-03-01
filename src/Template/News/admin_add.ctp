<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd', ['type' => 'file']) ?>
        <?= $this->Form->input('title') ?>
        <?= $this->Form->input('body') ?>
        <?= $this->Form->hidden('pic_url') ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Related Picture']); ?>
        <?= $this->Form->hidden('user_id', ['default' => $author]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>