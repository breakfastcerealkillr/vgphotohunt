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
    
    public function view($id = null) {
        
        if ($id != null) {
            $game = $this->Games->get($id);
            $this->set('game', $game);
            
            $this->loadModel('Hunts');
            $this->set('openhunts', $this->Hunts->findOpenHunts($id));
            $this->set('openvotes', $this->Hunts->findOpenVotes($id));
            $this->set('pasthunts', $this->Hunts->findPastHunts($id));
            
            $this->loadModel('Pictures');
            $this->set('pics', $this->Pictures->findByGame($id));
        }
        else {
            $this->set('list', $this->Games->find('all'));
        }
    }
    
    public function deleteGamePic($id = null) {

        $gamepic = $this->Games->get($id);

        foreach (glob('gamepics/' . $gamepic->pic_url . '*') as $file) {
            unlink($file);
            debug($file);
        }

        $gamepic->pic_url = 'default';

        if ($this->Games->save($gamepic)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());
    }
}
