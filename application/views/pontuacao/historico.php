<?php $this->load->view('templates/header'); ?>

<div class="container">

    <h1 class="mb-4 text-center">
        Histórico de Pontuação - <?= $desbravador->nome_completo ?>
    </h1>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Unidade:</strong> <?= $desbravador->nome_unidade ?: '<em>Sem unidade</em>' ?></p>
                    <p><strong>Classe Base:</strong> <?= $desbravador->classe_base ?: '-' ?></p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p><strong>Cargo:</strong> <?= $desbravador->cargo ?></p>
                    <h4 class="text-success">
                        <strong>Total Acumulado: <?= $total_acumulado ?> pontos</strong>
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <?php if (empty($pontuacoes)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Ainda não há pontuação lançada para este desbravador.
        </div>
    <?php else: ?>
        <h4 class="mb-3">Lançamentos por Reunião</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Data da Reunião</th>
                        <th>Pontualidade</th>
                        <th>Uniforme</th>
                        <th>Espiritual</th>
                        <th>Classe</th>
                        <th>Comportamento</th>
                        <th>Tesouraria</th>
                        <th>Bônus</th>
                        <th class="text-center">Total do Dia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pontuacoes as $p): ?>
                        <?php 
                            // Converte data para formato brasileiro
                            $data_br = date('d/m/Y', strtotime($p->data_reuniao));
                            $dia_semana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
                            $dia = $dia_semana[date('w', strtotime($p->data_reuniao))];
                        ?>
                        <tr>
                            <td>
                                <strong><?= $data_br ?></strong><br>
                                <small class="text-muted"><?= $dia ?></small>
                            </td>
                            <td class="text-center"><?= $p->pontualidade ?></td>
                            <td class="text-center"><?= $p->uniforme ?></td>
                            <td class="text-center"><?= $p->espiritual ?></td>
                            <td class="text-center"><?= $p->classe ?></td>
                            <td class="text-center"><?= $p->comportamento ?></td>
                            <td class="text-center"><?= $p->tesouraria ?></td>
                            <td class="text-center"><?= $p->bonus ?></td>
                            <td class="text-center font-weight-bold text-success">
                                <?= $p->total_dia ?> pts
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-success font-weight-bold">
                        <td colspan="8" class="text-right">TOTAL ACUMULADO:</td>
                        <td class="text-center"><?= $total_acumulado ?> pts</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= site_url('pontuacao/lancar?id_unidade=' . $desbravador->id_unidade) ?>" 
           class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i> Voltar para Lançamento de Pontos
        </a>
        <a href="<?= site_url('desbravadores') ?>" class="btn btn-secondary btn-lg">
            <i class="fas fa-users"></i> Lista de Desbravadores
        </a>
    </div>

</div>

<?php $this->load->view('templates/footer'); ?>