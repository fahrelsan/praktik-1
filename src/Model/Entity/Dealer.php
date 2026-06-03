<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dealer Entity
 *
 * @property int $id_dealer
 * @property string $nama
 * @property string|null $alamat
 * @property int|null $no_telp
 * @property int|null $no_hp
 * @property string|null $kode_dealer
 */
class Dealer extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'nama' => true,
        'alamat' => true,
        'no_telp' => true,
        'no_hp' => true,
        'kode_dealer' => true,
    ];
}
