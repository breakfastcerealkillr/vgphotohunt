<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Games Controller
 *
 * @property \App\Model\Table\GamesTable $Games
 */
class GamesController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function addAdmin() {
        $game = $this->Games->newEntity();
        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('The game has been saved.');
                return $this->redirect(['controller' => 'admin', 'action' => 'games']);
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        $this->set(compact('game'));
    }

    public function editAdmin($id = null) {

        $game = $this->Games->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('The game has been saved.');
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        $this->set(compact('game'));
    }
}
