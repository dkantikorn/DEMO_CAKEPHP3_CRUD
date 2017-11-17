<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 *
 * Menus Controller
 * @author  pakgon.Ltd
 * @property \App\Model\Table\MenusTable $Menus
 * @method \App\Model\Entity\Menu[] paginate($object = null, array $settings = [])
 * @since   2017-11-17 11:54:49
 * @license Pakgon.Ltd
 */
 
class MenusController extends AppController {

    /**
     *
     * Index method make list for Menu.
     * @author  pakgon.Ltd
     * @return \Cake\Http\Response|void
     * @since   2017-11-17 11:54:49
     * @license Pakgon.Ltd
     */
    public function index() {
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
        $this->set('_serialize', ['menus']);
    }

    /**
     *
     * View method make for view information of Menu.
     * @author  pakgon.Ltd
     * @param   string|null $id Menu id.
     * @return  \Cake\Http\Response|void
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-17 11:54:49
     * @license Pakgon.Ltd
     */
    public function view($id = null) {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);

        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     *
     * Add method make for insert or add new Menu.
     * @author  pakgon.Ltd  
     * @return  \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @since   2017-11-17 11:54:49
     * @license Pakgon.Ltd
     */
    public function add() {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        
        $this->set(compact('menu'));
        $this->set('_serialize', ['menu']);
    }

    /**
     *
     * Edit method make for update Menu.
     * @author  pakgon.Ltd
     * @param   string|null $id Menu id.
     * @return  \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws  \Cake\Network\Exception\NotFoundException When record not found.
     * @since   2017-11-17 11:54:49
     * @license Pakgon.Ltd
     */
    public function edit($id = null) {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->getData());
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The menu could not be saved. Please, try again.'));
        }
        
        $this->set(compact('menu'));
        $this->set('_serialize', ['menu']);
    }

    /**
     *
     * Delete method make for delete record of Menu.
     * @author  pakgon.Ltd
     * @param   string|null $id Menu id.
     * @return  \Cake\Http\Response|null Redirects to index.
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-17 11:54:49
     * @license Pakgon.Ltd
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
