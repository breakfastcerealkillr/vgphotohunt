<?= $this->Html->script('fancy'); ?>
<?php if(isset($hunt)):?>
    <?php if($status['vote'] == 'open'):?>
    <?php $i = 1; ?>
        <h2><?= $hunt->name ?> -- Open For Voting</h2>
        <p><?= $hunt->description ?></p>
                <ul>
            <?php foreach($marks as $mark): ?>
                    <li><h3><?= $mark->name ?></h3> <br />
                <?php foreach($mark['submissions'] as $mpic): ?>
                    <div class="text-center" style="display: inline-block">
                         <div class="thumb-container">
                            <div class="thumb-pic" style="background-image: url('../../pictures/<?= $mpic->guid ?>_thumb.png');">
                                <a href="../../pictures/<?= $mpic->guid ?>.png" class="fancybox" data-title-id="title-<?= $i ?>" rel="<?= $mark->name; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                                <div id="title-<?= $i ?>" class="hidden">
                                    <a href="../../pictures/<?= $mpic->guid ?>.png" target="_blank"><p class="glyphicon glyphicon-search" style="float:right; margin-left: 5px; margin-bottom: 5px;"></p></a>
                                        <div class="block-centered" style="margin: 0px auto;"><p class="text-big"><?= $mpic->caption ?></p></div>
                                            <?php if(isset($mpic['picture_comments'])): ?>
                                            <?php foreach($mpic['picture_comments'] as $comment): ?>
                                            <?= $this->element('comments', ['comment' => $comment]) ; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if($loggedin == true): ?>
                                        <div class="col-md-4 col-centered" style="min-width: 300px;">
                                            <?= $this->Form->create(null, ['url' => ['controller' => 'PictureComments', 'action' => 'add']]); ?>
                                            <?= $this->Form->hidden('picture_id', ['value' => $mpic->id]) ?>
                                            <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                                            <?= $this->Form->input('comment') ?>
                                            <?= $this->Form->button('Submit') ?>
                                            <?= $this->Form->end() ?>
                                        </div>
                                        <?php endif; ?>
                                </div>
                                <?php $i += 1; ?>
                            </div>
                        </div>
                        <br />
                        <?= $mpic->user->username ; ?>
                        <?php if ($loggedin == true  && empty($mpic->voted)) : ?>
                        <?= $this->Form->create('voteAdd', ['url' => ['controller' => 'Votes', 'action' => 'voteAdd']]) ?>
                        <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                        <?= $this->Form->hidden('picture_id', ['value' => $mpic->id]) ?>
                        <?= $this->Form->hidden('mark_id', ['value' => $mark->id]) ?>
                        <?= $this->Form->button('Vote') ?>
                        <?= $this->Form->end() ?>
                        <?php elseif($loggedin == true && !empty($mpic->voted)): ?>
                        <?= $this->Form->create('voteAdd', ['url' => ['controller' => 'Votes', 'action' => 'voteAdd']]) ?>
                        <?= $this->Form->button('Voted', ['class' => 'disabled']) ?>
                        <?= $this->Form->end() ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif($status['subs'] == 'open'): ?>
        <?php $i = 1; ?>
        <h2><?= $hunt->name ?> -- Open For Submission</h2>
        <p><?= $hunt->description ?></p>
        <ul>
            <?php foreach($marks as $mark): ?>
                 <li><h3><?= $mark->name ?></h3></li>
                 <?php if($mark->completed == true && $loggedin == true ) : ?>
                        <?php foreach($mark['submissions'] as $mpic): ?>
                 <div class="text-center" style="display: inline-block">
                    <div class="thumb-container">
                       <div class="thumb-pic" style="background-image: url('../../pictures/<?= $mpic->guid ?>_thumb.png');">
                           <a href="../../pictures/<?= $mpic->guid ?>.png" class="fancybox" data-title-id="title-<?= $i ?>" rel="<?= $mark->name; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                           <div id="title-<?= $i ?>" class="hidden">
                               <a href="../../pictures/<?= $mpic->guid ?>.png" target="_blank"><p class="glyphicon glyphicon-search" style="float:right; margin-left: 5px; margin-bottom: 5px;"></p></a>
                                   <div class="block-centered" style="margin: 0px auto;"><p class="text-big"><?= $mpic->caption ?></p></div>
                                       <?php if(isset($mpic['picture_comments'])): ?>
                                       <?php foreach($mpic['picture_comments'] as $comment): ?>
                                        <?= $this->element('comments', ['comment' => $comment]) ; ?>
                                       <?php endforeach; ?>
                                   <?php endif; ?>
                                   <?php if($loggedin == true): ?>
                                   <div class="col-md-4 col-centered" style="min-width: 300px;">
                                       <?= $this->Form->create(null, ['url' => ['controller' => 'PictureComments', 'action' => 'add']]); ?>
                                       <?= $this->Form->hidden('picture_id', ['value' => $mpic->id]) ?>
                                       <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                                       <?= $this->Form->input('comment') ?>
                                       <?= $this->Form->button('Submit') ?>
                                       <?= $this->Form->end() ?>
                                   </div>
                                   <?php endif; ?>
                           </div>
                           <?php $i += 1; ?>
                       </div>
                   </div>
                <br />
                    <?= $mpic->user->username ; ?>
                </div>
                        <?php endforeach; ?>
                 <?php elseif($loggedin == true) : ?>
                 <div class="row">
                 <div class="col-md-4">
                        <p>Submit your own to see others already submitted!</p>
                        <?= $this->Form->create('addSub', ['type' => 'file', 'url' => ['controller' => 'Pictures', 'action' => 'addSub']]) ?>
                        <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                        <?= $this->Form->hidden('mark_id', ['value' => $mark->id]) ?>
                        <?= $this->Form->hidden('guid') ?>
                        <?= $this->Form->input('file', ['type' => 'file', 'label' => 'Upload Picture']); ?>
                        <?= $this->Form->input('caption'); ?>
                        <?= $this->Form->button('Submit'); ?>
                        <?= $this->Form->end() ?>
                 </div>
                 </div>
                 <?php else : ?>
                 <p>Please log in to submit your screenshots!</p>
                 <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <?php $i = 1; ?>
        <h2><?= $hunt->name ?> -- Archived</h2>
        <p><?= $hunt->description ?></p>
        <ul>
            <?php foreach($marks as $mark): ?>
                <li><h3><?= $mark->name ?></h3> <br />
                <?php foreach($mark['submissions'] as $mpic): ?>
                    <div class="text-center" style="display: inline-block">
                        <div class="thumb-container">
                           <div class="thumb-pic" style="background-image: url('../../pictures/<?= $mpic->guid ?>_thumb.png');">
                               <a href="../../pictures/<?= $mpic->guid ?>.png" class="fancybox" data-title-id="title-<?= $i ?>" rel="<?= $mark->name; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                               <div id="title-<?= $i ?>" class="hidden">
                                   <a href="../../pictures/<?= $mpic->guid ?>.png" target="_blank"><p class="glyphicon glyphicon-search" style="float:right; margin-left: 5px; margin-bottom: 5px;"></p></a>
                                       <div class="block-centered" style="margin: 0px auto;"><p class="text-big"><?= $mpic->caption ?></p></div>
                                           <?php if(isset($mpic['picture_comments'])): ?>
                                           <?php foreach($mpic['picture_comments'] as $comment): ?>
                                            <?= $this->element('comments', ['comment' => $comment]) ; ?>
                                           <?php endforeach; ?>
                                       <?php endif; ?>
                                       <?php if($loggedin == true): ?>
                                       <div class="col-md-4 col-centered" style="min-width: 300px;">
                                           <?= $this->Form->create(null, ['url' => ['controller' => 'PictureComments', 'action' => 'add']]); ?>
                                           <?= $this->Form->hidden('picture_id', ['value' => $mpic->id]) ?>
                                           <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                                           <?= $this->Form->input('comment') ?>
                                           <?= $this->Form->button('Submit') ?>
                                           <?= $this->Form->end() ?>
                                       </div>
                                       <?php endif; ?>
                               </div>
                               <?php $i += 1; ?>
                           </div>
                       </div>
                    <br />
                        <?= $mpic->user->username ; ?>
                        <?php if ($mark->winner_id == $mpic->id) {echo ' - Winner!';} ?>
                    </div>
                <?php endforeach; ?>
                </li>
            <?php endforeach; ?>
        </ul>
