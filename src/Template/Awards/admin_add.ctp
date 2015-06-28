<?= $this->element('adminNav') ?>
<p>Awards should be given 'organically' through the app, rather than explicitly gifted. Have at it, though.</p>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('portrait_id', ['options' => $portraits, 'label' => 'Portrait ID']) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>