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
            <?= $this->Html->link(__('Edit Dealer'), ['action' => 'edit', $dealer->id_dealer], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dealer'), ['action' => 'delete', $dealer->id_dealer], ['confirm' => __('Are you sure you want to delete # {0}?', $dealer->id_dealer), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dealers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dealer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="dealers view content">
            <h3><?= h($dealer->nama) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nama') ?></th>
                    <td><?= h($dealer->nama) ?></td>
                </tr>
                <tr>
                    <th><?= __('Alamat') ?></th>
                    <td><?= h($dealer->alamat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kode Dealer') ?></th>
                    <td><?= h($dealer->kode_dealer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id Dealer') ?></th>
                    <td><?= $this->Number->format($dealer->id_dealer) ?></td>
                </tr>
                <tr>
                    <th><?= __('No Telp') ?></th>
                    <td><?= $dealer->no_telp === null ? '' : $this->Number->format($dealer->no_telp) ?></td>
                </tr>
                <tr>
                    <th><?= __('No Hp') ?></th>
                    <td><?= $dealer->no_hp === null ? '' : $this->Number->format($dealer->no_hp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>