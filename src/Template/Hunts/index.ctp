<div class="row">
    <div class="col-md-2">
        <?= $this->element('sidebar') ?>
    </div>
    <div class="col-md-10">
        <table class="table">
            <thead>
            <th>
                Status
            </th>
            <th>
                Game
            </th>
            <th>
                Set Name
            </th>
            <th>
                Description
            </th>
            <th>
                Start Date
            </th>
            <th>
                End Date
            </th>
            <th>
                Voting Start Date
            </th>
            <th>
                Voting End Date
            </th>
            <th>
                Winner
            </th>
            </thead>
            <?php foreach ($hunts as $hunt) : ?>
                <?php if (!$hunt->hidden): ?>
                    <tr>
                        <td><?= $hunt->status ?></td>
                        <td><?= $hunt->game->name ?></td>
                        <td><?= $this->Html->link($hunt->name, ['controller' => 'hunts', 'action' => 'view', $hunt->id]) ?></td>
                        <td><?= $hunt->description ?></td>
                        <td><?= $this->Time->format($hunt->start_date, 'M/d/Y', 'Start Date Not Set', $timezone) ?></td>
                        <td><?= $this->Time->format($hunt->end_date, 'M/d/Y', 'End Date Not Set', $timezone) ?></td>
                        <td><?= $this->Time->format($hunt->voting_start_date, 'M/d/Y', 'Voting Start Date Not Set', $timezone) ?></td>
                        <td><?= $this->Time->format($hunt->voting_end_date, 'M/d/Y', 'Voting End Date Not Set', $timezone) ?></td>
                        <td><?= $hunt->winner_id ?></td>
                    </tr>
                <?php endif ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>
