<?= $this->Html->script('fancy'); ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
    <?php foreach($news as $article): ?>
    <div class="news-view-img" style="background-image: url('../../newspics/<?= $article->pic_url ?>.png')">
        <div class="news-header-bg">
            <h2 class="news-view-title header-space"><?= $article->title;?></h2>
        </div>
        <div style="height: 78%">
        <a href="../../newspics/<?= $article->pic_url ?>.png" class="fancybox" rel="<?= $article->id ?>">
        <img src="../../img/blank.png" style="height: 100%; width: 100%">
        </a>
        </div>
    </div>
<p><?= $article->body;?></p>
    <div class="media-left mini-profile-bg" style="background-image: url(../../portraits/<?= $article->user->current_portrait?>_small.png);">
                <?php echo $this->Html->image('../avatars/' . $article->user->avatar . '_60.png', ['url' => ['controller' => 'Users', 'action' => 'view', $article->user->id], 'class' => 'media-object mini-profile', 'title' => $article->user->username ]); ?>
              </div>
<p class="small-text"><?= $this->Time->format($article->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?>
</p>
</div>
</div>
<div class="row media-spacer">
    <div class="col-md-6 col-md-offset-3">
    <?php if(isset($article['news_comments'])): ?>
        <?php foreach($article['news_comments'] as $comment): ?>
            <div class="media">
              <div class="media-left mini-profile-bg" style="background-image: url(../../portraits/<?= $comment->user->current_portrait?>_small.png);">
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
        <?= $this->Form->create(null, ['url' => ['controller' => 'NewsComments', 'action' => 'add']]); ?>
        <?= $this->Form->hidden('news_id', ['value' => $article->id]) ?>
        <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
        <?= $this->Form->input('comment') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    <?php endif; ?>
</div>
</div>
<?php endforeach; ?>

