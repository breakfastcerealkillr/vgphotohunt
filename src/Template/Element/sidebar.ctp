<div class="sidebar">
    <div class="loggedin">
        <?php if ($loggedin): ?>
            <?= $this->Html->image('../avatars/' . $avatar . '_60.png', ['class' => 'usericon', 'url' => ['controller' => 'users', 'action' => 'view', $user_id]]); ?>
            <?= $this->Html->link($username, ['controller' => 'users', 'action' => 'view', $user_id], ['class' => 'h4 username']) ?>
            <p class="userstats">{?} Sets</p>
            <p class="userstats">{?} Wins</p>
        <?php else: ?>
            <?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
    </div>
    <div class="sidebarlist">
        <?= $this->Html->image('side_opensets.png', ['alt' => 'opensets', 'url' => ['controller' => 'sets', 'action' => 'open']]) ?>
        <ul class="list-unstyled">
            <li><span class="badge">{?}</span> Elder Scrolls: Skyrim</li>
            <li><span class="badge">{?}</span> Grand Theft Auto V</li>
            <li><span class="badge">{?}</span> World of Warcraft</li>
            <li><span class="badge">{?}</span> IRL </li>
        </ul>
        <?= $this->Html->image('side_openvotes.png', ['alt' => 'openvotes', 'url' => ['controller' => 'sets', 'action' => 'openvotes']]) ?>
        <ul class="list-unstyled">
            <li><span class="badge">{?}</span> Elder Scrolls: Skyrim</li>
            <li><span class="badge">{?}</span> Grand Theft Auto V</li>
            <li><span class="badge">{?}</span> World of Warcraft</li>
            <li><span class="badge">{?}</span> IRL</li>
        </ul>
        <?= $this->Html->image('side_archives.png', ['alt' => 'archives', 'url' => ['controller' => 'sets', 'action' => 'archives']]) ?>
        <ul class="list-unstyled">
            <li>By Game</li>
            <li>By Set</li>
            <li>By User</li>
            <li>By Votes</li>
        </ul>
    </div>
</div>