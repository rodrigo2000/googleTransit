<a href="<?= $this->module['new_url']; ?>" class="btn btn-default pull-right"><?= $this->module['title_new']; ?></a>
<h1><?= $this->module['title_list']; ?></h1>
<h3>Una o varias empresas de transporte público que proporcionan los datos de este feed.</h3>
<p>Esta información es obligatorio</p>
<?php if (isset($registros) && count($registros) > 0): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>agency_id</th>
                    <th>agency_name</th>
                    <th>agency_url</th>
                    <th>agency_timezone</th>
<!--                    <th>agency_lang</th>
                    <th>agency_phone</th>
                    <th>agency_fare_url</th>-->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $r) : ?>
                    <tr>
                        <td><?= $r['agency_id']; ?></td>
                        <td><?= $r['agency_name']; ?></td>
                        <td><?= $r['agency_url']; ?></td>
                        <td><?= $r['agency_timezone']; ?></td>
<!--                        <td><?= $r['agency_lang']; ?></td>
                        <td><?= $r['agency_phone']; ?></td>
                        <td><?= $r['agency_fare_url']; ?></td>-->
                        <td class="toolbar">
                            <div class="btn-group">
                                <a class="btn btn-flat" href="<?= base_url() ?>Agencias/modificar/<?= $r['id_agencia']; ?>"><span class="awe-edit"></span></a>
                                <a class="btn btn-flat"><span class="awe-remove"></span></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col-md-12 text-center">
            <?= $pagination; ?>
        </div>
    </div>
<?php else: ?>
    <h3 align="center" style="margin-top: 50px;">No se encontraron agencias.</h3>
<?php endif; ?>

