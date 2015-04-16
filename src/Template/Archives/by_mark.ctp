<div class="row">
    <div class="col-md-10 col-centered">
            <?php $currentMark = ''; ?>
            <?php foreach ($pics as $pic): ?>
            <?php if ($currentMark != $pic->mark->name): ?>
                <h2><?= $pic->mark->name; ?></h2>
            <?php $currentMark = $pic->mark->name; ?>
            <?php endif; ?>
                <?= $this->Html->image('/pictures/'.$pic->guid.'_thumb.png'); ?>
            <?php endforeach; ?>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > 30) {echo $this->element('paginator');} ?>
<?= $this->Paginator->counter([
    'format' => 'Page {{page}} of {{pages}}, showing {{current}} records out of
             {{count}} total, starting on record {{start}}, ending on {{end}}'
]) ?>