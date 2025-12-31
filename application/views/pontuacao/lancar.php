<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cantinho da Unidade - Pontuação Diária</title>
    <!-- Bootstrap 4 para ficar bonito e responsivo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .card { margin-bottom: 20px; }
        .table th { background-color: #007bff; color: white; }
        .total-dia { font-weight: bold; font-size: 1.2em; color: #28a745; }
    </style>
</head>
<body>

<div class="container">
    <?php $this->load->view('templates/header'); ?>
    <h1 class="text-center mb-4">Cantinho da Unidade - Pontuação Diária</h1>

    <!-- Seleção de Unidade -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Selecione a Unidade</h5>
        </div>
        <div class="card-body">
            <form method="get" action="<?php echo site_url('pontuacao/lancar'); ?>">
                <div class="form-row align-items-end">
                    <div class="col-md-8">
                        <label for="id_unidade">Unidade</label>
                        <select name="id_unidade" id="id_unidade" class="form-control" onchange="this.form.submit()" required>
                            <option value="">-- Escolha uma unidade --</option>
                            <?php foreach ($unidades as $unidade): ?>
                                <option value="<?php echo $unidade->id_unidade ?>" <?php echo isset($unidade_selecionada) && $unidade_selecionada->id_unidade == $unidade->id_unidade ? 'selected' : '' ?>>
                                    <?php echo $unidade->nome_unidade ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo site_url('unidades'); ?>" class="btn btn-secondary">Gerenciar Unidades</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($desbravadores) && !empty($desbravadores)): ?>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h5>Unidade: <?php echo $unidade_selecionada->nome_unidade ?> (<?php echo $unidade_selecionada->classe_base ?>)</h5>
            </div>
            <div class="card-body">

                <!-- Formulário de Lançamento de Pontos -->
                <h5 class="mb-3">Lançar Pontos - Reunião do dia: 
                    <strong><?php echo date('d/m/Y') ?></strong> 
                    (<?php echo date('l', strtotime('today')) ?>)
                </h5>

                <form method="post" action="<?php echo site_url('pontuacao/salvar'); ?>">
                <input type="hidden" name="data_reuniao" value="<?php echo date('Y-m-d') ?>">
                <input type="hidden" name="id_unidade" value="<?php echo $unidade_selecionada->id_unidade ?>">
               
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Desbravador</th>
                                <th>Pontualidade<br><small>(0-10)</small></th>
                                <th>Uniforme<br><small>(0-15)</small></th>
                                <th>Espiritual<br><small>(0-20)</small></th>
                                <th>Classe<br><small>(0-20)</small></th>
                                <th>Comportamento<br><small>(0-15)</small></th>
                                <th>Tesouraria<br><small>(0-10)</small></th>
                                <th>Bônus<br><small>(0-10)</small></th>
                                <th class="text-center">Total do Dia</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registro_desbravadores as $desbravador): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo $desbravador->nome_completo ?></strong><br>
                                        <small class="text-muted"><?php echo $desbravador->cargo ?></small>
                                        <input type="hidden" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][id_desbravador]" value="<?php echo $desbravador->id_desbravador ?>">
                                    </td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][pontualidade]" class="form-control pontos" min="0" max="10" value="<?php echo $desbravador->pontualidade ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][uniforme]" class="form-control pontos" min="0" max="15" value="<?php echo $desbravador->uniforme ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][espiritual]" class="form-control pontos" min="0" max="20" value="<?php echo $desbravador->espiritual ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][classe]" class="form-control pontos" min="0" max="20" value="<?php echo $desbravador->classe ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][comportamento]" class="form-control pontos" min="0" max="15" value="<?php echo $desbravador->comportamento ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][tesouraria]" class="form-control pontos" min="0" max="10" value="<?php echo $desbravador->tesouraria ?>"></td>
                                    <td><input type="number" name="desbravadores[<?php echo $desbravador->id_desbravador ?>][bonus]" class="form-control pontos" min="0" max="10" value="0"></td>
                                    <td class="text-center total-dia" id="total-<?php echo $desbravador->id_desbravador ?>"><?php echo $desbravador->total_dia ?></td>
                                    <td><a href="<?php echo site_url('pontuacao/historico/'.$desbravador->id_desbravador); ?>" class="btn btn-sm btn-info">Histórico</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-lg btn-success">Salvar Pontuação de Hoje</button>
                </div>
                </form>                
            </div>
        </div>

    <?php endif; ?>
<?php $this->load->view('templates/footer');?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
// Calcula o total do dia em tempo real
$(document).ready(function() {
    function calcularTotal(linha) {
        let total = 0;
        linha.find('.pontos').each(function() {
            let val = parseInt($(this).val()) || 0;
            total += val;
        });
        linha.find('.total-dia').text(total);
    }

    // Ao digitar em qualquer campo de pontos
    $('.pontos').on('input', function() {
        let linha = $(this).closest('tr');
        calcularTotal(linha);
    });

    // Calcula todos na carga inicial (caso tenha valores padrão)
    $('tbody tr').each(function() {
        calcularTotal($(this));
    });
});
</script>

</body>
</html>