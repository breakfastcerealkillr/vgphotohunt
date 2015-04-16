
<?php foreach($news as $article): ?>
<div class="news-view-img" style="background-image: url('newspics/<?= $article->pic_url ?>.png')"><h2 class="news-view-title"><?= $article->title;?></h2></div>
<p><?= $article->body;?></p>
<p><?= $article->user->username;?>, <?= $this->Time->format($article->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?>
<?php if(isset($article['news_comments'])): ?>
    <?php foreach($article['news_comments'] as $comment): ?>
        <p><?= $comment->user->username?> - <?= $comment->comment?></p>
    <?php endforeach; ?>

<?php if($loggedin === true): ?>
        <?= $this->Form->create(null, ['url' => ['controller' => 'NewsComments', 'action' => 'add']]); ?>
        <?= $this->Form->hidden('news_id', ['value' => $article->id]) ?>
        <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
        <?= $this->Form->input('comment') ?>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>

