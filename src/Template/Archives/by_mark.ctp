<?= $this->Html->script('fancy'); ?>
<?php $i = 1; ?>
<div class="row">
    <div class="col-md-10 col-centered">
            <?php $currentMark = ''; ?>
            <?php foreach ($pics as $mpic): ?>
            <?php if ($currentMark != $mpic->mark->name): ?>
                <h2><?= $mpic->mark->name; ?></h2>
            <?php $currentMark = $mpic->mark->name; ?>
            <?php endif; ?>
            <div class="text-center" style="display: inline-block">
                <div class="thumb-container">
                   <div class="thumb-pic" style="background-image: url('../../pictures/<?= $mpic->guid ?>_thumb.png');">
                       <a href="../../pictures/<?= $mpic->guid ?>.png" class="fancybox" data-title-id="title-<?= $i ?>" rel="<?= $mpic->mark->name; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                       <div id="title-<?= $i ?>" class="hidden">
                           <a href="../../pictures/<?= $mpic->guid ?>.png" target="_blank"><p class="glyphicon glyphicon-search" style="float:right; margin-left: 5px; margin-bottom: 5px;"></p></a>
                               <div class="block-centered" style="margin: 0px auto;"><p class="text-big"><?= $mpic->caption ?></p></div>
                                   <?php if(isset($mpic['picture_comments'])): ?>
                                   <?php foreach($mpic['picture_comments'] as $comment): ?>
                                    <?= $this->element('comments', ['comment' => $comment]) ; ?>
                                   <?php endforeach; ?>
                               <?php endif; ?>
                               <?php if($loggedin == true): ?>
                               <?= $this->element('addComment', ['mpic' => $mpic]) ; ?>
                               <?php endif; ?>
                       </div>
                       <?php $i += 1; ?>
                   </div>
               </div>
            </div>
            <?php endforeach; ?>
    </div>
    <p>Keep in mind that the Archives do not show submissions from ongoing hunts.</p>
    <?php if ($this->Paginator->counter('{{count}}') > 30) {echo $this->element('paginator');} ?>
<p class="small-text"><?= $this->Paginator->counter([
    'format' => 'Page {{page}} of {{pages}}, showing {{current}} records out of
             {{count}} total, starting on record {{start}}, ending on {{end}}'
    ]) ?></p>
</div>