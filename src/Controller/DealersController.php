<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dealers Controller
 *
 * @property \App\Model\Table\DealersTable $Dealers
 */
class DealersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Dealers->find();
        $dealers = $this->paginate($query);

        $this->set(compact('dealers'));
    }

    /**
     * View method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dealer = $this->Dealers->get($id, contain: []);
        $this->set(compact('dealer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dealer = $this->Dealers->newEmptyEntity();
        if ($this->request->is('post')) {
            $dealer = $this->Dealers->patchEntity($dealer, $this->request->getData());
            if ($this->Dealers->save($dealer)) {
                $this->Flash->success(__('The dealer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dealer could not be saved. Please, try again.'));
        }
        $this->set(compact('dealer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dealer = $this->Dealers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dealer = $this->Dealers->patchEntity($dealer, $this->request->getData());
            if ($this->Dealers->save($dealer)) {
                $this->Flash->success(__('The dealer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dealer could not be saved. Please, try again.'));
        }
        $this->set(compact('dealer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dealer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dealer = $this->Dealers->get($id);
        if ($this->Dealers->delete($dealer)) {
            $this->Flash->success(__('The dealer has been deleted.'));
        } else {
            $this->Flash->error(__('The dealer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
