<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('user_id', ['default' => $pictureComment->user_id]) ?>
        <?= $this->Form->input('comment', ['default' => $pictureComment->comment]) ?>
        <?= $this->Form->input('picture_id', ['options' => $pictures, 'default' => $pictureComment->picture_id]) ?>
        <?= $this->Form->input('timestamp', ['label' => 'Date Time', 'id' => 'datepicker', 'default' => $this->Time->format($pictureComment->timestamp, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>