<div class="container">
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <?php foreach ($sets as $set) : ?>
                    <tr>
                        <td><?= $set->name ?></td>
                        <td><?= $set->description ?></td>
                        <td><?= $set->set_start_date ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>