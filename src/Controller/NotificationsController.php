<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;

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
                $this->Flash->error('The notification could not be saved. Please, try again. ');
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
    
    public function index() {
        
        //If user is not logged in, it redirects to the front page.
        if (empty($this->user_id)) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        
        //Paginate all the user's notifications.
        
        $query = $this->Notifications->find('all')
            ->order(['Notifications.timestamp' => 'DESC'])
            ->where(['user_id' => $this->user_id]);

        $this->set('notifications', $this->paginate($query));
        $this->set('pageLimit', 20);
    }
    
    public function read($nid) {
        
        //Grab notification that's going to be read.
        $entity = $this->Notifications->get($nid);
        
        // Check to make sure the user is able to modify the notification
        if ($this->user_id == $entity->user_id) {
            
            $entity->is_read = 1;
            if ($this->Notifications->save($entity)) {
                $this->Flash->success('Notification marked as read.');
                return $this->redirect(Router::url('/', true) . $entity->url);
            } else {
                $this->Flash->error('The notification could not be saved. Please, try again.');
            }
        }
        else {
            $this->Flash->error('Ensure you are signed into the correct account...');
            return $this->redirect($this->referer);
        }
    }
    
    public function markAll() {
        // Check to make sure the user is able to modify the notification
        if ($this->user_id) {
            $query = $this->Notifications->findUnread($this->user_id)->all();
            foreach($query as $entity) {
                $entity->is_read = 1;
                if ($this->Notifications->save($entity)) {
                    
                } else {
                    $this->Flash->error('The notification could not be saved. Please, try again.');
                    return $this->redirect(['controller' => 'Notifications', 'action' => 'index']);
                }
            }
            $this->Flash->success('Notifications marked as read.');
            return $this->redirect(['controller' => 'Notifications', 'action' => 'index']);
        }
        else {
            $this->Flash->error('Ensure you are signed into the correct account...');
            return $this->redirect(['controller' => 'Notifications', 'action' => 'index']);
        }
    }
}
