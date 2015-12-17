<!-- https://developers.google.com/transit/gtfs/reference?csw=1#agency_fields -->
<h1><?= $this->module['title_list']; ?></h1>
<h3>Una o varias empresas de transporte público que proporcionan los datos de este feed.</h3>
<p class="alert alert-info"><i class="awe-star"></i> Archivo: Obligatorio</p>
<form class="form-horizontal" action="<?= $urlAction; ?>" method="post" novalidate>
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="agency_id">agency_id</label>
            <div class="controls">
                <input type="text" id="input" name="agency_id" id="agency_id" class="input-xlarge" value="<?= $r['agency_id'] ? $r['agency_id'] : ''; ?>" placeholder="Opcional" maxlength="10">
                <p class="help-block">El campo <strong>agency_id</strong> es un ID que identifica de forma exclusiva a
                    una empresa de transporte público. Un feed de transporte público puede representar datos de
                    más de una empresa. El <strong>agency_id</strong> es un conjunto de datos
                    único. Este campo es opcional para los feeds de transporte público que solo incluyan
                    datos de una sola empresa.</p>
                <?= form_error('agency_id'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_name">agency_name</label>
            <div class="controls">
                <input type="text" id="input" name="agency_name" id="agency_name" class="input-xlarge" value="<?= $r['agency_name'] ? $r['agency_name'] : ''; ?>" placeholder="Obligatorio" maxlength="300" required data-validation-required-message="Debe ingresar el nombre de la agencia">
                <p class="help-block">El campo <strong>agency_name</strong> contiene el nombre completo de la
                    empresa de transporte público. Google Maps mostrará este nombre. </p>
                <?= form_error('agency_name'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_url">agency_url</label>
            <div class="controls">
                <input type="text" id="input" name="agency_url" id="agency_url" class="input-xlarge" value="<?= $r['agency_url'] ? $r['agency_url'] : ''; ?>" placeholder="Obligatorio" maxlength="300" required data-validation-required-message="Debe ingresar la dirección URL de la agencia">
                <p class="help-block">El campo <strong>agency_url</strong> contiene la URL de la
                    empresa de transporte público. El valor debe ser una URL completa que
                    incluya <strong>http://</strong> o <strong>https://</strong>, y
                    cualquier carácter especial que incluya la URL debe tener el formato de
                    escape correcto. Consulta <a href="http://www.w3.org/Addressing/URL/4_URI_Recommentations.html" target="_blank">http://www.w3.org/Addressing/URL/4_URI_Recommentations.html</a>
                    para obtener una descripción de cómo crear valores de URL completas que cumplan los requisitos.</p>
                <?= form_error('agency_url'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_timezone">agency_timezone</label>
            <div class="controls">
                <input type="text" id="input" name="agency_timezone" id="agency_timezone" class="input-xlarge" value="<?= $r['agency_timezone'] ? $r['agency_timezone'] : ''; ?>" placeholder="Obligatorio" maxlength="30" required data-validation-required-message="Debe ingresar la zona de tiempo de la agencia">
                <p class="help-block">El campo <strong>agency_timezone</strong> contiene la zona horaria del
                    lugar en el que se encuentra la empresa de transporte público. Los nombres de zona horaria no pueden incluir nunca
                    el carácter de espacio, aunque sí el carácter de subrayado. Consulta
                    <a href="http://en.wikipedia.org/wiki/List_of_tz_zones">http://en.wikipedia.org/wiki/List_of_tz_zones</a> 
                    para obtener una lista de valores válidos.  Si se especifican varias empresas en el 
                    feed, cada una debe tener el mismo valor en <strong>agency_timezone</strong>.</p>
                <?= form_error('agency_timezone'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_lang">agency_lang</label>
            <div class="controls">
                <input type="text" id="input" name="agency_lang" id="agency_lang" class="input-xlarge" value="<?= $r['agency_lang'] ? $r['agency_lang'] : ''; ?>" placeholder="Opcional" maxlength="300">
                <p class="help-block">El campo <strong>agency_lang</strong> contiene un código ISO 639-1 de dos letras
                    correspondiente al idioma principal usado por la empresa de transporte público. El
                    código de idioma no distingue entre mayúsculas y minúsculas, es decir, se acepta tanto "en" como "EN". Esta
                    configuración define las normas sobre el uso de mayúsculas y otra configuración específica del
                    idioma para todo el texto incluido en el feed de la empresa de transporte público.
                    Consulta
                    <a href="http://www.loc.gov/standards/iso639-2/php/code_list.php" data-tooltip-align="b,c" data-tooltip="la lista de códigos ISO 639-2" aria-label="la lista de códigos ISO 639-2" data-title="la lista de códigos ISO 639-2" target="_blank">http://www.loc.gov/standards/iso639-2/php/code_list.php</a> para
                    obtener una lista de valores válidos.</p>
                <?= form_error('agency_lang'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_phone">agency_phone</label>
            <div class="controls">
                <input type="text" id="input" name="agency_phone" id="agency_phone" class="input-xlarge" value="<?= $r['agency_phone'] ? $r['agency_phone'] : ''; ?>" placeholder="Opcional" maxlength="30">
                <p class="help-block">El campo <strong>agency_phone</strong> 
                    contiene un solo número de teléfono para la empresa especificada.
                    Este campo es un valor de cadena que presenta el número de teléfono
                    habitual correspondiente al área de servicio de la empresa de transporte público.  Puede y debe incluir
                    signos de puntuación para agrupar los dígitos del número. Se permite el uso de texto de marcación
                    (por ejemplo, "503-238-RIDE" de TriMet), aunque
                    el campo no debe incluir ningún otro texto descriptivo. </p>
                <?= form_error('agency_phone'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="agency_fare_url">agency_fare_url</label>
            <div class="controls">
                <input type="text" id="input" name="agency_fare_url" id="agency_fare_url" class="input-xlarge" value="<?= $r['agency_fare_url'] ? $r['agency_fare_url'] : ''; ?>" placeholder="Opcional" maxlength="300">
                <p class="help-block"><strong>agency_fare_url</strong> especifica la URL de una página web
                    que permite a un pasajero comprar boletos u otros tipos de pasajes en
                    esa empresa en línea.  El valor debe ser una URL completa que
                    incluya <strong>http://</strong> o <strong>https://</strong>, y 
                    cualquier carácter especial que incluya la URL debe tener el formato de
                    escape correcto. Consulta <a href="http://www.w3.org/Addressing/URL/4_URI_Recommentations.html" target="_blank">http://www.w3.org/Addressing/URL/4_URI_Recommentations.html</a>
                    para obtener una descripción de cómo crear valores de URL completas que cumplan los requisitos. </p>
                <?= form_error('agency_fare_url'); ?>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-alt btn-large btn-primary" type="submit"><?= $etiquetaBoton; ?></button>
            <input type="hidden" name="id_agencia" value="<?= isset($r['id_agencia']) ? $r['id_agencia'] : ''; ?>">
        </div>
    </fieldset>
</form>