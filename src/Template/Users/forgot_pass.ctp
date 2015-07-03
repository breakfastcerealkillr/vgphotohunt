<div class="row">
    <div class="col-md-4 col-centered">
        <h2>Reset Password</h2>
        <?= $this->Form->create('user') ?>
        <?= $this->Form->input('email') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>