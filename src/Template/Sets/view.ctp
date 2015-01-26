<div class="row">

    <div class="col-md-12">

        <?php //debug($set->pictures) ?>

        <h2><?= $set->name ?></h2>
        <?php if (empty($set->pictures)): ?>
            No pictures have be submitted for this set yet.
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create('Picutres') ?>
        <?= $this->Form->input('file', ['type' => 'file']); ?>
        <?= $this->Form->button('Upload') ?>
        <?= $this->Form->end() ?>
    </div>
</div>