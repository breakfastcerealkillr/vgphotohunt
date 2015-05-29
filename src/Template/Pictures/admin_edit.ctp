<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Html->image('/pictures/' . $picture->guid . '_thumb.png') ?>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID', 'default' => $picture->user_id]) ?>
        <?= $this->Form->input('mark_id', ['options' => $marks, 'label' => 'Mark ID', 'default' => $picture->mark_id]) ?>
        <?= $this->Form->input('caption', ['label' => 'Caption', 'default' => $picture->caption]) ?>
        <?= $this->Form->input('timestamp', ['label' => 'Date Time', 'id' => 'datepicker', 'default' => $this->Time->format($picture->timestamp, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>