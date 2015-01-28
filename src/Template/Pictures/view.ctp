<div class="row">
    <div class="col-md-12">
        <h3><?= $this->Html->link($picture->set->name, ['controller' => 'sets', 'action' => 'view', $picture->set->id]) ?> -> Submission by <?= $this->Html->link($picture->user->username, ['controller' => 'users', 'action' => 'view', $picture->user->id]) ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?= $this->Html->image("/pictures/{$picture->guid}.png", ['class' => 'img-responsive']) ?>
        <?php if ($picture->user_id == $user_id): ?>
            <?= $this->Html->link('Delete', ['action' => 'delete', $picture->id], ['class' => 'btn btn-xs btn-danger']) ?>
        <?php endif ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Comments</h3>
        <table class="table">
            <thead>
            <th>User</th>
            <th>Comment</th>
            </thead>
            <?php foreach ($picture->picture_comments as $comment): ?>
                <tr>
                    <td>
                        <?php if (isset($comment->user->avatar)): ?>
                            <img src="/avatars/<?= $comment->user->avatar ?>_60.png">
                        <?php else: ?>
                            <img src="/avatars/default_60.png">
                        <?php endif ?>
                        <?= $comment->user->username ?>
                    </td>
                    <td>
                        <?= $comment->comment ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($loggedin): ?>
            <?= $this->Form->create('PictureComments', ['url' => ['controller' => 'pictureComments', 'action' => 'add']]) ?>
            <?= $this->Form->hidden('PictureComments.picture_id', ['value' => $picture->id]) ?>
            <?= $this->Form->hidden('PictureComments.user_id', ['value' => $user_id]) ?>
            <?= $this->Form->input('PictureComments.comment', ['type' => 'textarea', 'class' => 'form-control', 'maxlength' => '2000']) ?>
            <?= $this->Form->button('Submit') ?> 
            <?= $this->Form->end() ?>
        <?php endif ?>
    </div>
</div>