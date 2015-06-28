<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID', 'default' => $vote->user_id]) ?>
        <?= $this->Form->input('picture_id', ['options' => $pictures, 'label' => 'Picture ID', 'default' => $vote->picture_id]) ?>
        <?= $this->Form->input('mark_id', ['options' => $marks, 'label' => 'Mark ID', 'default' => $vote->mark_id]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'votes'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>