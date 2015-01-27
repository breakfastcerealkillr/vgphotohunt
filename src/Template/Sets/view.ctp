<div class="row">
    <div class="col-md-4">
        <h2><?= $set->name ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?php if (isset($user_id)): ?>
            <?= $this->Form->create('Pictures.add', ['url' => ['controller' => 'pictures', 'action' => 'add'], 'type' => 'file']) ?>
            <?= $this->Form->hidden('Pictures.set_id', ['value' => $set->id]) ?>
            <?= $this->Form->hidden('Pictures.user_id', ['value' => $user_id]) ?>
            <?= $this->Form->input('Pictures.file', ['type' => 'file']); ?>
            <?= $this->Form->button('Upload') ?>
            <?= $this->Form->end() ?>
            <p>PNG, JPG, BMP Accepted</p>
            <p>15MB File Size Limit</p>
        <?php else: ?>
            <button type="button" class="btn btn-default loggedoff" disabled="disabled">Upload</button>
        <?php endif ?>
    </div>
</div>
<div class="row">

    <div class="col-md-12">

        <?php //debug($set->pictures) ?>
        <?php if (empty($set->pictures)): ?>
            No pictures have be submitted for this set yet.
        <?php endif; ?>
        <?php foreach ($set->pictures as $picture): ?>

            <?= $this->Html->image("/pictures/{$picture->guid}_thumb.png", [
                'alt' => $picture->guid,
                'url' => ['controller' => 'pictures', 'action' => 'view', $picture->id]
            ]) ?>

        <?php endforeach; ?>
    </div>
</div>
