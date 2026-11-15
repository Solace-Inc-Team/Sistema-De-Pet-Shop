<?php // Quadro dos pets atrasados para o banho (Dashboard e Clientes). Espera $retornos = Agenda::retornos() ?>
<?php if ($retornos): ?>
<section class="card card-body mb-3" id="retornos">
    <div class="card-titulo">
        <div>
            <h2>Retorno do banho</h2>
            <p class="card-sub">Pets que passaram do intervalo de costume e não têm horário marcado (até <?= Agenda::RETORNO_LIMITE_DIAS ?> dias sem vir)</p>
        </div>
    </div>
    <div class="table-responsive"><table class="table align-middle">
        <thead><tr><th>Pet</th><th>Último banho</th><th>Costuma vir</th><th><span class="visually-hidden">Ações</span></th></tr></thead>
        <tbody>
            <?php foreach ($retornos as $r): ?>
                <tr>
                    <td><?= Cliente::ICONES_ESPECIE[$r['especie']] ?? '' ?> <strong><?= e($r['pet']) ?></strong><br><small><a href="index.php?page=clientes&amp;id=<?= (int) $r['cliente_id'] ?>"><?= e($r['cliente']) ?></a></small></td>
                    <td class="text-nowrap"><?= date('d/m', strtotime($r['ultimo'])) ?> <span class="selo selo-alerta">há <?= $r['faz_dias'] ?> dias</span></td>
                    <td class="text-nowrap">a cada <?= $r['intervalo'] ?> dias</td>
                    <td class="acoes text-nowrap">
                        <a class="btn btn-light btn-sm" href="<?= e(Cliente::whatsapp($r['telefone'], Agenda::mensagemRetorno($r))) ?>" target="_blank" rel="noopener noreferrer"><i class="bi bi-whatsapp" aria-hidden="true"></i> Lembrar<span class="visually-hidden"> o dono de <?= e($r['pet']) ?> (abre o WhatsApp)</span></a>
                        <a class="btn btn-light btn-sm" href="index.php?page=agenda&amp;pet=<?= (int) $r['pet_id'] ?>"><i class="bi bi-calendar-plus" aria-hidden="true"></i> Agendar<span class="visually-hidden"> <?= e($r['pet']) ?></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>
</section>
<?php endif; ?>
