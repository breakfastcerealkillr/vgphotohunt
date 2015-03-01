<?= $this->element('adminNav') ?>
<?= $this->Html->link('Add New', ['controller' => 'News', 'action' => 'adminAdd'], ['class' => 'btn btn-xs btn-info']) ?>
<div class="row">
    <div class="col-md-10 col-centered">
        <table class="table">
            <thead>
                <th><?= $this->Paginator->sort('id', 'ID'); ?></th>
                <th><?= $this->Paginator->sort('name', 'Name'); ?></th>
                <th>Body</th>
                <th>Picture</th>
                <th>Edit</th>
                <th>Delete?</th>
            </thead>
            <?php foreach ($news as $article): ?>
                <tr>
                    <td><?= $this->Html->link($article->id, ['controller' => 'News', 'action' => 'editAdmin', $article->id]) ?></td>
                    <td><?= $article->title ?></td>
                    <td><?= $this->Text->truncate($article->body, 50,array('ellipsis' => '...', 'exact' => false)) ?></td>
                    <td><?php if (!empty($article->pic_url)): ?>
                        <?= $this->Html->image('../newspics/' . $article->pic_url . '_100.png') ?>
                        <?php endif ?>
                    </td>
                    <td><?= $this->Html->link('Edit', ['controller' => 'News', 'action' => 'adminEdit', $article->id], ['class' => 'btn btn-xs btn-warning']) ?></td>
                    <td><?= $this->Html->link('Delete', ['controller' => 'News', 'action' => 'adminDelete', $article->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => 'Are you really sure?!']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($this->Paginator->counter('{{count}}') > $pageLimit) {echo $this->element('paginator');} ?>