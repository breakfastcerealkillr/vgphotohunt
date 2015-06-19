<h2>Feedback</h2>
<p>This is the place to leave remarks or suggestions about the site. The admin will put every single suggestion on their to-do list... or else.</p>
<div class="row">
    <div class="col-md-4 col-centered">
        <?= $this->Form->create('add') ?>
        <?= $this->Form->input('type', ['options' => ['New Game' => 'New Game','Hunts and Marks' => 'Hunts and Marks','Feature' => 'Site Feature or Tweak','Misc' => 'Other']]) ?>
        <?= $this->Form->input('description', ['type' => 'textarea']) ?>
        <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>