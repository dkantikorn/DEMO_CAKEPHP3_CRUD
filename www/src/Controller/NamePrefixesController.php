<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 *
 * NamePrefixes Controller
 * @author  pakgon.Ltd
 * @property \App\Model\Table\NamePrefixesTable $NamePrefixes
 * @method \App\Model\Entity\NamePrefix[] paginate($object = null, array $settings = [])
 * @since   2017-11-13 08:53:16
 * @license Pakgon.Ltd
 */
class NamePrefixesController extends AppController {

    /**
     *
     * Index method make list for Name Prefix.
     * @author  pakgon.Ltd
     * @return \Cake\Http\Response|void
     * @since   2017-11-13 08:53:16
     * @license Pakgon.Ltd
     */
    public function index() {

        //$data = $this->NamePrefixes->find()->all();
//        $data = $this->NamePrefixes->find();
//        foreach ($data as $k => $v) {
//            debug($v->name);
//        }
//
//        $data->each(function($nameprefixes) {
//            debug($nameprefixes->name);
//        });
//        
//        $tmpResultSet = $data->all();
//        debug($tmpResultSet);
//        
//        $tmpArr = $data->toArray();
//        debug($tmpArr);
//        
//        pj($tmpArr);
//        pj($data);
//        exit;
//        debug($data);
//        exit;

        $this->paginate = [
            'limit' => 1,
            'order' => ['NamePrefixes.name' => 'asc', 'NamePrefixes.name_eng' => 'asc'],
        ];

        $namePrefixes = $this->paginate($this->NamePrefixes);

        $this->set(compact('namePrefixes'));
        $this->set('_serialize', ['namePrefixes']);
    }

    /**
     *
     * View method make for view information of Name Prefix.
     * @author  pakgon.Ltd
     * @param   string|null $id Name Prefix id.
     * @return  \Cake\Http\Response|void
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-13 08:53:16
     * @license Pakgon.Ltd
     */
    public function view($id = null) {
        $namePrefix = $this->NamePrefixes->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('namePrefix', $namePrefix);
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     *
     * Add method make for insert or add new Name Prefix.
     * @author  pakgon.Ltd  
     * @return  \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @since   2017-11-13 08:53:16
     * @license Pakgon.Ltd
     */
    public function add() {
        $namePrefix = $this->NamePrefixes->newEntity();
        if ($this->request->is('post')) {
            $namePrefix = $this->NamePrefixes->patchEntity($namePrefix, $this->request->getData());
            if ($this->NamePrefixes->save($namePrefix)) {
                $this->Flash->success(__('The name prefix has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The name prefix could not be saved. Please, try again.'));
        }

        $this->set(compact('namePrefix'));
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     *
     * Edit method make for update Name Prefix.
     * @author  pakgon.Ltd
     * @param   string|null $id Name Prefix id.
     * @return  \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws  \Cake\Network\Exception\NotFoundException When record not found.
     * @since   2017-11-13 08:53:16
     * @license Pakgon.Ltd
     */
    public function edit($id = null) {
        $namePrefix = $this->NamePrefixes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $namePrefix = $this->NamePrefixes->patchEntity($namePrefix, $this->request->getData());
            if ($this->NamePrefixes->save($namePrefix)) {
                $this->Flash->success(__('The name prefix has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The name prefix could not be saved. Please, try again.'));
        }

        $this->set(compact('namePrefix'));
        $this->set('_serialize', ['namePrefix']);
    }

    /**
     *
     * Delete method make for delete record of Name Prefix.
     * @author  pakgon.Ltd
     * @param   string|null $id Name Prefix id.
     * @return  \Cake\Http\Response|null Redirects to index.
     * @throws  \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     * @since   2017-11-13 08:53:16
     * @license Pakgon.Ltd
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $namePrefix = $this->NamePrefixes->get($id);
        if ($this->NamePrefixes->delete($namePrefix)) {
            $this->Flash->success(__('The name prefix has been deleted.'));
        } else {
            $this->Flash->error(__('The name prefix could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
