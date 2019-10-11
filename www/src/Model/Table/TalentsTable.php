<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Talents Model
 *
 * @method \App\Model\Entity\Talent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Talent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Talent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Talent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Talent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Talent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Talent findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TalentsTable extends Table
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

        $this->setTable('talents');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
//        $validator
//            ->allowEmpty('id', 'create');
//
//        $validator
//            ->scalar('card_no')
//            ->allowEmpty('card_no');
//
//        $validator
//            ->scalar('order_no')
//            ->allowEmpty('order_no');
//
//        $validator
//            ->scalar('issue_date')
//            ->allowEmpty('issue_date');
//
//        $validator
//            ->scalar('name')
//            ->allowEmpty('name');
//
//        $validator
//            ->scalar('recheck')
//            ->allowEmpty('recheck');
//
//        $validator
//            ->scalar('source_file')
//            ->allowEmpty('source_file');
//
//        $validator
//            ->scalar('remark')
//            ->allowEmpty('remark');

        return $validator;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'master';
    }
}
