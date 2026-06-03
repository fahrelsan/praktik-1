<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dealers Model
 *
 * @method \App\Model\Entity\Dealer newEmptyEntity()
 * @method \App\Model\Entity\Dealer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Dealer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dealer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Dealer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Dealer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Dealer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dealer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Dealer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Dealer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dealer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dealer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dealer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dealer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dealer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Dealer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Dealer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DealersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('dealers');
        $this->setDisplayField('nama');
        $this->setPrimaryKey('id_dealer');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nama')
            ->maxLength('nama', 255)
            ->requirePresence('nama', 'create')
            ->notEmptyString('nama');

        $validator
            ->scalar('alamat')
            ->maxLength('alamat', 255)
            ->allowEmptyString('alamat');

        $validator
            ->integer('no_telp')
            ->allowEmptyString('no_telp');

        $validator
            ->integer('no_hp')
            ->allowEmptyString('no_hp');

        return $validator;
    }
}
