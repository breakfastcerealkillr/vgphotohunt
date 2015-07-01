                               <div class="col-md-4 col-centered" style="min-width: 300px;">
                                   <?= $this->Form->create(null, ['url' => ['controller' => 'PictureComments', 'action' => 'add']]); ?>
                                   <?= $this->Form->hidden('picture_id', ['value' => $mpic->id]) ?>
                                   <?= $this->Form->hidden('user_id', ['value' => $user_id]) ?>
                                   <?= $this->Form->input('comment', ['autocomplete' => 'off']) ?>
                                   <?= $this->Form->button('Submit') ?>
                                   <?= $this->Form->end() ?>
                               </div>