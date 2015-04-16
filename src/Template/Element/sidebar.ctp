          <div class="w-col w-col-4 right-col">
            <h1>LATEST WINNERS</h1>
            <p>Hurry up and win something, will ya?</p>
            <div class="w-slider slider-winners" data-animation="slide" data-duration="500" data-infinite="1">
              <div class="w-slider-mask">
                  <?php foreach($winners as $winner): ?>
                    <div class="w-slide"><img src="pictures/<?= $winner->picture->guid ?>.png" alt="By <?= $winner->picture->user->username ?>"></div>
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
              <?php foreach($openhunts as $hunt): ?>
              <?= $this->Html->link($hunt->game->name, ['controller' => 'games', 'action' => 'view', $hunt->game->id], ['class' => 'sidebar-game-text']) ;?> - 
              <?= $this->Html->link($hunt->name, ['controller' => 'hunts', 'action' => 'view', $hunt->id], ['class' => 'sidebar-hunt-text']) ;?>
              <?php endforeach; ?>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">OPEN FOR VOTES</div>
              <?php foreach($openvotes as $vote): ?>
              <p><?= $this->Html->link($vote->game->name, ['controller' => 'games', 'action' => 'view', $vote->game->id], ['class' => 'sidebar-game-text']) ;?> - 
              <?= $this->Html->link($vote->name, ['controller' => 'hunts', 'action' => 'view', $vote->id], ['class' => 'sidebar-hunt-text']) ;?>
              <?php endforeach; ?></p>
            </div>
            <div class="sidebar-list">
              <div class="sidebar-title">ARCHIVES</div>
              <?= $this->Html->link('By Game',['controller' => 'archives', 'action' => 'ByGame']) ?><br />
              <?= $this->Html->link('By Hunt',['controller' => 'archives', 'action' => 'ByHunt']) ?><br />
              <?= $this->Html->link('By Mark',['controller' => 'archives', 'action' => 'ByMark']) ?><br />
              <?= $this->Html->link('By Date',['controller' => 'archives', 'action' => 'ByDate']) ?>
            </div>