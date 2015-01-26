<div class="row">

    <div class="col-md-12">

        <?php //debug($set->pictures) ?>

        <h2><?= $set->name ?></h2>
        <?php if (empty($set->pictures)): ?>
            No pictures have be submitted for this set yet.
        <?php endif; ?>
        <?php foreach ($set->pictures as $picture): ?>

            <img src="/pictures/<?= $picture->guid ?>.png"></img>

        <?php endforeach; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('Pictures.add', ['url' => ['controller' => 'pictures', 'action' => 'add'], 'type' => 'file']) ?>
        <?= $this->Form->hidden('Pictures.set_id', ['value' => $set->id]) ?>
        <?= $this->Form->hidden('Pictures.user_id', ['value' => $user_id]) ?>
        <?= $this->Form->input('Pictures.file', ['type' => 'file']); ?>
        <?= $this->Form->button('Upload') ?>
        <?= $this->Form->end() ?>
    </div>
</div>