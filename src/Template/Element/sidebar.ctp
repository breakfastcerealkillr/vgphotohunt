<div class="sidebar">
    <div class="loggedin">
        <?php if ($loggedin): ?>
            <?php if ($avatar): ?>
                <?= $this->Html->image('../avatars/' . $avatar . '_60.png', ['class' => 'usericon', 'url' => ['controller' => 'users', 'action' => 'view', $user_id]]); ?>
            <?php else: ?>
                <?= $this->Html->image('../avatars/default_60.png', ['class' => 'usericon', 'url' => ['controller' => 'users', 'action' => 'view', $user_id]]); ?>
            <?php endif ?>
            <?= $this->Html->link($username, ['controller' => 'users', 'action' => 'view', $user_id], ['class' => 'h4 username']) ?>
            <p class="userstats">{?} Hunts</p>
            <p class="userstats">{?} Wins</p>
        <?php else: ?>
            <?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
    </div>
    <div class="sidebarlist">
        <?= $this->Html->image('side_opensets.png', ['alt' => 'openhunts']) ?>
        <ul class="list-unstyled">
            <li><span class="badge">{?}</span> <?= $this->Html->link('Elder Scrolls: Skyrim', ['controller' => 'hunts', 'action' => 'open', 'skyrim']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('Grand Theft Auto V', ['controller' => 'hunts', 'action' => 'open', 'gtav']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('World of Warcraft', ['controller' => 'hunts', 'action' => 'open', 'wow']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('IRL', ['controller' => 'hunts', 'action' => 'open', 'irl']) ?></li>
        </ul>
        <?= $this->Html->image('side_openvotes.png', ['alt' => 'openvotes']) ?>
        <ul class="list-unstyled">
            <li><span class="badge">{?}</span> <?= $this->Html->link('Elder Scrolls: Skyrim', ['controller' => 'hunts', 'action' => 'openvotes', 'skyrim']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('Grand Theft Auto V', ['controller' => 'hunts', 'action' => 'openvotes', 'gtav']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('World of Warcraft', ['controller' => 'hunts', 'action' => 'openvotes', 'wow']) ?></li>
            <li><span class="badge">{?}</span> <?= $this->Html->link('IRL', ['controller' => 'hunts', 'action' => 'openvotes', 'irl']) ?></li>
        </ul>
        <?= $this->Html->image('side_archives.png', ['alt' => 'archives']) ?>
        <ul class="list-unstyled">
            <li>By Game</li>
            <li>By Set</li>
            <li>By User</li>
            <li>By Votes</li>
        </ul>
    </div>
</div>