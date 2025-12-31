<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style> body { padding: 40px; background-color: #f8f9fa; } </style>
</head>
<body>

<div class="container">
     <?php $this->load->view('templates/header'); ?>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4><?= $title ?></h4>
        </div>
        <div class="card-body">

            <?= form_open('desbravadores/salvar') ?>

            <?php if (isset($desbravador)): ?>
                <input type="hidden" name="id_desbravador" value="<?= $desbravador->id_desbravador ?>">
            <?php endif; ?>

            <div class="form-group">
                <label>Nome Completo *</label>
                <input type="text" name="nome_completo" class="form-control"
                       value="<?= set_value('nome_completo', isset($desbravador) ? $desbravador->nome_completo : '') ?>"
                       required>
                <?= form_error('nome_completo') ?>
            </div>

            <div class="form-group">
                <label>Unidade *</label>
                <select name="id_unidade" class="form-control" required>
                    <option value="">-- Selecione uma unidade --</option>
                    <?php foreach ($unidades as $u): ?>
                        <option value="<?= $u->id_unidade ?>"
                            <?= set_select('id_unidade', $u->id_unidade, 
                                (isset($desbravador) && $desbravador->id_unidade == $u->id_unidade)) ?>>
                            <?= $u->nome_unidade ?> (<?= $u->classe_base ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('id_unidade') ?>
            </div>

            <div class="form-group">
                <label>Cargo</label>
                <input type="text" name="cargo" class="form-control"
                       value="<?= set_value('cargo', isset($desbravador) ? $desbravador->cargo : 'Membro') ?>"
                       placeholder="Ex: Capitão, Secretário, Membro">
            </div>

            <div class="text-right">
                <a href="<?= site_url('desbravadores') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar Desbravador</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
     <?php $this->load->view('templates/footer'); ?>
</div>

</body>
</html>