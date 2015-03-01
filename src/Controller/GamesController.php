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
    public function adminAdd() {
        
		$this->adminOnly();

        $game = $this->Games->newEntity();

        if ($this->request->is('post')) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('The game has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'games']);
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        
    }
    
    public function adminEdit($id = null) {

		$this->adminOnly();

        $game = $this->Games->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $game = $this->Games->patchEntity($game, $this->request->data);
            if ($this->Games->save($game)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The game could not be saved. Please, try again.');
            }
        }
        $this->set('game', $game);
    }
    
    public function adminDelete($id = null) {

		$this->adminOnly();

        $entity = $this->Games->get($id);
        if ($this->Games->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
}
