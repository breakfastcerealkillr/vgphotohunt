<?= $this->Html->script('fancy'); ?>
<?php $i = 1; ?>
<h2 class="text-center"><?= $user->username ?></h2>
<div class="row">
    <div class="col-md-3">
                <?php if(!empty($user->avatar)) : ?>
                <div class="avatar-bg" style="background-image: url(<?= $this->request->base . '/../avatars/'. $user->avatar .'.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $user_id], 'style' => 'width: 100%; height: 100%;']); ?>
                </div>
                <?php else: ?>
                <div class="avatar-bg" style="background-image: url(<?= $this->request->base . '/../avatars/default.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $user_id], 'style' => 'width: 100%; height: 100%;']); ?>
                </div>
                <?php endif; ?>
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
                <?php if(!empty($user->steam_id)) : ?>
                <td>Steam ID:</td><td><a href="http://steamcommunity.com/profiles/<?= $user->steam_id ?>/">Steam Profile</a></td>
                <?php else : ?>
                <td>Steam ID:</td><td>None Listed</td>
                <?php endif; ?>
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