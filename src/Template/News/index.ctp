<?= $this->Html->script('fancy'); ?>
<?php foreach($news as $article): ?>
<div class="news-view-container">
<?php if($article->pic_url !=null) : ?>
<div class="news-view-img" style="background-image: url('newspics/<?= $article->pic_url ?>.png');">
    <a href="newspics/<?= $article->pic_url ?>.png" class="fancybox" rel="<?= $article->id ?>"><img src="img/blank.png" class="news-view-blank"></a>
</div>
<?php endif; ?>
<h2 style="text-align: center"><?= $article->title;?></h2>
<p><?= $article->body;?></p>
<p style="margin-top: 4%">
<?= $article->user->username;?>, <?= $this->Time->format($article->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?><br />
<?= $this->Html->link('Full Article', ['controller' => 'News', 'action' => 'view', $article->id]) ?></p>
<div class="clearfix"></div>
</div>
<?php endforeach; ?>

