<div class="row">
    <div class="col-md-4">
        <h2>Login</h2>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>