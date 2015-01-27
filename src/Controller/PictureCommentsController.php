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
        $pictureComment = $this->PictureComments->newEntity();
        if ($this->request->is('post')) {
            $pictureComment = $this->PictureComments->patchEntity($pictureComment, $this->request->data);
            if ($this->PictureComments->save($pictureComment)) {
                $this->Flash->success('The picture comment has been saved.');
            } else {
                $this->Flash->error('The picture comment could not be saved. Please, try again.');
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

}
