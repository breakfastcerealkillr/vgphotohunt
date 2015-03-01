<?= $this->element('adminNav') ?>

<div class="row">
    <div class="col-md-4">
        <?php if (!empty($portrait->pic_url)): ?>
        <?= $this->Html->image('/portraits/' . $portrait->pic_url . '_100.png') ?>
            <?= $this->Html->link('Delete', ['action' => 'deletePortraitPic', $portrait->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']) ?>
        <?php endif ?>
        <?= $this->Form->create('adminEdit', ['type' => 'file']) ?>
        <?= $this->Form->input('name', ['label' => 'Name', 'default' => $portrait->name]) ?>
        <?= $this->Form->input('description', ['label' => 'Name', 'default' => $portrait->description]) ?>
        <?= $this->Form->hidden('pic_url', ['default' => $portrait->pic_url]) ?>
        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Picture']); ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'games'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>