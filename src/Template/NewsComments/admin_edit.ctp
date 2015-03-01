<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('news_id', ['options' => $news, 'default' => $newscomment->news_id]) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'default' => $newscomment->user_id]) ?>
        <?= $this->Form->input('comment', ['default' => $newscomment->comment]) ?>
        <label class="control-label"  for="timestamp[year]">Timestamp</label><?= $this->Form->dateTime('timestamp', ['default' => $newscomment->timestamp]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'newscomments'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>