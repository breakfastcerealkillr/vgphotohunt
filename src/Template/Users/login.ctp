<div class="row">
    <div class="col-md-4 col-md-offset-1">
        <h2>Login</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create('user', ['action' => 'login']) ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
        <div class="col-md-4 col-md-offset-2">
        <h2>Register</h2>
        <?= $this->Form->create('user', ['action' => 'register']) ?>
        <?= $this->Form->input('username', ['autocomplete' => 'off']) ?>
        <?= $this->Form->input('email', ['autocomplete' => 'off']) ?>
        <?= $this->Form->input('password', ['autocomplete' => 'off']) ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password', 'autocomplete' => 'off']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>