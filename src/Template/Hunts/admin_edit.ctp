<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('name', ['default' => $hunt->name]) ?>
        <?= $this->Form->input('description', ['default' => $hunt->description]) ?>
        <?= $this->Form->input('game_id', ['options' => $games, 'default' => $hunt->game_id]) ?>
        <label class="control-label"  for="start_date[year]">Start Date</label><?= $this->Form->dateTime('start_date', ['default' => $hunt->start_date]) ?>
        <label class="control-label"  for="end_date[year]">End Date</label><?= $this->Form->dateTime('end_date', ['default' => $hunt->end_date]) ?>
        <label class="control-label"  for="voting_start_date[year]">Voting Start Date</label><?= $this->Form->dateTime('voting_start_date', ['default' => $hunt->voting_start_date]) ?>
        <label class="control-label"  for="voting_end_date[year]">Voting End Date</label><?= $this->Form->dateTime('voting_end_date', ['default' => $hunt->voting_end_date]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>