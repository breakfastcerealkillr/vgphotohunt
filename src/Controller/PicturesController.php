<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Pictures Controller
 *
 * @property \App\Model\Table\PicturesTable $Pictures
 */
class PicturesController extends AppController {

    public function adminAdd() {

        $this->adminOnly();

        $picture = $this->Pictures->newEntity();

        if ($this->request->is('post')) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $this->Flash->success('The picture has been saved.');
                return $this->redirect(['controller' => 'Admin', 'action' => 'Pictures']);
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

    public function addSub() {

        $this->loadModel('Users');

        if (!$this->Users->isVerified($this->user_id)) {
            $this->Flash->error('Please verify your email before submitting.');
            return $this->redirect($this->referer());
        }

        $picture = $this->Pictures->newEntity();

        if ($this->request->is('post') && $this->request->data['user_id'] == $this->user_id) {
            $picture = $this->Pictures->patchEntity($picture, $this->request->data);
            if ($this->Pictures->save($picture)) {
                $added = $this->Pictures->Users->addXP($this->user_id, 5);
                if ($added == 1) {
                    $this->Flash->success('The picture has been saved.');
                } elseif ($added == 2) {
                    $this->Flash->levelup('Grats! You\'ve leveled up!');
                }
                return $this->redirect($this->referer());
            } else {
                $this->Flash->error('The picture could not be saved. Please, try again.');
                return $this->redirect($this->referer());
            }
        }
    }

}
