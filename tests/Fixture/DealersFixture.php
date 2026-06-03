<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DealersFixture
 */
class DealersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_dealer' => 1,
                'nama' => 'Lorem ipsum dolor sit amet',
                'alamat' => 'Lorem ipsum dolor sit amet',
                'no_telp' => 1,
                'no_hp' => 1,
                'kode_dealer' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
