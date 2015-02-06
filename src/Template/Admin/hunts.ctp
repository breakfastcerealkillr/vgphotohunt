<?= $this->element('adminNav') ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Game</th>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Voting Start Date</th>
            <th>Voting End Date</th>
            </thead>
            <?php foreach ($hunts as $hunt): ?>
                <tr>
                    <td><?= $this->Html->link($hunt->id, ['action' => 'huntView', $hunt->id]) ?></td>
                    <td><?= $this->Html->link($hunt->game->name, ['action' => 'gameView', $hunt->game->id]) ?></td>
                    <td><?= $hunt->name ?></td>
                    <td><?= $hunt->description ?></td>
                    <td><?= $this->Time->format($hunt->start_date, 'M/d/Y', 'Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->end_date, 'M/d/Y', 'End Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->voting_start_date, 'M/d/Y', 'Voting Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($hunt->voting_end_date, 'M/d/Y', 'Voting End Date Not Set', $timezone) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $this->element('paginator') ?>