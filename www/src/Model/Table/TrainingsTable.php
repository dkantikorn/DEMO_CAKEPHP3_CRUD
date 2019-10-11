<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Trainings Model
 *
 * @method \App\Model\Entity\Training get($primaryKey, $options = [])
 * @method \App\Model\Entity\Training newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Training[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Training|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Training patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Training[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Training findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TrainingsTable extends Table
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

        $this->setTable('trainings');
        $this->setDisplayField('id');
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
//            ->scalar('start_date')
//            ->allowEmpty('start_date');
//
//        $validator
//            ->scalar('finish_date')
//            ->allowEmpty('finish_date');
//
//        $validator
//            ->scalar('train_title')
//            ->allowEmpty('train_title');
//
//        $validator
//            ->scalar('train_place')
//            ->allowEmpty('train_place');
//
//        $validator
//            ->scalar('generation')
//            ->allowEmpty('generation');
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
