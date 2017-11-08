<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $SysControllers
 * @property |\Cake\ORM\Association\BelongsTo $SysActions
 * @property |\Cake\ORM\Association\BelongsTo $MenuParents
 *
 * @method \App\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \App\Model\Entity\Menu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Menu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Menu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Menu findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenusTable extends Table
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

        $this->setTable('menus');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsTo('SysControllers', [
//            'foreignKey' => 'sys_controller_id'
//        ]);
//        $this->belongsTo('SysActions', [
//            'foreignKey' => 'sys_action_id'
//        ]);
//        $this->belongsTo('MenuParents', [
//            'foreignKey' => 'menu_parent_id',
//            'joinType' => 'INNER'
//        ]);
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->allowEmpty('name');

        $validator
            ->scalar('name_eng')
            ->allowEmpty('name_eng');

        $validator
            ->scalar('glyphicon')
            ->allowEmpty('glyphicon');

        $validator
            ->scalar('domain')
            ->allowEmpty('domain');

        $validator
            ->scalar('port')
            ->allowEmpty('port');

        $validator
            ->scalar('url')
            ->allowEmpty('url');

        $validator
            ->allowEmpty('order_display');

        $validator
            ->requirePresence('child_no', 'create')
            ->notEmpty('child_no');

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
            ->scalar('badge')
            ->allowEmpty('badge');

        $validator
            ->integer('page_level')
            ->requirePresence('page_level', 'create')
            ->notEmpty('page_level');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['sys_controller_id'], 'SysControllers'));
//        $rules->add($rules->existsIn(['sys_action_id'], 'SysActions'));
//        $rules->add($rules->existsIn(['menu_parent_id'], 'MenuParents'));
//
//        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'system';
    }
}
