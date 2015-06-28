<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $award->name ?></h2>
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('portrait_id', ['options' => $portraits, 'label' => 'Portrait ID', 'default' => $award->portrait_id]) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'Portrait ID', 'default' => $award->user_id]) ?>
        <?= $this->Form->input('timestamp', ['label' => 'Date Time', 'id' => 'datepicker', 'default' => $this->Time->format($award->timestamp, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'awards'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>