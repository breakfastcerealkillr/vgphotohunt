<div class="row">
    <div class="col-md-4">
        <h2><?= $user->username ?></h2>
        <?= $this->Form->create('Users.edit', ['type' => 'file']) ?>
        <?php if (empty($user->avatar)): ?>
            <img src="/avatars/default_100.png">
        <?php else: ?>
            <img src="/avatars/<?= $user->avatar ?>_100.png">
            <?= $this->Html->link('Delete', ['action' => 'deleteAvatar'], ['class' => 'btn btn-xs btn-danger']) ?>
        <?php endif ?>
        <?= $this->Form->hidden('Users.id', ['default' => $user->id]) ?>
        <?= $this->Form->hidden('Users.avatar', ['default' => $user->avatar]) ?>
        <?= $this->Form->input('Users.file', ['type' => 'file', 'label' => 'Upload New Avatar']); ?>
        <?= $this->Form->input('Users.steam_id', ['type' => 'text', 'label' => 'Steam ID', 'default' => $user->steam_id]) ?>
        <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
        <?= $this->Html->link('Cancel', ['action' => 'view', $user->id], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>