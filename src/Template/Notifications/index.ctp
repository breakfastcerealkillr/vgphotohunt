<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th class="col-md-2"><?= $this->Paginator->sort('timestamp', 'Time Stamp'); ?></th>
            <th class="col-md-1"><?= $this->Paginator->sort('is_read', $this->Html->image('unread.png'), ['escape' => false]); ?></th>
            <th>Description</th>
        </thead>
            <?php foreach ($notifications as $note): ?>
                <tr>
                    <td><?= $this->Time->format($note->timestamp, 'M/d/Y HH:mm', 'Unknown', $timezone) ?></td>
                    <?php if(!$note->is_read) : ?>
                    <td><?php echo $this->Html->image('unread.png'); ?></td>
                    <td><strong><?= $this->Html->link($note->text, ['action' => 'read', $note->id]) ?></strong></td>
                    <?php else : ?>
                    <td></td>
                    <td><?= $this->Html->link($note->text, $this->Url->build('/' . $note->url, true)) ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <?= $this->Html->link('Mark All As Read', ['controller' => 'notifications', 'action' => 'markAll'], ['class' => 'btn btn-xs btn-info']) ?>
    </div>
</div>
<?php
if ($this->Paginator->counter('{{count}}') > $pageLimit) {
    echo $this->element('paginator');}
?>