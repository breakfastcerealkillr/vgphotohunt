<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Html->image('/pictures/' . $picture->guid . '_thumb.png') ?>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID', 'default' => $picture->user_id]) ?>
        <?= $this->Form->input('mark_id', ['options' => $marks, 'label' => 'Mark ID', 'default' => $picture->mark_id]) ?>
        <label class="control-label"  for="start_date[year]">Added</label><?= $this->Form->dateTime('timestamp', ['default' => $picture->timestamp]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>