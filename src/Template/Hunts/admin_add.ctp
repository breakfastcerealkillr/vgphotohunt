<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('description') ?>
        <?= $this->Form->input('game_id', ['options' => $games]) ?>
        <?= $this->Form->input('start_date', ['label' => 'Start Date', 'id' => 'start_date']) ?>
        <?= $this->Form->input('end_date', ['label' => 'End Date', 'id' => 'end_date']) ?>
        <?= $this->Form->input('voting_start_date', ['label' => 'Vote Date', 'id' => 'voting_start_date']) ?>
        <?= $this->Form->input('voting_end_date', ['label' => 'Vote End Date', 'id' => 'voting_end_date']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>