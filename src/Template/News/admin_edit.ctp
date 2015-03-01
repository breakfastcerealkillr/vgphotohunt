<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $news->id ?> - <?= $news->title ?></h2>
        <?= $this->Form->create('adminEdit', ['type' => 'file']) ?>
        <?= $this->Form->input('title', ['label' => 'Title', 'default' => $news->title]) ?>
        <?= $this->Form->input('body', ['label' => 'Body', 'default' => $news->body]) ?>
        <label class="control-label"  for="date[year]">Date</label><?= $this->Form->dateTime('date', ['default' => $news->date]) ?>
        <?php if (!empty($news->pic_url)): ?>
            <?= $this->Html->image('../newspics/' . $news->pic_url . '_100.png') ?>
            <?= $this->Html->link('Delete', ['action' => 'deleteNewsPic', $news->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']) ?>
        <?php endif ?>
        <?= $this->Form->hidden('pic_url', ['default' => $news->pic_url]) ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Related Picture']); ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'news'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>