<?= $this->element('adminNav') ?>
<?= $this->Html->css('jquery-ui'); ?>
<?= $this->Html->script('jquery-ui'); ?>
<?= $this->Html->script('datepicker'); ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('news_id', ['options' => $news, 'default' => $newscomment->news_id]) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'default' => $newscomment->user_id]) ?>
        <?= $this->Form->input('comment', ['default' => $newscomment->comment]) ?>
        <?= $this->Form->input('timestamp', ['label' => 'Date Time', 'id' => 'datepicker', 'default' => $this->Time->format($newscomment->timestamp, 'yyyy-MM-dd HH:mm:ss', null)]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'newscomments'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>