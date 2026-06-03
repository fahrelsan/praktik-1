<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
$initials = strtoupper(substr($dealer->nama, 0, 1));
?>
<style>
    .view-page-wrap { max-width: 680px; margin: 32px auto; font-family: 'Segoe UI', sans-serif; }
    .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 0.85rem; color: #6b7280; text-decoration: none; margin-bottom: 18px; transition: color 0.15s; }
    .back-link:hover { color: #4f46e5; }

    /* Profile Card */
    .profile-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.07), 0 8px 32px rgba(79,70,229,0.08); overflow: hidden; }

    .profile-header {
        background: linear-gradient(135deg, #1e1b4b 0%, #4f46e5 60%, #7c3aed 100%);
        padding: 36px 32px 28px;
        display: flex; align-items: center; gap: 22px;
    }
    .avatar-circle {
        width: 72px; height: 72px;
        background: rgba(255,255,255,0.2);
        border: 3px solid rgba(255,255,255,0.5);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; font-weight: 800; color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    }
    .profile-header-info h2 { margin: 0; color: #fff; font-size: 1.5rem; font-weight: 800; }
    .id-badge {
        display: inline-block; margin-top: 8px;
        background: rgba(255,255,255,0.18);
        color: #c7d2fe; font-size: 0.78rem; font-weight: 600;
        padding: 3px 10px; border-radius: 20px; letter-spacing: 0.05em;
        border: 1px solid rgba(255,255,255,0.25);
    }

    /* Detail Grid */
    .detail-grid { padding: 32px; display: flex; flex-direction: column; gap: 0; }
    .detail-row {
        display: flex; align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #f3f4f6;
        gap: 16px;
    }
    .detail-row:last-child { border-bottom: none; }
    .detail-icon { font-size: 1.2rem; width: 28px; flex-shrink: 0; margin-top: 1px; }
    .detail-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #9ca3af; margin-bottom: 4px; }
    .detail-value { font-size: 0.95rem; color: #1f2937; font-weight: 500; }
    .detail-value.empty { color: #9ca3af; font-style: italic; font-weight: 400; }

    /* Actions Footer */
    .action-footer {
        display: flex; gap: 10px; padding: 20px 32px;
        background: #f9fafb;
        border-top: 1px solid #f3f4f6;
        flex-wrap: wrap;
    }
    .btn-action {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 10px 20px; border-radius: 8px;
        font-size: 0.88rem; font-weight: 600;
        text-decoration: none; border: none; cursor: pointer;
        transition: opacity 0.2s, transform 0.1s; font-family: inherit;
    }
    .btn-action:hover { opacity: 0.85; transform: translateY(-1px); }
    .btn-edit { background: #4f46e5; color: #fff !important; box-shadow: 0 2px 8px rgba(79,70,229,0.25); }
    .btn-del  { background: #dc2626; color: #fff !important; box-shadow: 0 2px 8px rgba(220,38,38,0.25); }
    .btn-back { background: #fff; color: #374151 !important; border: 1.5px solid #e5e7eb; box-shadow: none; }
    .btn-back:hover { background: #f9fafb; }
</style>

<div class="view-page-wrap">

    <?= $this->Html->link('← Back to Dealers', ['action' => 'index'], ['class' => 'back-link']) ?>

    <div class="profile-card">

        <!-- Profile Header -->
        <div class="profile-header">
            <div class="avatar-circle"><?= $initials ?></div>
            <div class="profile-header-info">
                <h2><?= h($dealer->nama) ?></h2>
                <span class="id-badge">🏢 Dealer ID #<?= $this->Number->format($dealer->id_dealer) ?></span>
            </div>
        </div>

        <!-- Detail Grid -->
        <div class="detail-grid">

            <div class="detail-row">
                <div class="detail-icon">🏠</div>
                <div>
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value <?= $dealer->alamat ? '' : 'empty' ?>">
                        <?= $dealer->alamat ? h($dealer->alamat) : 'Tidak ada alamat' ?>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-icon">📞</div>
                <div>
                    <div class="detail-label">No. Telepon</div>
                    <div class="detail-value <?= $dealer->no_telp === null ? 'empty' : '' ?>">
                        <?= $dealer->no_telp === null ? 'Tidak tersedia' : h($dealer->no_telp) ?>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-icon">📱</div>
                <div>
                    <div class="detail-label">No. HP</div>
                    <div class="detail-value <?= $dealer->no_hp === null ? 'empty' : '' ?>">
                        <?= $dealer->no_hp === null ? 'Tidak tersedia' : h($dealer->no_hp) ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="action-footer">
            <?= $this->Html->link('✏️ Edit Dealer', ['action' => 'edit', $dealer->id_dealer], ['class' => 'btn-action btn-edit']) ?>
            <?= $this->Form->postLink(
                '🗑 Hapus Dealer',
                ['action' => 'delete', $dealer->id_dealer],
                [
                    'confirm' => __('Yakin ingin menghapus dealer "{0}"? Tindakan ini tidak bisa dibatalkan.', $dealer->nama),
                    'class' => 'btn-action btn-del',
                ]
            ) ?>
            <?= $this->Html->link('← Kembali ke Daftar', ['action' => 'index'], ['class' => 'btn-action btn-back']) ?>
        </div>

    </div>
</div>