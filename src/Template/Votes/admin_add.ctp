<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID']) ?>
        <?= $this->Form->input('picture_id', ['options' => $pictures, 'label' => 'Picture ID']) ?>
        <?= $this->Form->input('mark_id', ['options' => $marks, 'label' => 'Mark ID']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>