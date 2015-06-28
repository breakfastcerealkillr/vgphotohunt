<?= $this->element('adminNav') ?>
<p>Why would one need to edit a suggestion? </p>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminEdit') ?>
        <?= $this->Form->input('type', ['options' => ['New Game' => 'New Game','Hunts and Marks' => 'Hunts and Marks','Feature' => 'Site Feature or Tweak','Misc' => 'Other'], 'default' => $suggestion->type]) ?>
        <?= $this->Form->input('description', ['type' => 'textarea', 'default' => $suggestion->description]) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID', 'default' => $suggestion->user_id]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>