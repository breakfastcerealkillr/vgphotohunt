          <div class="col-md-4 right-col">
            <h1>LATEST WINNERS</h1>
            <div class="w-slider slider-winners" data-animation="slide" data-duration="500" data-infinite="1">
              <div class="w-slider-mask">
                  <?php foreach($winners as $winner): ?>
                    <div class="w-slide">
                        <div class="w-slider-fill" style="background: url(pictures/<?= $winner->winner->guid ?>.png) no-repeat center center; background-size: cover;">
                        </div>
                    </div>
                  <?php endforeach; ?>
              </div>
              <div class="w-slider-arrow-left">
                <div class="w-icon-slider-left"></div>
              </div>
              <div class="w-slider-arrow-right">
                <div class="w-icon-slider-right"></div>
              </div>
              <div class="w-slider-nav w-round"></div>
            </div>
            <div class="w-clearfix search-box">
              <div class="search-text">Search Coming Soon... </div><a class="button search" href="#">SEARCH</a>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">OPEN HUNTS</div>
              <ul class="list-group">
            <?php foreach($openhunts as $hunt): ?>
              <li class="list-group-item list-noborder">
                  <span class="badge"><?= $this->Html->link($hunt->game->short_name, ['controller' => 'games', 'action' => 'view', $hunt->game->id], ['class' => 'sidebar-game-text']) ;?></span> - 
                  <span class="sidebar-hunt-text"><?= $this->Html->link($hunt->name, ['controller' => 'hunts', 'action' => 'view', $hunt->id], ['class' => 'sidebar-hunt-text']) ;?></span></li>
            <?php endforeach; ?>
              </ul>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">OPEN FOR VOTES</div>
              <ul class="list-group">
            <?php foreach($openvotes as $vote): ?>
              <li class="list-group-item list-noborder">
              <span class="badge"><?= $this->Html->link($vote->game->short_name, ['controller' => 'games', 'action' => 'view', $vote->game->id], ['class' => 'sidebar-game-text']) ;?></span> - 
              <?= $this->Html->link($vote->name, ['controller' => 'hunts', 'action' => 'view', $vote->id], ['class' => 'sidebar-hunt-text']) ;?>
              </li>
            <?php endforeach; ?>
              </ul>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">PAST HUNTS</div>
              <ul class="list-group">
            <?php foreach($pasthunts as $phunt): ?>
              <li class="list-group-item list-noborder">
              <span class="badge"><?= $this->Html->link($phunt->game->short_name, ['controller' => 'games', 'action' => 'view', $phunt->game->id], ['class' => 'sidebar-game-text']) ;?></span> - 
              <?= $this->Html->link($phunt->name, ['controller' => 'hunts', 'action' => 'view', $phunt->id], ['class' => 'sidebar-hunt-text']) ;?>
              </li>
            <?php endforeach; ?>
              </ul>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">ARCHIVES</div>
              <?= $this->Html->link('By Game','/archives/ByGame/') ?><br />
              <?= $this->Html->link('By Hunt','/archives/ByHunt/') ?><br />
              <?= $this->Html->link('By Mark','/archives/ByMark/') ?><br />
              <?= $this->Html->link('By User','/archives/ByUser/') ?><br />
              <?= $this->Html->link('By Date','/archives/ByDate/') ?>
            </div>
          </div>
        </div>