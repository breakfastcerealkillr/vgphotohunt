<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * PictureComments Controller
 *
 * @property \App\Model\Table\PictureCommentsTable $PictureComments
 */
class PictureCommentsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
<<<<<<< HEAD
        if($this->user_id == $this->request->data['user_id']) {
        $pictureComment = $this->PictureComments->newEntity();
        if ($this->request->is('post')) {
            $pictureComment = $this->PictureComments->patchEntity($pictureComment, $this->request->data);
            if ($this->PictureComments->save($pictureComment)) {
                //Get a query of the related picture, mark, and hunt
                $this->loadModel('Pictures');
                $query = $this->Pictures->get($pictureComment->picture_id, [
                    'contain' => ['Marks.Hunts']
                ]);
                
                //Check to make sure the user can't give themselves notifications
                if ($this->user_id != $query->user_id) {
                    $this->loadModel('Notifications');
                    $this->Notifications->add($query->user_id,'huntcomment',$query->mark->hunt->id, $query->mark->name);
                }
                
                $this->Flash->success('The picture comment has been saved.');
            } else {
                $this->Flash->error('The picture comment could not be saved. Please, try again.');
            }
=======

        $this->loadModel('Users');

        if (!$this->Users->isVerified($this->user_id)) {
            $this->Flash->error('Please verify your email before commenting.');
            return $this->redirect($this->referer());
>>>>>>> master
        }

        if ($this->user_id == $this->request->data['user_id']) {
            $pictureComment = $this->PictureComments->newEntity();
            if ($this->request->is('post')) {
                $pictureComment = $this->PictureComments->patchEntity($pictureComment, $this->request->data);
                if ($this->PictureComments->save($pictureComment)) {
                    $this->Flash->success('The picture comment has been saved.');
                } else {
                    $this->Flash->error('The picture comment could not be saved. Please, try again.');
                }
            }
        }

        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Picture Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $pictureComment = $this->PictureComments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pictureComment = $this->PictureComments->patchEntity($pictureComment, $this->request->data);
            if ($this->PictureComments->save($pictureComment)) {
                $this->Flash->success('The picture comment has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The picture comment could not be saved. Please, try again.');
            }
        }
        $pictures = $this->PictureComments->Pictures->find('list', ['limit' => 200]);
        $users = $this->PictureComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('pictureComment', 'pictures', 'users'));
        $this->set('_serialize', ['pictureComment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Picture Comment id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pictureComment = $this->PictureComments->get($id);
        if ($this->PictureComments->delete($pictureComment)) {
            $this->Flash->success('The picture comment has been deleted.');
        } else {
            $this->Flash->error('The picture comment could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function adminAdd() {

        $this->adminOnly();

        $pc = $this->PictureComments->newEntity();

        if ($this->request->is('post')) {
            $pc = $this->PictureComments->patchEntity($pc, $this->request->data);
            if ($this->PictureComments->save($pc)) {
                $this->Flash->success('The comment has been saved.');
                return $this->redirect(['controller' => 'Admin', 'action' => 'PictureComments']);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }

        $this->set('pictures', $this->PictureComments->Pictures->find('list'));
        $this->set('users', $this->PictureComments->Users->find('list'));
    }

    public function adminEdit($id = null) {

        $this->adminOnly();

        $pictureComment = $this->PictureComments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pictureComment = $this->PictureComments->patchEntity($pictureComment, $this->request->data);
            if ($this->PictureComments->save($pictureComment)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }

        $this->set('pictureComment', $pictureComment);
        $this->set('pictures', $this->PictureComments->Pictures->find('list'));
    }

    public function adminDelete($id = null) {

        $this->adminOnly();

        $entity = $this->PictureComments->get($id);
        if ($this->PictureComments->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());
    }

}
