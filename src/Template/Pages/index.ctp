        <div class="w-col w-col-8 w-clearfix left-col">
            <div class="div-welcome">
                <?= $this->Html->image('welcomehunter.png', ['alt' => 'welcome', 'class' => 'img-welcome']) ?>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum 
                  tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero 
                  vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus 
                  tristique posuere.&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius 
                  enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut 
                  commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc 
                  ut sem vitae risus tristique posuere.&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                  Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor 
                  interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem 
                  imperdiet. Nunc ut sem vitae risus tristique posuere.&nbsp;Lorem ipsum dolor sit amet, consectetur 
                  adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra 
                  ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo 
                  cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
            
            <div class="heading-news">NEWS</div>
            
            <?php foreach ($news as $article): ?>
            <div class="w-row news-row">
              <div class="w-col w-col-7 news-left">
                <div class="w-row news-inner">
                  <div class="w-col w-col-2 news-inner-left">
                    <div class="news-usr-img"><?= $this->Html->image('/avatars/' . $article->user->avatar . '_60.png');?>
                    </div>
                    <div class="news-time">
                      <div class="news-text-date"><?= $article->user->username ;?>
                            <?= $this->Time->format($article->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?>
                      </div>
                    </div>
                  </div>
                  <div class="w-col w-col-10 news-inner-right">
                    <div class="news-heading-inner"><?= $article->title ;?></div>
                    <div class="news-text-inner"><p class="news-body"><?= $this->Text->truncate($article->body, 220, ['ellipsis' => '...', 'exact' => false]) ;?></p></div>
                    <div class="news-poster"><?= $this->Html->link('READ MORE', ['controller' => 'news', 'action' => 'view', $article->id], ['class' => 'news-link'])?></div>
                  </div>
                </div>
              </div>
              <div class="w-col w-col-5 news-right" style="background-image: url('newspics/<?= $article->pic_url ?>.png')"></div>
            </div>
            <?php endforeach; ?>
            <?= $this->Html->link('MORE NEWS', ['controller' => 'news', 'action' => 'view'], ['class' => 'button more-news'])?>
          </div>
<?= $this->element('sidebar') ?>