<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID']) ?>
        <?= $this->Form->input('text', ['type' => 'textarea']) ?>
        <?= $this->Form->input('url', ['label' => 'URL -- Assumes Base URL (e.g. https://vgphotohunt.com)']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>