<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Dealer> $dealers
 */
?>
<style>
    .dealers-wrapper { font-family: 'Segoe UI', sans-serif; padding: 8px 0; }
    .dealers-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
    .dealers-header h2 { margin: 0; font-size: 1.6rem; font-weight: 700; color: #1e1b4b; }
    .dealers-header .subtitle { font-size: 0.85rem; color: #6b7280; margin-top: 2px; }

    /* Stats Cards */
    .stats-row { display: flex; gap: 16px; margin-bottom: 28px; flex-wrap: wrap; }
    .stat-card {
        flex: 1; min-width: 140px;
        background: #fff;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08), 0 4px 16px rgba(79,70,229,0.07);
        border-left: 4px solid #4f46e5;
        display: flex; flex-direction: column; gap: 4px;
    }
    .stat-card.green { border-left-color: #16a34a; }
    .stat-card.amber { border-left-color: #d97706; }
    .stat-card .stat-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; }
    .stat-card .stat-value { font-size: 1.9rem; font-weight: 800; color: #1e1b4b; line-height: 1; }
    .stat-card .stat-icon { font-size: 1.4rem; margin-bottom: 4px; }

    /* Button */
    .btn-add {
        display: inline-flex; align-items: center; gap: 6px;
        background: #4f46e5; color: #fff !important;
        padding: 10px 20px; border-radius: 8px;
        font-size: 0.88rem; font-weight: 600;
        text-decoration: none; border: none; cursor: pointer;
        box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }
    .btn-add:hover { background: #4338ca; transform: translateY(-1px); }

    /* Table */
    .table-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07), 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .table-card table { width: 100%; border-collapse: collapse; margin: 0; }
    .table-card thead tr { background: #1e1b4b; }
    .table-card thead th {
        color: #c7d2fe; font-size: 0.75rem; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em;
        padding: 14px 16px; border: none; white-space: nowrap;
    }
    .table-card thead th a { color: #c7d2fe !important; text-decoration: none; }
    .table-card thead th a:hover { color: #fff !important; }
    .table-card tbody tr { border-bottom: 1px solid #f3f4f6; transition: background 0.15s; }
    .table-card tbody tr:last-child { border-bottom: none; }
    .table-card tbody tr:hover { background: #f5f3ff; }
    .table-card tbody tr:nth-child(even) { background: #fafafa; }
    .table-card tbody tr:nth-child(even):hover { background: #f5f3ff; }
    .table-card tbody td { padding: 13px 16px; font-size: 0.88rem; color: #374151; border: none; vertical-align: middle; }
    .table-card tbody td.id-cell { font-weight: 700; color: #4f46e5; }

    /* Action badges */
    .action-badges { display: flex; gap: 6px; flex-wrap: wrap; }
    .badge { display: inline-block; padding: 4px 11px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none !important; border: none; cursor: pointer; transition: opacity 0.15s, transform 0.1s; }
    .badge:hover { opacity: 0.85; transform: translateY(-1px); }
    .badge-view { background: #dbeafe; color: #1d4ed8 !important; }
    .badge-edit { background: #fef3c7; color: #92400e !important; }
    .badge-delete { background: #fee2e2; color: #991b1b !important; }
    /* override form button styles */
    .action-badges form { display: inline; margin: 0; }
    .action-badges form button.badge { font-family: inherit; }

    /* Paginator */
    .paginator-wrap { display: flex; flex-direction: column; align-items: center; gap: 8px; padding: 8px 0 4px; }
    .paginator-wrap .pagination { display: flex; gap: 4px; list-style: none; padding: 0; margin: 0; flex-wrap: wrap; justify-content: center; }
    .paginator-wrap .pagination li a,
    .paginator-wrap .pagination li span {
        display: inline-block; padding: 6px 12px; border-radius: 6px;
        font-size: 0.82rem; font-weight: 500; text-decoration: none;
        color: #4f46e5; background: #ede9fe; border: 1px solid #c4b5fd;
        transition: background 0.15s;
    }
    .paginator-wrap .pagination li.active span,
    .paginator-wrap .pagination li a:hover { background: #4f46e5; color: #fff; border-color: #4f46e5; }
    .paginator-wrap .pagination li.disabled span { color: #9ca3af; background: #f3f4f6; border-color: #e5e7eb; }
    .paginator-counter { font-size: 0.8rem; color: #6b7280; }
</style>

<div class="dealers-wrapper">

    <!-- Header -->
    <div class="dealers-header">
        <div>
            <h2>🏢 Dealers</h2>
            <div class="subtitle">Manage all registered dealers</div>
        </div>
        <?= $this->Html->link('+ New Dealer', ['action' => 'add'], ['class' => 'btn-add']) ?>
    </div>

    <!-- Stats Bar -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-label">Total Dealers</div>
            <div class="stat-value"><?= $this->Paginator->counter('{{count}}') ?></div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon">📋</div>
            <div class="stat-label">Showing Now</div>
            <div class="stat-value"><?= $this->Paginator->counter('{{current}}') ?></div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon">📄</div>
            <div class="stat-label">Page</div>
            <div class="stat-value"><?= $this->Paginator->counter('{{page}} / {{pages}}') ?></div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id_dealer', '#') ?></th>
                    <th><?= $this->Paginator->sort('nama', 'Nama Dealer') ?></th>
                    <th><?= $this->Paginator->sort('alamat', 'Alamat') ?></th>
                    <th><?= $this->Paginator->sort('no_telp', 'No. Telepon') ?></th>
                    <th><?= $this->Paginator->sort('no_hp', 'No. HP') ?></th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dealers as $dealer): ?>
                <tr>
                    <td class="id-cell">#<?= $this->Number->format($dealer->id_dealer) ?></td>
                    <td style="font-weight:600;"><?= h($dealer->nama) ?></td>
                    <td><?= h($dealer->alamat) ?></td>
                    <td><?= $dealer->no_telp === null ? '<span style="color:#9ca3af;">—</span>' : h($dealer->no_telp) ?></td>
                    <td><?= $dealer->no_hp === null ? '<span style="color:#9ca3af;">—</span>' : h($dealer->no_hp) ?></td>
                    <td>
                        <div class="action-badges">
                            <?= $this->Html->link('👁 View', ['action' => 'view', $dealer->id_dealer], ['class' => 'badge badge-view']) ?>
                            <?= $this->Html->link('✏️ Edit', ['action' => 'edit', $dealer->id_dealer], ['class' => 'badge badge-edit']) ?>
                            <?= $this->Form->postLink(
                                '🗑 Delete',
                                ['action' => 'delete', $dealer->id_dealer],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Hapus dealer "{0}"? Tindakan ini tidak bisa dibatalkan.', $dealer->nama),
                                    'class' => 'badge badge-delete',
                                ]
                            ) ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginator -->
    <div class="paginator-wrap">
        <ul class="pagination">
            <?= $this->Paginator->first('<< First') ?>
            <?= $this->Paginator->prev('< Prev') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Next >') ?>
            <?= $this->Paginator->last('Last >>') ?>
        </ul>
        <p class="paginator-counter"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} of {{count}} total dealers')) ?></p>
    </div>

</div>