<?php endif; ?>
        
<?php else: // NO ID GIVEN. LIST MODE ?>
<div class="row">
    <div class="col-md-4">
        <h2>OPEN HUNTS</h2>
    <?php foreach($openhunts as $ohunt): ?>
        <span class="badge"><?= $this->Html->link($ohunt->game->short_name,['controller' => 'Games', 'action' => 'view', $ohunt->game->id]) ?></span> <?= $this->Html->link($ohunt->name,['controller' => 'Hunts', 'action' => 'view', $ohunt->id]) ?>
        <ul>
            <?php foreach($ohunt['marks'] as $omark): ?>
            <li><?= $omark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <h2>OPEN FOR VOTES</h2>
    <?php foreach($openvotes as $ovote): ?>
        <span class="badge"><?= $this->Html->link($ovote->game->short_name,['controller' => 'Games', 'action' => 'view', $ovote->game->id]) ?></span> <?= $this->Html->link($ovote->name,['controller' => 'Hunts', 'action' => 'view', $ovote->id]) ?>
        <ul>
            <?php foreach($ovote['marks'] as $ovmark): ?>
            <li><?= $ovmark->name ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
    </div>
    <div class="col-md-4">
        <h2>PAST HUNTS</h2>
    <?php foreach($pasthunts as $pasthunt): ?>
        <span class="badge"><?= $this->Html->link($pasthunt->game->short_name,['controller' => 'Games', 'action' => 'view', $pasthunt->game->id]) ?></span> <span class="text-med"><?= $this->Html->link($pasthunt->name,['controller' => 'Hunts', 'action' => 'view', $pasthunt->id]) ?></span><br />
    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>