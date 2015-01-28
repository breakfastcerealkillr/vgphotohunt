<div class="row">
    <div class="col-md-6">
        <h2><?= $user->username ?></h2>
        <?php if (empty($user->avatar)): ?>
            <img src="/avatars/default_100.png">
        <?php else: ?>
            <img src="/avatars/<?= $user->avatar ?>_100.png">
        <?php endif ?>
        <table class="table">
            <tr>
                <td>Steam ID:</td><td><?= $user->steam_id ?></td>
            </tr>
            <tr>
                <td>Submissions</td><td><?= $pictures_count ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h3>Latest Submissions</h3>
        <?php foreach ($user->pictures as $picture): ?>
            <?=
            $this->Html->image("/pictures/{$picture->guid}_thumb.png", [
                'alt' => $picture->guid,
                'url' => ['controller' => 'pictures', 'action' => 'view', $picture->id]
            ])
            ?>
        <?php endforeach; ?>
    </div>
</div>
<br>
<br>
<?php if ($user_id == $user->id): ?>
    <div class="row">
        <div class="col-md-6">
            <?= $this->Html->link('Edit Your Profile', ['action' => 'edit', $user_id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php endif ?> 