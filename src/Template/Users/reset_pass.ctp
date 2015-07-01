<div class="row">
    <div class="col-md-4">
        <h2>Reset your password</h2>
        <?= $this->Form->create('Users.resetPass') ?>
        <?= $this->Form->hidden('Users.id', ['default' => $user->id]) ?>
        <?= $this->Form->input('Users.password') ?>
        <?= $this->Form->input('Users.password_confirm', ['type' => 'password']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>