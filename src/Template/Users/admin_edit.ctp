<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-4">
        <h2><?= $user->username ?></h2>
        <?= $this->Form->create('Users.adminEdit', ['type' => 'file']) ?>
        <?php if (empty($user->avatar)): ?>
            <?= $this->Html->image('/avatars/default_100.png') ?>
        <?php else: ?>
            <?= $this->Html->image('/avatars/'. $user->avatar .'_100.png') ?><br />
            <?= $this->Html->link('Delete', ['action' => 'deleteAvatar'], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']) ?>
        <?php endif ?>
        <?= $this->Form->hidden('Users.id', ['default' => $user->id]) ?>
        <?= $this->Form->hidden('Users.avatar', ['default' => $user->avatar]) ?>
        <?= $this->Form->input('Users.file', ['type' => 'file', 'label' => 'Upload New Avatar']); ?>
        <?= $this->Form->input('Users.enabled', ['type' => 'checkbox', 'label' => 'Enabled?', 'default' => $user->enabled]) ?>
        <?= $this->Form->input('Users.username', ['type' => 'text', 'label' => 'User Name', 'default' => $user->username]) ?>
        <?= $this->Form->input('Users.password', ['label' => 'Password']) ?>
        <?= $this->Form->input('Users.email', ['type' => 'text', 'label' => 'Email', 'default' => $user->email]) ?>
        <?= $this->Form->input('Users.xp', ['label' => 'XP', 'default' => $user->xp]) ?>
        <?= $this->Form->input('Users.level', ['label' => 'Level', 'default' => $user->level]) ?>
        <?= $this->Form->input('Users.next_level', ['type' => 'text', 'label' => 'XP to Next Level', 'default' => $user->next_level]) ?>
        <?= $this->Form->input('Users.current_portrait', ['label' => 'Current Portrait', 'default' => $user->current_portrait]) ?>
        <?= $this->Form->input('Users.steam_id', ['type' => 'text', 'label' => 'Steam ID', 'default' => $user->steam_id]) ?>
        <?= $this->Form->input('Users.timezone', ['options' => Cake\I18n\Time::listTimezones(), 'default' => $user->timezone]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['controller' => 'Admin', 'action' => 'users'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>