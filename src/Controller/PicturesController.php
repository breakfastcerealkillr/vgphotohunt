<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Pictures Controller
 *
 * @property \App\Model\Table\PicturesTable $Pictures
 */
class PicturesController extends AppController {

    /**
     * View method
     *
     * @param string|null $id Picture id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $picture = $this->Pictures->viewWithStatus($id);
        $this->set('picture', $picture);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $picture = $this->Pictures->newEntity();
        if ($this->request->is('post')) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
            return $this->redirect($this->referer());
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Picture id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $picture = $this->Pictures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
        }
        $users = $this->Pictures->Users->find('list', ['limit' => 200]);
        $sets = $this->Pictures->Sets->find('list', ['limit' => 200]);
        $this->set(compact('picture', 'users', 'sets'));
        $this->set('_serialize', ['picture']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Picture id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $picture = $this->Pictures->get($id);
        if ($this->Pictures->delete($picture)) {
            $this->Flash->success('The picture has been deleted.');
        } else {
            $this->Flash->error('The picture could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function adminAdd() {
        
	$this->adminOnly();

        $picture = $this->Pictures->newEntity();

        if ($this->request->is('post')) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'Pictures']);
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
        }
        $this->set('users', $this->Pictures->Users->find('list'));
        $this->set('marks', $this->Pictures->Marks->find('list'));
    }
    
    public function adminEdit($id) {

        $picture = $this->Pictures->get($id, [
            'contain' => ['PictureComments.Users', 'Marks', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
            }
        }
        
        $this->set('picture', $picture);
        $this->set('users', $this->Pictures->Users->find('list'));
        $this->set('marks', $this->Pictures->Marks->find('list'));
    }

    public function adminDelete($id = null) {
        $this->adminOnly();
        
        $picture = $this->Pictures->get($id);
        
        $this->Pictures->deleteFiles($id);
        
        if ($this->Pictures->delete($picture)) {
            $this->Flash->success('The picture has been deleted.');
            return $this->redirect(['controller' => 'admin', 'action' => 'pictures']);
        } else {
            $this->Flash->error('The picture could not be deleted. Please, try again.');
            return $this->redirect($this->referer());
        }
    }

}
