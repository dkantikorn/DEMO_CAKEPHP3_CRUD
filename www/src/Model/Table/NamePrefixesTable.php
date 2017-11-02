<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NamePrefixes Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\NamePrefix get($primaryKey, $options = [])
 * @method \App\Model\Entity\NamePrefix newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NamePrefix[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NamePrefix|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NamePrefix patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NamePrefix[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NamePrefix findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NamePrefixesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('name_prefixes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'name_prefix_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('name_eng')
            ->allowEmpty('name_eng');

        $validator
            ->scalar('long_name')
            ->requirePresence('long_name', 'create')
            ->notEmpty('long_name');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('create_uid')
            ->requirePresence('create_uid', 'create')
            ->notEmpty('create_uid');

        $validator
            ->integer('update_uid')
            ->allowEmpty('update_uid');

        $validator
            ->integer('order_no')
            ->requirePresence('order_no', 'create')
            ->notEmpty('order_no');

        return $validator;
    }
}
