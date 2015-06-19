<div class="btn-toolbar" role="toolbar">
    <div class="btn-group" role="group">
        <?= $this->Html->link('Games', ['controller' => 'Admin', 'action' => 'games'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Hunts', ['controller' => 'Admin', 'action' => 'hunts'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Marks', ['controller' => 'Admin', 'action' => 'marks'], ['class' => 'btn btn-default']) ?>
    </div>
    <div class="btn-group" role="group">
        <?= $this->Html->link('Users', ['controller' => 'Admin', 'action' => 'users'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Submissions', ['controller' => 'Admin', 'action' => 'pictures'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Picture Comments', ['controller' => 'Admin', 'action' => 'pictureComments'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Votes', ['controller' => 'Admin', 'action' => 'votes'], ['class' => 'btn btn-default']) ?>
    </div>
    <div class="btn-group" role="group">
        <?= $this->Html->link('News', ['controller' => 'Admin', 'action' => 'news'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('News Comments', ['controller' => 'Admin', 'action' => 'newsComments'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Portraits', ['controller' => 'Admin', 'action' => 'portraits'], ['class' => 'btn btn-default']) ?>
        <?= $this->Html->link('Awards', ['controller' => 'Admin', 'action' => 'awards'], ['class' => 'btn btn-default']) ?>
    </div>
    <div class="btn-group" role="group">
        <?= $this->Html->link('Suggestions', ['controller' => 'Admin', 'action' => 'suggestions'], ['class' => 'btn btn-default']) ?>
    </div>
</div>