<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * Dealers seed.
 */
class DealersSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/migrations/5/guides/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
        [
            "id_dealer"=> 1,
            "nama"=> "Wahana Artha Cabang 1",
            "alamat"=> "Jl. Bandung, Malang",
            "no_telp"=> "08121212",
            "no_hp"=>"08121212",
        ],
        [
            "id_dealer"=> 2,
            "nama"=> "Wahana Artha Cabang 2",
            "alamat"=> "Jl. Bandung, Malang",
            "no_telp"=> "08121212",
            "no_hp"=>"08121212",
        ],
        [
            "id_dealer"=> 3,
            "nama"=> "Wahana Artha Cabang 3",
            "alamat"=> "Jl. Bandung, Malang",
            "no_telp"=> "08121212",
            "no_hp"=>"08121212",
        ],
        [
            "id_dealer"=> 4,
            "nama"=> "Wahana Artha Cabang 4",
            "alamat"=> "Jl. Bandung, Malang",
            "no_telp"=> "08121212",
            "no_hp"=>"08121212",
        ],
        [
            "id_dealer"=> 5,
            "nama"=> "Wahana Artha Cabang 5",
            "alamat"=> "Jl. Bandung, Malang",
            "no_telp"=> "08121212",
            "no_hp"=>"08121212",
        ],
    ];

        $table = $this->table('dealers');
        $table->insert($data)->save();
    }
}
