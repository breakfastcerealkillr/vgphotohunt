<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd', ['type' => 'file']) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID']) ?>
        <?= $this->Form->input('mark_id', ['options' => $marks, 'label' => 'Mark ID']) ?>
        <?= $this->Form->input('caption', ['label' => 'Caption']) ?>
        <?= $this->Form->hidden('guid') ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Picture']); ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>