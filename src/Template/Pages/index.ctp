    <div class="row">
        <div class="col-md-8 left-col">
            <div class="div-welcome">
                <?= $this->Html->image('welcomehunter.png', ['alt' => 'welcome', 'class' => 'img-welcome']) ?>
              <?php if($loggedin == true) : ?>
                <h3>Dashboard</h3>
                <ul>
                    <li>There are <b><?= $this->Html->link($totalopen, ['controller' => 'hunts', 'action' => 'view'], ['class' => ''])?></b> open hunts you can submit to.</li>
                    <li>There are <b><?= $this->Html->link($totalvote, ['controller' => 'hunts', 'action' => 'view'], ['class' => ''])?></b> hunts you can vote on.</li>
                    <li>You can <?= $this->Html->link('check your stats', ['controller' => 'users', 'action' => 'view', $user_id], ['class' => ''])?> on your profile page.</li>
                    <?php if($current_user->avatar == null) : ?>
                    <li><?= $this->Html->link('Change your avatar', ['controller' => 'users', 'action' => 'view', $user_id], ['class' => ''])?> to something awesome!</li>
                    <?php endif; ?>
                    <li>Get in game and take some screenshots, you lazy oaf!</li>
                </ul>
                <?php else: ?>
                <p>
                Hello! You might be wondering <?= $this->Html->link('what this place is about', ['controller' => 'pages', 'action' => 'what'], ['class' => ''])?>. It's a love letter to gaming and photography; a marriage of artistic talent and emergent gameplay that's as competitive or as collaborative as you want it to be. <?= $this->Html->link('Sign up', ['controller' => 'users', 'action' => 'register'], ['class' => ''])?>, <?= $this->Html->link('sign in', ['controller' => 'users', 'action' => 'login'], ['class' => ''])?>, and <?= $this->Html->link('get started on your first hunt', ['controller' => 'hunts', 'action' => 'view'], ['class' => ''])?>!
                </p>
                <?php endif; ?>
            </div>
            
            <div class="heading-news">NEWS</div>
            
            <?php foreach ($news as $article): ?>
            <div class="row row-no-padding news-row">
              <div class="col-sm-7 news-left">
                <div class="row row-no-padding news-inner">
                  <div class="col-sm-2 news-inner-left">
                    <div class="news-usr-img"><?= $this->Html->image('/avatars/' . $article->user->avatar . '_60.png');?>
                    </div>
                    <div class="news-time">
                      <div class="news-text-date"><?= $article->user->username ;?>
                            <?= $this->Time->format($article->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-10 news-inner-right">
                    <div class="news-heading-inner"><?= $article->title ;?></div>
                    <div class="news-text-inner"><p class="news-body"><?= $this->Text->truncate($article->body, 220, ['ellipsis' => '...', 'exact' => false]) ;?></p></div>
                    <div class="news-poster"><?= $this->Html->link('READ MORE', ['controller' => 'news', 'action' => 'view', $article->id], ['class' => 'news-link'])?></div>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 news-right" style="background-image: url('newspics/<?= $article->pic_url ?>.png')"></div>
            </div>
            <?php endforeach; ?>
            <?= $this->Html->link('MORE NEWS', ['controller' => 'news', 'action' => 'index'], ['class' => 'button more-news'])?>
          </div>
<?= $this->element('sidebar') ?>