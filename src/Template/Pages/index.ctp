<div class="row">
    <div class="col-md-2">
        <?= $this->element('sidebar') ?>
    </div>
    <div class="col-md-10">
        <?= $this->Html->image('welcomehunter.png')?>
        <p>
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.
        </p>
        <h1>News</h1>
        <?php foreach ($news as $article): ?>
            <table>
                <tr>
                    <td><?= $article->title ?></td>
                    <td><?= $this->Text->truncate($article->body, 50,array('ellipsis' => '...', 'exact' => false)) ?></td>
                    <td><?php if (!empty($article->pic_url)): ?>
                        <?= $this->Html->image('../newspics/' . $article->pic_url . '_100.png') ?>
                        <?php endif ?></td>
                    <td><?= $this->Time->format($article->timestamp, 'M/d/Y', 'Not Available', $timezone) ?></td>
                </tr>
            </table>
            <?php endforeach; ?>
        
        <h1>Latest Winners </h1>
        <?php foreach ($winners as $winner): ?>
            <table>
                <tr>
                    <td><?= $this->html->image('/pictures/' . $winner->picture->guid . '_thumb.png') ?> <?= $winner->picture->user->username ?></td>
                </tr>
            </table>
        <?php endforeach; ?>
        
        <h1>Open Hunts</h1>
        <?php foreach ($openhunts as $hunt): ?>
            <table>
                <tr>
                    <td><?= $hunt->game->name ?> - <?= $hunt->name ?></td>
                </tr>
            </table>
        <?php endforeach; ?>

        <h1>Open Votes</h1>
        <?php foreach ($openvotes as $vote): ?>
            <table>
                <tr>
                    <td><?= $vote->game->name ?> - <?= $vote->name ?></td>
                </tr>
            </table>
        <?php endforeach; ?>
        
        <h1>Archives</h1>
            <p><?= $this->Html->link('By Game', ['controller' => 'archives', 'action' => 'byGame']) ?></p>
            <p><?= $this->Html->link('By Hunt', ['controller' => 'archives', 'action' => 'byHunt']) ?></p>
            <p><?= $this->Html->link('By Mark', ['controller' => 'archives', 'action' => 'byMark']) ?></p>
            <p><?= $this->Html->link('By Date', ['controller' => 'archives', 'action' => 'byDate']) ?></p>
    </div>
</div>
