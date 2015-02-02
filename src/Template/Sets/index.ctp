<div class="row">
    <div class="col-md-12">
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
            <?php foreach ($sets as $set) : ?>
                <tr>
                    <td><?= $set->status ?></td>
                    <td><?= $set->game->name ?></td>
                    <td><?= $this->Html->link($set->name, ['controller' => 'sets', 'action' => 'view', $set->id]) ?></td>
                    <td><?= $set->description ?></td>
                    <td><?= $this->Time->format($set->set_start_date, 'M/d/Y', 'Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($set->set_end_date, 'M/d/Y', 'End Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($set->voting_start_date, 'M/d/Y', 'Voting Start Date Not Set', $timezone) ?></td>
                    <td><?= $this->Time->format($set->voting_end_date, 'M/d/Y', 'Voting End Date Not Set', $timezone) ?></td>
                    <td><?= $set->winner_id ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
