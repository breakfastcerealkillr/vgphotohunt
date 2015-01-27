<div class="row">
    <div class="col-md-12">
        <h2><?= $picture->set->name ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <?php //debug($picture) ?>
        <?= $this->Html->image("/pictures/{$picture->guid}.png", ['class' => 'img-responsive']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Comments</h3>
        <table class="table">
            <?php foreach ($picture->picture_comments as $comment): ?>
                <tr>
                <td>
                    
                </td>
                <td>
                    <?= $comment->comment ?>
                </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= $this->Form->create('PictureComments', ['url' => ['controller' => 'pictureComments', 'action' => 'add']]) ?>
        <?= $this->Form->hidden('PictureComments.picture_id', ['value' => $picture->id]) ?>
        <?= $this->Form->hidden('PictureComments.user_id', ['value' => $user_id]) ?>
        <?= $this->Form->input('PictureComments.comment', ['type' => 'textarea', 'class' => 'form-control']) ?>
        <?= $this->Form->button('Submit') ?> 
        <?= $this->Form->end() ?>
    </div>
</div>