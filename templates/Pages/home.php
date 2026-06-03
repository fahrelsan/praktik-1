<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        ConnectionManager::get($name)->getDriver()->connect();
        // No exception means success
        $connected = true;
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
        if ($name === 'debug_kit') {
            $error = 'Try adding your current <b>top level domain</b> to the
                <a href="https://book.cakephp.org/debugkit/5/en/index.html#configuration" target="_blank">DebugKit.safeTld</a>
            config and reload.';
            if (!in_array('sqlite', \PDO::getAvailableDrivers())) {
                $error .= '<br />You need to install the PHP extension <code>pdo_sqlite</code> so DebugKit can work properly.';
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CakePHP: the rapid development PHP framework:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Stats Bar -->
<style>
    .stats-section { padding: 32px 40px 0; font-family: 'Segoe UI', sans-serif; }
    .stats-section h2 { margin: 0 0 4px; font-size: 1.6rem; font-weight: 700; color: #1e1b4b; }
    .stats-section .subtitle { font-size: 0.85rem; color: #6b7280; margin-bottom: 20px; }

    .stats-row { display: flex; gap: 16px; flex-wrap: wrap; }
    .stat-card {
        flex: 1; min-width: 140px;
        background: #fff;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08), 0 4px 16px rgba(79,70,229,0.07);
        border-left: 4px solid #dc2626;
        display: flex; flex-direction: column; gap: 4px;
    }
    .stat-card.green  { border-left-color: #16a34a; }
    .stat-card.amber  { border-left-color: #d97706; }
    .stat-card.navy   { border-left-color: #1e1b4b; }
    .stat-card.slate  { border-left-color: #0f172a; }
    .stat-card .stat-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; }
    .stat-card .stat-value { font-size: 1.9rem; font-weight: 800; color: #1e1b4b; line-height: 1; }
    .stat-card .stat-sub { font-size: 0.75rem; color: #9ca3af; margin-top: 2px; }
    .headcontainer {
        width: max-content;
        flex: auto;
        flex-direction: row;
        justify-content: space-between;
    }
    .btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #4f46e5; color: #fff !important;
        padding: 10px 20px; border-radius: 8px;
        font-size: 0.88rem; font-weight: 600;
        text-decoration: none; border: none; cursor: pointer;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }
    .btn:hover { background: #4338ca; transform: translateY(-1px); }

</style>

<div class="stats-section">
    <div class="headcontainer">
        <div class="">
            <h2>Dashboard Overview</h2>
            <div class="subtitle">Ringkasan data penjualan & promo</div>
        </div>
        <button class="btn-add" >
        <?= $this->Html->link(
    'Go to Dashboard',
    ['controller' => 'Dealers', 'action' => 'index'],
) ?>
        </button>
    </div>

    <div class="stats-row">
        <?php
        $motors = [
            ['HND-001', 'Honda BeAT',          'matic',    14500000, 312, 78],
            ['HND-002', 'Honda Vario 125',      'matic',    20800000, 245, 61],
            ['HND-003', 'Honda Vario 160',      'matic',    24900000, 198, 66],
            ['HND-004', 'Honda Scoopy',         'matic',    21500000, 176, 58],
            ['HND-005', 'Honda PCX 160',        'matic',    31900000, 134, 89],
            ['HND-006', 'Honda ADV 160',        'adventure',34500000,  97, 97],
            ['HND-007', 'Honda CB150R',         'sport',    26700000,  88, 44],
            ['HND-008', 'Honda CBR150R',        'sport',    39900000,  54, 54],
            ['HND-009', 'Honda Revo',           'bebek',    16200000, 163, 81],
            ['HND-010', 'Honda Supra GTR 150',  'bebek',    22100000,  72, 72],
        ];
        $totalUnit  = array_sum(array_column($motors, 4));
        $totalOmzet = array_sum(array_map(fn($m) => $m[3] * $m[4], $motors));
        $avgPct     = round(array_sum(array_column($motors, 5)) / count($motors));
        $topModel   = $motors[array_search(max(array_column($motors, 4)), array_column($motors, 4))][1];
        ?>

        <div class="stat-card">
            <div class="stat-label">Total Model</div>
            <div class="stat-value"><?= count($motors) ?></div>
            <div class="stat-sub">Varian aktif</div>
        </div>
        <div class="stat-card green">
            <div class="stat-label">Total Unit Terjual</div>
            <div class="stat-value"><?= number_format($totalUnit, 0, ',', '.') ?></div>
            <div class="stat-sub">Jan – Jun 2025</div>
        </div>
        <div class="stat-card navy">
            <div class="stat-label">Total Omzet</div>
            <div class="stat-value" style="font-size:1.3rem;">Rp <?= number_format($totalOmzet, 0, ',', '.') ?></div>
            <div class="stat-sub">Akumulasi semua model</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-label">Rata-rata Target</div>
            <div class="stat-value"><?= $avgPct ?>%</div>
            <div class="stat-sub">Progress keseluruhan</div>
        </div>
        <div class="stat-card slate">
            <div class="stat-label">Model Terlaris</div>
            <div class="stat-value" style="font-size:1rem;line-height:1.3;"><?= $topModel ?></div>
            <div class="stat-sub"><?= max(array_column($motors, 4)) ?> unit terjual</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Event Promo</div>
            <div class="stat-value">10</div>
            <div class="stat-sub">4 selesai · 1 berlangsung</div>
        </div>
    </div>
</div>
    <!-- Honda Motor Sales Table -->
<style>
    .motor-section { margin-top: 40px; margin-left: 40px; margin-right: 40px;}
    .motor-section h3 { font-size: 1.2rem; font-weight: 700; color: #1e1b4b; margin: 0 0 6px; }
    .motor-section .subtitle { font-size: 0.82rem; color: #6b7280; margin-bottom: 20px; }

    .motor-table-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07), 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .motor-table-card table { width: 100%; border-collapse: collapse; margin: 0; }
    .motor-table-card thead tr { background: #dc2626; }
    .motor-table-card thead th {
        color: #fee2e2; font-size: 0.75rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em;
        padding: 14px 16px; border: none; white-space: nowrap;
    }
    .motor-table-card tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.15s; }
    .motor-table-card tbody tr:last-child { border-bottom: none; }
    .motor-table-card tbody tr:hover { background: #fff1f2; }
    .motor-table-card tbody tr:nth-child(even) { background: #fafafa; }
    .motor-table-card tbody tr:nth-child(even):hover { background: #fff1f2; }
    .motor-table-card tbody td { padding: 13px 16px; font-size: 0.88rem; color: #374151; border: none; vertical-align: middle; }

    .motor-badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px;
        font-size: 0.72rem; font-weight: 600;
    }
    .motor-badge.sport { background: #fee2e2; color: #991b1b; }
    .motor-badge.matic { background: #dbeafe; color: #1d4ed8; }
    .motor-badge.bebek { background: #dcfce7; color: #166534; }
    .motor-badge.adventure { background: #fef3c7; color: #92400e; }

    .progress-wrap { display: flex; align-items: center; gap: 8px; }
    .progress-bar-bg { flex: 1; background: #f3f4f6; border-radius: 999px; height: 8px; min-width: 80px; }
    .progress-bar-fill { height: 8px; border-radius: 999px; background: #dc2626; }
    .progress-label { font-size: 0.82rem; font-weight: 700; color: #dc2626; white-space: nowrap; }

    .tfoot-row td { background: #1e1b4b; color: #e0e7ff; font-size: 0.85rem; font-weight: 700; padding: 13px 16px; }
</style>

<div class="motor-section">
    <h3>Penjualan Motor Honda</h3>
    <div class="subtitle">Data dummy — periode Januari s/d Juni 2025</div>

    <div class="motor-table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Unit</th>
                    <th>Nama Motor</th>
                    <th>Tipe</th>
                    <th>Harga (Rp)</th>
                    <th>Terjual (Unit)</th>
                    <th>Progres Target</th>
                    <th>Total Omzet (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $motors = [
                    ['HND-001', 'Honda BeAT',          'matic',    14500000,  312, 78],
                    ['HND-002', 'Honda Vario 125',     'matic',    20800000,  245, 61],
                    ['HND-003', 'Honda Vario 160',     'matic',    24900000,  198, 66],
                    ['HND-004', 'Honda Scoopy',        'matic',    21500000,  176, 58],
                    ['HND-005', 'Honda PCX 160',       'matic',    31900000,  134, 89],
                    ['HND-006', 'Honda ADV 160',       'adventure',34500000,   97, 97],
                    ['HND-007', 'Honda CB150R',        'sport',    26700000,   88, 44],
                    ['HND-008', 'Honda CBR150R',       'sport',    39900000,   54, 54],
                    ['HND-009', 'Honda Revo',          'bebek',    16200000,  163, 81],
                    ['HND-010', 'Honda Supra GTR 150', 'bebek',    22100000,   72, 72],
                ];
                $grandTotal = 0;
                $grandUnit  = 0;
                foreach ($motors as $i => $m):
                    $omzet = $m[3] * $m[4];
                    $grandTotal += $omzet;
                    $grandUnit  += $m[4];
                    $pct = min($m[5], 100);
                ?>
                <tr>
                    <td style="font-weight:700;color:#dc2626;"><?= $i + 1 ?></td>
                    <td style="font-family:monospace;font-size:0.82rem;color:#6b7280;"><?= $m[0] ?></td>
                    <td style="font-weight:600;"><?= $m[1] ?></td>
                    <td><span class="motor-badge <?= $m[2] ?>"><?= ucfirst($m[2]) ?></span></td>
                    <td>Rp <?= number_format($m[3], 0, ',', '.') ?></td>
                    <td style="font-weight:700;text-align:center;"><?= $m[4] ?></td>
                    <td>
                        <div class="progress-wrap">
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill" style="width:<?= $pct ?>%;<?= $pct >= 80 ? 'background:#16a34a;' : ($pct >= 50 ? 'background:#d97706;' : 'background:#dc2626;') ?>"></div>
                            </div>
                            <span class="progress-label" style="<?= $pct >= 80 ? 'color:#16a34a;' : ($pct >= 50 ? 'color:#d97706;' : 'color:#dc2626;') ?>"><?= $pct ?>%</span>
                        </div>
                    </td>
                    <td style="font-weight:700;">Rp <?= number_format($omzet, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="tfoot-row">
                    <td colspan="5" style="text-align:right;">TOTAL KESELURUHAN</td>
                    <td style="text-align:center;"><?= $grandUnit ?> Unit</td>
                    <td></td>
                    <td>Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Promo Launching Schedule Table -->
<style>
    .promo-section { margin-top: 40px; margin-left: 40px; margin-right: 40px; }
    .promo-section h3 { font-size: 1.2rem; font-weight: 700; color: #1e1b4b; margin: 0 0 6px; }
    .promo-section .subtitle { font-size: 0.82rem; color: #6b7280; margin-bottom: 20px; }

    .promo-table-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07), 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .promo-table-card table { width: 100%; border-collapse: collapse; margin: 0; }
    .promo-table-card thead tr { background: #0f172a; }
    .promo-table-card thead th {
        color: #94a3b8; font-size: 0.75rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em;
        padding: 14px 16px; border: none; white-space: nowrap;
    }
    .promo-table-card tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.15s; }
    .promo-table-card tbody tr:last-child { border-bottom: none; }
    .promo-table-card tbody tr:hover { background: #f8fafc; }
    .promo-table-card tbody tr:nth-child(even) { background: #fafafa; }
    .promo-table-card tbody tr:nth-child(even):hover { background: #f8fafc; }
    .promo-table-card tbody td { padding: 13px 16px; font-size: 0.88rem; color: #374151; border: none; vertical-align: middle; }

    .status-badge {
        display: inline-block; padding: 3px 10px; border-radius: 20px;
        font-size: 0.72rem; font-weight: 600;
    }
    .status-badge.upcoming   { background: #dbeafe; color: #1d4ed8; }
    .status-badge.ongoing    { background: #dcfce7; color: #166534; }
    .status-badge.done       { background: #f3f4f6; color: #6b7280; }
    .status-badge.cancelled  { background: #fee2e2; color: #991b1b; }
</style>

<div class="promo-section">
    <h3>Jadwal Promo & Launching</h3>
    <div class="subtitle">Data statis — males bikin DB-nya kwkwk</div>

    <div class="promo-table-card">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Model Launching</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Lokasi</th>
                    <th>Diskon / Benefit</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">1</td>
                    <td style="font-weight:600;">Grand Launch BeAT Special Edition</td>
                    <td>Honda BeAT SE 2025</td>
                    <td>01 Jan 2025</td>
                    <td>15 Jan 2025</td>
                    <td>Dealer Pusat Malang</td>
                    <td>Cashback Rp 1.500.000</td>
                    <td><span class="status-badge done">Selesai</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">2</td>
                    <td style="font-weight:600;">Promo Valentines — Vario Series</td>
                    <td>Honda Vario 125 / 160</td>
                    <td>10 Feb 2025</td>
                    <td>28 Feb 2025</td>
                    <td>All Dealer Jatim</td>
                    <td>Gratis Aksesori + DP 0%</td>
                    <td><span class="status-badge done">Selesai</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">3</td>
                    <td style="font-weight:600;">Scoopy Pastel Fest</td>
                    <td>Honda Scoopy 2025</td>
                    <td>05 Mar 2025</td>
                    <td>20 Mar 2025</td>
                    <td>Mall Olympic Garden</td>
                    <td>Cicilan 0% 24 Bulan</td>
                    <td><span class="status-badge done">Selesai</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">4</td>
                    <td style="font-weight:600;">ADV 160 Adventure Expo</td>
                    <td>Honda ADV 160</td>
                    <td>12 Apr 2025</td>
                    <td>14 Apr 2025</td>
                    <td>Alun-alun Malang</td>
                    <td>Free Touring Kit senilai Rp 800rb</td>
                    <td><span class="status-badge done">Selesai</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">5</td>
                    <td style="font-weight:600;">PCX Mid-Year Deals</td>
                    <td>Honda PCX 160</td>
                    <td>01 Jun 2025</td>
                    <td>30 Jun 2025</td>
                    <td>All Dealer Malang Raya</td>
                    <td>Cashback Rp 2.000.000</td>
                    <td><span class="status-badge ongoing">Berlangsung</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">6</td>
                    <td style="font-weight:600;">CBR150R Track Day Launch</td>
                    <td>Honda CBR150R 2025</td>
                    <td>19 Jul 2025</td>
                    <td>20 Jul 2025</td>
                    <td>Sirkuit Sentul</td>
                    <td>Bonus Helm SNI + Jaket</td>
                    <td><span class="status-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">7</td>
                    <td style="font-weight:600;">Merdeka Riding Festival</td>
                    <td>All Model</td>
                    <td>10 Ags 2025</td>
                    <td>17 Ags 2025</td>
                    <td>All Dealer Nasional</td>
                    <td>DP mulai Rp 500rb</td>
                    <td><span class="status-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">8</td>
                    <td style="font-weight:600;">Promo Harbolnas Honda</td>
                    <td>BeAT / Vario / Scoopy</td>
                    <td>11 Nov 2025</td>
                    <td>12 Nov 2025</td>
                    <td>Online + Dealer</td>
                    <td>Diskon s/d Rp 3.000.000</td>
                    <td><span class="status-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">9</td>
                    <td style="font-weight:600;">Year End Clearance</td>
                    <td>Sisa Stok 2024</td>
                    <td>20 Des 2025</td>
                    <td>31 Des 2025</td>
                    <td>All Dealer Jatim</td>
                    <td>Harga Spesial + Gratis STNK</td>
                    <td><span class="status-badge upcoming">Upcoming</span></td>
                </tr>
                <tr>
                    <td style="font-weight:700;color:#0f172a;">10</td>
                    <td style="font-weight:600;">CB150R Street Launch — Dibatalin</td>
                    <td>Honda CB150R Limited</td>
                    <td>25 Mei 2025</td>
                    <td>26 Mei 2025</td>
                    <td>Dealer Sukun Malang</td>
                    <td>—</td>
                    <td><span class="status-badge cancelled">Dibatalkan</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
