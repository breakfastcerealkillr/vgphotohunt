<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('name', ['default' => $hunt->name]) ?>
        <?= $this->Form->input('description', ['default' => $hunt->description]) ?>
        <?= $this->Form->input('game_id', ['options' => $games, 'default' => $hunt->game_id]) ?>
        <?= $this->Form->input('start_date', ['label' => 'Start Date', 'id' => 'start_date', 'default' => $this->Time->format($hunt->start_date, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->input('end_date', ['label' => 'End Date', 'id' => 'end_date', 'default' => $this->Time->format($hunt->end_date, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->input('voting_start_date', ['label' => 'Vote Date', 'id' => 'voting_start_date', 'default' => $this->Time->format($hunt->voting_start_date, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->input('voting_end_date', ['label' => 'Vote End Date', 'id' => 'voting_end_date', 'default' => $this->Time->format($hunt->voting_end_date, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>