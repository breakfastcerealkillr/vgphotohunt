<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Portraits Controller
 *
 * @property \App\Model\Table\PortraitsTable $Portraits
 */
class PortraitsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
		$this->adminOnly();

        $portrait = $this->Portraits->newEntity();

        if ($this->request->is('post')) {
            $portrait = $this->Portraits->patchEntity($portrait, $this->request->data);
            if ($this->Portraits->save($portrait)) {
                $this->Flash->success('The portrait has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'portraits']);
            } else {
                $this->Flash->error('The portrait could not be saved. Please, try again.');
            }
        }
        
    }
    
    public function adminEdit($id = null) {

		$this->adminOnly();

        $portrait = $this->Portraits->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $portrait = $this->Portraits->patchEntity($portrait, $this->request->data);
            if ($this->Portraits->save($portrait)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The portrait could not be saved. Please, try again.');
            }
        }
        $this->set('portrait', $portrait);
    }
    
    public function adminDelete($id = null) {

		$this->adminOnly();

        $entity = $this->Portraits->get($id);
        if ($this->Portraits->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
    
    public function deletePortraitPic($id = null) {

        $portraitpic = $this->Portraits->get($id);

        foreach (glob('portraits/' . $portraitpic->pic_url . '*') as $file) {
            unlink($file);
            debug($file);
        }

        $portraitpic->pic_url = null;

        if ($this->Portraits->save($portraitpic)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());
    }
    
}
