<?php $this->load->view('templates/header'); ?>

<div class="container">

    <h1 class="text-center mb-5">
        <i class="fas fa-trophy text-warning"></i> Ranking Geral - Cantinho da Unidade
    </h1>

    <?php if (empty($ranking)): ?>
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-2x mb-3"></i><br>
            Ainda não há pontuação lançada. Comece registrando pontos no Cantinho da Unidade!
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="text-center" style="width: 80px;">Posição</th>
                        <th>Desbravador</th>
                        <th>Unidade</th>
                        <th>Cargo</th>
                        <th class="text-center">Pontos Totais</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ranking as $posicao => $item): ?>
                        <?php 
                            $pos = $posicao + 1; // posição real (começa em 1)
                            $medalha = '';
                            $cor_fundo = '';
                            $cor_texto = '';

                            if ($pos == 1) {
                                $medalha = '🥇';
                                $cor_fundo = 'bg-warning text-dark';
                                $cor_texto = 'text-dark';
                            } elseif ($pos == 2) {
                                $medalha = '🥈';
                                $cor_fundo = 'bg-secondary text-white';
                                $cor_texto = 'text-white';
                            } elseif ($pos == 3) {
                                $medalha = '🥉';
                                $cor_fundo = 'bg-bronze text-white'; // vamos definir com CSS
                                $cor_texto = 'text-white';
                            } else {
                                $medalha = "<strong>$posº</strong>";
                            }
                        ?>
                        <tr class="<?= $cor_fundo ?>">
                            <td class="text-center font-weight-bold text-large">
                                <div class="display-4"><?= $medalha ?></div>
                            </td>
                            <td>
                                <strong><?= $item->nome_completo ?></strong>
                            </td>
                            <td>
                                <?= $item->nome_unidade ?: '<em class="text-muted">Sem unidade</em>' ?>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-info"><?= $item->cargo ?></span>
                            </td>
                            <td class="text-center font-weight-bold text-success h4 mb-0">
                                <?= number_format($item->total_pontos) ?> pts
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Legenda das medalhas -->
        <div class="text-center mt-5">
            <h5>Legenda</h5>
            <span class="mx-3"><strong>🥇 1º lugar</strong></span>
            <span class="mx-3"><strong>🥈 2º lugar</strong></span>
            <span class="mx-3"><strong>🥉 3º lugar</strong></span>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= site_url('pontuacao/lancar') ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-clipboard-check"></i> Ir para Lançamento de Pontos
        </a>
    </div>

</div>

<style>
    /* Cor personalizada para bronze */
    .bg-bronze {
        background: linear-gradient(135deg, #cd7f32, #a0522d) !important;
        color: white;
    }
    .text-large {
        font-size: 2.5rem;
    }
    @media (max-width: 768px) {
        .text-large {
            font-size: 2rem;
        }
    }
</style>

<?php $this->load->view('templates/footer'); ?>