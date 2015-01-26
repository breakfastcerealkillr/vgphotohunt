<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('user') ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>