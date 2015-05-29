<?= $this->Html->script('fancy'); ?>
<?php $i = 1; ?>
<h2 class="text-center"><?= $user->username ?></h2>
<div class="row">
    <div class="col-md-3">
        <?php if (empty($user->avatar)): ?>
        <div class="" style="background-size: cover; background-image: url(<?= $this->request->webroot ?>/../portraits/<?= $user->current_portrait ?>.png); width: 153px; height: 183px; margin: 0px auto;">
            <?= $this->Html->image('/avatars/default_100.png', ['style' => 'width: 133px; height: 133px; margin-top: 9px; margin-left: 10px;'])?>
        </div>
        <?php else: ?>
        <div class="" style="background-size: cover; background-image: url(<?= $this->request->webroot ?>/../portraits/<?= $user->current_portrait ?>.png); width: 153px; height: 183px; margin: 0px auto;">
            <?= $this->Html->image('/avatars/'. $user->avatar .'.png', ['style' => 'width: 133px; height: 133px; margin-top: 9px; margin-left: 10px;'])?>
        </div>
        <?php endif ?>
        <div class="progress media-spacer">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?= $user->xp ?>" aria-valuemin="0" aria-valuemax="<?= $user->next_level ?>" style="width: <?= (($user->xp + 1) / $user->next_level) * 100; ?>%;">
                <span class="progress-text">Lv&nbsp;<span class="bolded"><?= $user->level; ?></span></span>
            </div>
        </div> 
    </div>
    <div class="col-md-6">
        <table class="table">
            <tr>
                <td>Submissions</td><td><?= $this->Html->link($pictures_count, ['controller' => 'Archives','action' => 'byUser', $user->id]) ?></td>
            </tr>
            <tr>
                <td>Wins</td><td><?= $wins ?></td>
            </tr>
            <tr>
                <td>Votes Given</td><td><?= $totalvotes ?></td>
            </tr>
            <tr>
                <td>Votes Received</td><td><?= $sumvotes ?></td>
            </tr>
            <tr>
                <td>Comments</td><td><?= $totalcomments ?></td>
            </tr>
            <tr>
                <td>Steam ID:</td><td><?= $user->steam_id ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3>Latest Submissions</h3>
        <?php foreach ($latest as $mpic): ?>
            <div class="text-center" style="display: inline-block">
                <div class="thumb-container">
                   <div class="thumb-pic" style="background-image: url('../../pictures/<?= $mpic->guid ?>_thumb.png');">
                       <a href="../../pictures/<?= $mpic->guid ?>.png" class="fancybox" data-title-id="title-<?= $i ?>" rel="<?= $user->username; ?>"><img src="../../img/blank.png" class="thumb-blank"></a>
                       <div id="title-<?= $i ?>" class="hidden">
                           <a href="../../pictures/<?= $mpic->guid ?>.png" target="_blank"><p class="glyphicon glyphicon-search" style="float:right; margin-left: 5px; margin-bottom: 5px;"></p></a>
                               <div class="block-centered" style="margin: 0px auto;"><p class="text-big"><?= $mpic->caption ?></p></div>
                                   <?php if(isset($mpic['picture_comments'])): ?>
                                   <?php foreach($mpic['picture_comments'] as $comment): ?>
                                       <div class="media">
                                         <div class="media-left mini-profile-bg" style="background-image: url(../../portraits/<?= $comment->user->current_portrait ?>_small.png);">
                                            <?php if($comment->user->avatar != null): ?>
                                            <?php echo $this->Html->image('../avatars/' . $comment->user->avatar . '_60.png', ['url' => ['controller' => 'Users', 'action' => 'view', $comment->user->id], 'class' => 'media-object mini-profile', 'title' => $comment->user->username ]); ?>
                                            <?php else: ?>
                                            <?php echo $this->Html->image('../avatars/default_60.png', ['url' => ['controller' => 'Users', 'action' => 'view', $comment->user->id], 'class' => 'media-object mini-profile', 'title' => $comment->user->username ]); ?>
                                            <?php endif;?>
                                         </div>
                                         <div class="media-body">
                                             <p><?= $comment->comment?></p>
                                             <p class="small-text"><?= $this->Time->format($comment->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?></p>
                                         </div>
                                   </div>
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
            </div>
        <?php endforeach; ?>
    </div>
</div>
<br>
<br>
<?php if ($user_id == $user->id): ?>
    <div class="row">
        <div class="col-md-6">
            <?= $this->Html->link('Edit Your Profile', ['action' => 'edit', $user_id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php endif ?> 