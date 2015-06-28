<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-1">
        <h3>Hunt Information</h3>
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('name') ?>
        <?= $this->Form->input('description') ?>
        <?= $this->Form->input('game_id', ['options' => $games]) ?>
        <?= $this->Form->input('start_date', ['label' => 'Start Date', 'id' => 'start_date']) ?>
        <?= $this->Form->input('end_date', ['label' => 'End Date', 'id' => 'end_date']) ?>
        <?= $this->Form->input('voting_start_date', ['label' => 'Vote Date', 'id' => 'voting_start_date']) ?>
        <?= $this->Form->input('voting_end_date', ['label' => 'Vote End Date', 'id' => 'voting_end_date']) ?>
        <?= $this->Form->hidden('timezone', ['value' => $timezone]) ?>
    </div>
    <div class="col-md-4 col-md-offset-1">
            <h3>Marks</h3>

        <?= $this->Form->input('marks.0.name', ['label' => 'Mark 1']) ?>
        <?= $this->Form->input('marks.1.name', ['label' => 'Mark 2']) ?>
        <?= $this->Form->input('marks.2.name', ['label' => 'Mark 3']) ?>
        <?= $this->Form->input('marks.3.name', ['label' => 'Mark 4']) ?>
        <?= $this->Form->input('marks.4.name', ['label' => 'Mark 5']) ?>
        <?= $this->Form->input('marks.5.name', ['label' => 'Mark 6']) ?>
        <?= $this->Form->input('marks.6.name', ['label' => 'Mark 7']) ?>
    </div>
</div>
<div class="row">

    <div class="col-centered col-md-12">
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
    </div>