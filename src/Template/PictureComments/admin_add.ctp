<?= $this->element('adminNav') ?>
<p>It's probably easier to create a comment user-side, but this is here because.... reasons.</p>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('picture_id', ['options' => $pictures]) ?>
        <?= $this->Form->input('user_id', ['options' => $users]) ?>
        <?= $this->Form->input('comment') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>