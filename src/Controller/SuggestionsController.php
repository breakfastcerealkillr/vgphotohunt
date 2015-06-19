<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Suggestions Controller
 *
 * @property \App\Model\Table\SuggestionsTable $Suggestions
 */
class SuggestionsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
		$this->adminOnly();

        $suggestion = $this->Suggestions->newEntity();

        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success('The suggestion has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'suggestions']);
            } else {
                $this->Flash->error('The suggestion could not be saved. Please, try again.');
            }
        }
        $this->loadModel('Users');
        $this->set('users', $this->Users->find('list'));
    }
    
    public function adminEdit($id = null) {

		$this->adminOnly();

        $suggestion = $this->Suggestions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The suggestion could not be saved. Please, try again.');
            }
        }
        $this->set('suggestion', $suggestion);
        $this->loadModel('Users');
        $this->set('users', $this->Users->find('list'));
    }
    
    public function adminDelete($id = null) {

		$this->adminOnly();

        $entity = $this->Suggestions->get($id);
        if ($this->Suggestions->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
    
    public function add() {
        
        $suggestion = $this->Suggestions->newEntity();
        
        
        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $this->Flash->success('Your feedback has been saved. Thank you!');
                return $this->redirect(['controller' => 'Pages' ,'action' => 'index']);
            } else {
                $this->Flash->error('The suggestion could not be saved. Please, try again.');
            }
        }
        
    }
}
