<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<style>
    .form-page-wrap { max-width: 680px; margin: 32px auto; font-family: 'Segoe UI', sans-serif; }
    .back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 0.85rem; color: #6b7280; text-decoration: none; margin-bottom: 18px; transition: color 0.15s; }
    .back-link:hover { color: #4f46e5; }

    .form-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.07), 0 8px 32px rgba(79,70,229,0.08); overflow: hidden; }
    .form-card-header {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        padding: 28px 32px;
        display: flex; align-items: center; gap: 14px;
    }
    .form-card-header .header-icon { font-size: 2rem; }
    .form-card-header h2 { margin: 0; color: #fff; font-size: 1.4rem; font-weight: 700; }
    .form-card-header p { margin: 4px 0 0; color: #c4b5fd; font-size: 0.85rem; }

    .form-card-body { padding: 32px; }

    /* Override CakePHP default form controls */
    .form-card-body .input { margin-bottom: 20px; }
    .form-card-body label {
        display: block;
        font-size: 0.82rem; font-weight: 600;
        color: #374151; letter-spacing: 0.03em;
        text-transform: uppercase; margin-bottom: 6px;
    }
    .form-card-body input[type="text"],
    .form-card-body input[type="number"],
    .form-card-body textarea,
    .form-card-body select {
        width: 100%; box-sizing: border-box;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.95rem; color: #1f2937;
        background: #f9fafb;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .form-card-body input:focus,
    .form-card-body textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79,70,229,0.12); background: #fff; }
    .form-card-body textarea { resize: vertical; min-height: 80px; }
    .form-card-body .error-message { font-size: 0.78rem; color: #dc2626; margin-top: 4px; }

    .form-divider { border: none; border-top: 1px solid #f3f4f6; margin: 24px 0; }

    .btn-submit {
        width: 100%; padding: 13px;
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #fff; border: none; border-radius: 10px;
        font-size: 1rem; font-weight: 700; cursor: pointer;
        box-shadow: 0 2px 10px rgba(22,163,74,0.3);
        transition: opacity 0.2s, transform 0.1s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-submit:hover { opacity: 0.92; transform: translateY(-1px); }
</style>

<div class="form-page-wrap">

    <?= $this->Html->link('← Back to Dealers', ['action' => 'index'], ['class' => 'back-link']) ?>

    <div class="form-card">

        <div class="form-card-header">
            <div class="header-icon">➕</div>
            <div>
                <h2>Add New Dealer</h2>
                <p>Fill in the information below to register a new dealer.</p>
            </div>
        </div>

        <div class="form-card-body">
            <?= $this->Form->create($dealer) ?>

            <?php
                echo $this->Form->control('nama',    ['label' => '🏢 Nama Dealer',   'placeholder' => 'e.g. CV Maju Jaya']);
                echo $this->Form->control('alamat',  ['label' => '🏠 Alamat',         'placeholder' => 'Masukkan alamat lengkap', 'type' => 'textarea']);
                echo $this->Form->control('no_telp', ['label' => '📞 No. Telepon',    'placeholder' => 'e.g. 021-123456']);
                echo $this->Form->control('no_hp',   ['label' => '📱 No. HP',         'placeholder' => 'e.g. 08123456789']);
            ?>

            <hr class="form-divider">

            <?= $this->Form->button('✔ Simpan Dealer', ['class' => 'btn-submit']) ?>

            <?= $this->Form->end() ?>
        </div>

    </div>
</div>
