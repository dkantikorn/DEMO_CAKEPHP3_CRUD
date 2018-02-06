<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 *
 * Roles Controller
 * @author  pakgon.Ltd
 * @property \App\Model\Table\RolesTable $Roles
 * @method \App\Model\Entity\Role[] paginate($object = null, array $settings = [])
 * @since   2017-11-17 11:56:27
 * @license Pakgon.Ltd
 */
class RolesController extends AppController {

    /**
     *
     * Index method make list for Role.
     * @author  pakgon.Ltd
     * @return \Cake\Http\Response|void
     * @since   2017-11-17 11:56:27
     * @license Pakgon.Ltd
     */
    public function index() {
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     *
     * View method make for view information of Role.
     * @author  pakgon.Ltd
     * @param   string|null $id Role id.
     * @return  \Cake\Http\Response|void
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-17 11:56:27
     * @license Pakgon.Ltd
     */
    public function view($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     *
     * Add method make for insert or add new Role.
     * @author  pakgon.Ltd  
     * @return  \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @since   2017-11-17 11:56:27
     * @license Pakgon.Ltd
     */
    public function add() {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['create_uid'] = $this->getAuthUserId();
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }

        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

    /**
     *
     * Edit method make for update Role.
     * @author  pakgon.Ltd
     * @param   string|null $id Role id.
     * @return  \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws  \Cake\Network\Exception\NotFoundException When record not found.
     * @since   2017-11-17 11:56:27
     * @license Pakgon.Ltd
     */
    public function edit($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['update_uid'] = $this->getAuthUserId();
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }

        $this->set(compact('role'));
        $this->set('_serialize', ['role']);
    }

    /**
     *
     * Delete method make for delete record of Role.
     * @author  pakgon.Ltd
     * @param   string|null $id Role id.
     * @return  \Cake\Http\Response|null Redirects to index.
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-17 11:56:27
     * @license Pakgon.Ltd
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
