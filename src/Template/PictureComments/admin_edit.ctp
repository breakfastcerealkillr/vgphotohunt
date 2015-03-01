<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('user_id', ['default' => $pictureComment->user_id]) ?>
        <?= $this->Form->input('comment', ['default' => $pictureComment->comment]) ?>
        <?= $this->Form->input('picture_id', ['options' => $pictures, 'default' => $pictureComment->picture_id]) ?>
        <label class="control-label"  for="timestamp[year]">Comment Timestamp</label><?= $this->Form->dateTime('timestamp', ['default' => $pictureComment->timestamp]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>