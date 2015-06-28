            <div class="media">
              <div class="media-left mini-profile-bg" style="background-image: url('../../portraits/<?= $comment->user->current_portrait?>_small.png');">

                <?php if(!empty($comment->user->avatar)) : ?>
                <div class="mini-profile media-object" style="background-image: url(<?= $this->request->base . '/../avatars/'. $comment->user->avatar .'_60.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $comment->user->id], 'style' => 'width: 100%; height: 100%;', 'title' => $comment->user->username]); ?>
                </div>
                <?php else: ?>
                <div class="avatar-bg" style="background-image: url(<?= $this->request->base . '/../avatars/default.png'; ?>)">
                    <?= $this->Html->image($this->request->base . '/../img/blank.png', ['url' => ['controller' => 'Users', 'action' => 'view', $user_id], 'style' => 'width: 100%; height: 100%;']); ?>
                </div>
                <?php endif; ?>
                  
              </div>
              <div class="media-body">
                  <p><?= $comment->comment?></p>
                  <p class="small-text"><?= $this->Time->format($comment->timestamp, 'M/d/Y h:mm a' , 'Unavailable', $timezone) ?></p>
              </div>
            </div>