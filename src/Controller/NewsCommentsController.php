<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * NewsComments Controller
 *
 * @property \App\Model\Table\NewsCommentsTable $NewsComments
 */
class NewsCommentsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    
    public function add() {
        $nc = $this->NewsComments->newEntity();

        if ($this->request->is('post')) {
            $nc = $this->NewsComments->patchEntity($nc, $this->request->data);
            if ($this->NewsComments->save($nc)) {
                $this->Flash->success('The comment has been saved.');
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }
    }
    
    public function adminAdd() {
        
	$this->adminOnly();

        $nc = $this->NewsComments->newEntity();

        if ($this->request->is('post')) {
            $nc = $this->NewsComments->patchEntity($nc, $this->request->data);
            if ($this->NewsComments->save($nc)) {
                $this->Flash->success('The comment has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'newsComments']);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }
        
        $this->set('news', $this->NewsComments->News->find('list'));
        $this->set('users', $this->NewsComments->Users->find('list'));
    }
    
    public function adminEdit($id = null) {

	$this->adminOnly();

        $newscomment = $this->NewsComments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newscomment = $this->NewsComments->patchEntity($newscomment, $this->request->data);
            if ($this->NewsComments->save($newscomment)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }
        $this->set('newscomment', $newscomment);
        $this->set('news', $this->NewsComments->News->find('list'));
        $this->set('users', $this->NewsComments->Users->find('list'));
    }
    
    public function adminDelete($id = null) {

	$this->adminOnly();

        $entity = $this->NewsComments->get($id);
        if ($this->NewsComments->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
}
