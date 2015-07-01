<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController {

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function adminAdd() {
        
		$this->adminOnly();

        $notification = $this->Notifications->newEntity();

        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success('The notification has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'notifications']);
            } else {
                $this->Flash->error('The notification could not be saved. Please, try again.');
            }
        }
        $this->loadModel('Users');
        $this->set('users', $this->Users->find('list'));
    }
    
    public function adminEdit($id = null) {

		$this->adminOnly();

        $notification = $this->Notifications->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The notification could not be saved. Please, try again.');
            }
        }
        $this->set('notification', $notification);
        $this->loadModel('Users');
        $this->set('users', $this->Users->find('list'));
    }
    
    public function adminDelete($id = null) {

		$this->adminOnly();

        $entity = $this->Notifications->get($id);
        if ($this->Notifications->delete($entity)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->error('Failed!');
        }

        return $this->redirect($this->referer());    
    }
    
}
