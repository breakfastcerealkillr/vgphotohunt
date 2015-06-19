<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('adminAdd') ?>
        <?= $this->Form->input('type', ['options' => ['New Game' => 'New Game','Hunts and Marks' => 'Hunts and Marks','Feature' => 'Site Feature or Tweak','Misc' => 'Other']]) ?>
        <?= $this->Form->input('description', ['type' => 'textarea']) ?>
        <?= $this->Form->input('user_id', ['options' => $users, 'label' => 'User ID']) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>