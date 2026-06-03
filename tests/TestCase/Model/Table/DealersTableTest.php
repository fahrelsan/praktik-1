<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DealersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DealersTable Test Case
 */
class DealersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DealersTable
     */
    protected $Dealers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Dealers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Dealers') ? [] : ['className' => DealersTable::class];
        $this->Dealers = $this->getTableLocator()->get('Dealers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Dealers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\DealersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
