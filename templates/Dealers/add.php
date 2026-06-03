<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dealer $dealer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Dealers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="dealers form content">
            <?= $this->Form->create($dealer) ?>
            <fieldset>
                <legend><?= __('Add Dealer') ?></legend>
                <?php
                    echo $this->Form->control('nama');
                    echo $this->Form->control('alamat');
                    echo $this->Form->control('no_telp');
                    echo $this->Form->control('no_hp');
                    echo $this->Form->control('kode_dealer');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
