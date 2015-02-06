<div class="row">
    <div class="col-md-6 col-centered">
        <h2>Admin Console</h2>
        <h4>Log in or GTFO</h4>
        <p>Multiple Invalid Login Attemps to the admin console will result in an
            IP ban</p>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>