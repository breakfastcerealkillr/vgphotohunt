<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->paginate = [];
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {

        $this->loadModel('Pictures');

        $user = $this->Users->get($id, [
            'contain' => ['Pictures']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);

        $pictures_count = $this->Pictures->find()->where(['Pictures.user_id' => $id])->count();
        $this->set('pictures_count', $pictures_count);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
//    public function add() {
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//            $user = $this->Users->patchEntity($user, $this->request->data);
//            if ($this->Users->save($user)) {
//                $this->Flash->success('The user has been saved.');
//                return $this->redirect(['action' => 'index']);
//            } else {
//                $this->Flash->error('The user could not be saved. Please, try again.');
//            }
//        }
//        $steams = $this->Users->Steams->find('list', ['limit' => 200]);
//        $this->set(compact('user', 'steams'));
//        $this->set('_serialize', ['user']);
//    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        if ($id != $this->user_id) {
            return $this->redirect([$this->user_id]);
        }

        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set('user', $user);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login() {

        if (isset($this->user_id)) {
            return $this->redirect('/');
        }

        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Users->lastLogin($user['id']);
                $this->Flash->success('Logged In!');
                return $this->redirect('/');
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->Auth->logout();
        return $this->redirect($this->referer());
    }

    public function register() {

        $this->loadComponent('Password');

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            /*
             * I was going to use Cake's built in validation system to authenticate
             * the password form (with repeat password), but became quickly frustrated with it
             * and the lack of documentation. Here's a system I implemented on a 
             * Cake 2 build. Hopefully this goes away in the future. -EH
             */
            if (!empty($this->request->data['password']) && !empty($this->request->data['password_confirm'])) {
                $pass_validate = $this->Password->validate($this->request->data['password'], $this->request->data['password_confirm']);
            } else {
                $this->Flash->error("Please Fill Out the Entire Form");
                return;
            }

            if ($pass_validate != "OK") {
                $this->Flash->error($pass_validate);
                return;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success('Registration Successful');
                return $this->redirect('/');
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
    }
    
    public function adminAdd() {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['controller' => 'Admin' ,'action' => 'users']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
    }
    
    public function adminEdit($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set('user', $user);
        
    }
    
    public function adminDelete($id = null) {
        if ($this->Auth->user('roles') != "admin") {
            return $this->redirect(['controller' => 'admin', 'action' => 'dashboard']);
        }

  
        $user = $this->Users->get($id);

        $user->enabled = 0;

        if ($this->Users->save($user)) {
            $this->Flash->success('User is disabled!');
        } else {
            $this->Flash->success('Failed!');
        }

        return $this->redirect($this->referer());
        
    }
    
    public function deleteAvatar() {

        $user = $this->Users->get($this->user_id);

        foreach (glob('avatars/' . $user->avatar . '*') as $file) {
            unlink($file);
            debug($file);
        }

        $user->avatar = null;

        if ($this->Users->save($user)) {
            $this->Flash->success('Deleted!');
        } else {
            $this->Flash->success('Failed!');
        }

        return $this->redirect($this->referer());
    }
    


}
