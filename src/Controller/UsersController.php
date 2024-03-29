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
        $this->loadModel('Marks');
        $this->loadModel('Votes');
        $this->loadModel('PictureComments');
        $this->loadModel('NewsComments');

        $user = $this->Users->get($id);
        $this->set('user', $user);

        $this->set('latest', $this->Pictures->findByUser($id));

        // Aggregates, yay!
        $this->set('pictures_count', $this->Pictures->find()->where(['Pictures.user_id' => $id])->count());
        $this->set('wins', $this->Marks->findWins($id)->count());
        $this->set('totalvotes', $this->Votes->find()->where(['Votes.user_id' => $id])->count());
        $this->set('totalcomments', $this->PictureComments->find()->where(['user_id' => $id])->count() + $this->NewsComments->find()->where(['user_id' => $id])->count());
        $this->set('sumvotes', $this->Pictures->tallyVotes($id));
    }

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

            if ($this->request->data['Users']['email'] !== $user->email) {
                $email_changed = true;
            }

            $user = $this->Users->patchEntity($user, $this->request->data);
            $save = $this->Users->save($user);

            if ($save) {
                if (isset($email_changed)) {
                    $this->loadModel('Emails');
                    $this->Emails->welcome($user->id);
                    $this->Flash->success('Saved! Please reconfirm your new email.');
                } else {
                    $this->Flash->success('Saved!');
                }
                return $this->redirect(['action' => 'view', $id]);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
        $this->set('user', $user);
        $this->set('awards', $this->Users->Awards->findPortraits($id));
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
        $this->loadModel('Emails');

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
                $pass_validate = $this->Password->validate($this->request->data['password'], $this->request->data['password_confirm'], $this->request->data['email']);
            } else {
                $this->Flash->error("Please Fill Out the Entire Form");
                return;
            }

            if ($pass_validate != "OK") {
                $this->Flash->error($pass_validate);
                return;
            }

            $result = $this->Users->save($user);

            if ($result) {
                $this->Emails->welcome($result->id);
                $this->Flash->success('Registration Successful. Please check your email for a verification URL.');
                return $this->redirect('/');
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
    }

    public function registered() {
        
    }

    public function adminAdd() {

        $this->adminOnly();

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['controller' => 'Admin', 'action' => 'users']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }
    }

    public function adminEdit($id) {

        $this->adminOnly();

        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Saved!');
                return $this->redirect(['action' => 'adminEdit', $id]);
            } else {
                $this->Flash->error('The user could not be saved.');
            }
        }
        $this->set('user', $user);
    }

    public function adminDelete($id = null) {

        $this->adminOnly();


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

    public function verify($token) {

        if (!isset($token)) {
            $this->redirect('/');
        }

        if ($this->Users->verify($token)) {
            $this->Flash->success('Account Verified! You may do fancy things now.');
        } else {
            $this->Flash->error('Error!');
        }

        return $this->redirect($this->referer());
    }

    public function forgotPass() {

        if ($this->request->is('post')) {

            $this->loadModel('Emails');
            if ($this->Emails->resetPass($this->request->data['email'])) {
                $this->Flash->success('Please check your email for your reset link.');
            } else {
                $this->Flash->error('Email address not found');
            }
            return $this->redirect($this->referer());
        }
    }

    public function resetPass($token) {

        $this->loadComponent('Password');

        if (!isset($token)) {
            return $this->redirect('/');
        }

        $user = $this->Users->findByToken($token);

        if (!isset($user)) {
            $this->Flash->error('Sorry, this token is invalid. Please reset your password again.');
            return $this->redirect('/');
        }

        $this->set('user', $user);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            /*
             * I was going to use Cake's built in validation system to authenticate
             * the password form (with repeat password), but became quickly frustrated with it
             * and the lack of documentation. Here's a system I implemented on a 
             * Cake 2 build. Hopefully this goes away in the future. -EH
             */
            if (!empty($this->request->data['Users']['password']) && !empty($this->request->data['Users']['password_confirm'])) {
                $pass_validate = $this->Password->validate($this->request->data['Users']['password'], $this->request->data['Users']['password_confirm']);
            } else {
                $this->Flash->error("Please Fill Out the Entire Form");
                return;
            }

            if ($pass_validate != "OK") {
                $this->Flash->error($pass_validate);
                return;
            }

            $result = $this->Users->save($user);

            if ($result) {
                $this->Flash->success('Password reset. Please log in with your new password.');
            } else {
                $this->Flash->error('Error Resetting Password. Plz try again.');
                return $this->redirect($this->referer());
            }
            return $this->redirect('/');
        }
    }

}
