<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Educationals Model
 *
 * @method \App\Model\Entity\Educational get($primaryKey, $options = [])
 * @method \App\Model\Entity\Educational newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Educational[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Educational|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Educational patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Educational[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Educational findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EducationalsTable extends Table
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

        $this->setTable('educationals');
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
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('card_no')
            ->allowEmpty('card_no');

        $validator
            ->scalar('order_no')
            ->allowEmpty('order_no');

        $validator
            ->scalar('school_name')
            ->allowEmpty('school_name');

        $validator
            ->scalar('edu_background')
            ->allowEmpty('edu_background');

        $validator
            ->scalar('major')
            ->allowEmpty('major');

        $validator
            ->scalar('from_year')
            ->allowEmpty('from_year');

        $validator
            ->scalar('finish_year')
            ->allowEmpty('finish_year');

        $validator
            ->scalar('recheck')
            ->allowEmpty('recheck');

        $validator
            ->scalar('source_file')
            ->allowEmpty('source_file');

        $validator
            ->scalar('remark')
            ->allowEmpty('remark');

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
