<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
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
                        <td><?= $set->game->name ?></td>
                        <td><?= $this->Html->link($set->name, ['controller' => 'sets', 'action' => 'view', $set->id]) ?></td>
                        <td><?= $set->description ?></td>
                        <td><?= $set->set_start_date ?></td>
                        <td><?= $set->set_end_date ?></td>
                        <td><?= $set->voting_start_date ?></td>
                        <td><?= $set->voting_end_date ?></td>
                        <td><?= $set->winner_id ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>