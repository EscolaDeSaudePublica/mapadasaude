<?php
$this->layout = 'nolayout';
$reg = $app->view->regObject['ins'];

include_once('header.php');  

if (!empty($reg->opportunity->getFile('header')->path)) :

?>

<table width="100%" style="height: 100px; margin-bottom: 50px; width: 100%;">
    <thead>
        <tr>
            <td>
                <?php if (!empty($reg->opportunity->getFile('header')->path)) : ?>
                    <!-- <img src="<?php //echo $reg->opportunity->getFile('header')->path; ?>" alt=""> -->
                    <div>
                        <br><br><br>
                    </div>
                    <!-- <header class="main-content-header" style="border-radius: 8px;">
                        <div
                            <?php if ($header = $reg->opportunity->getFile('header')) : ?>
                                class="header-image"
                                style="background-image: url(<?php //echo $header->transform('header')->url; ?>);"
                            <?php endif; ?>
                        >
                        </div> -->
                    <div>
                        <img src="<?php echo $reg->opportunity->getFile('header')->path; ?>" alt="">
                    </div>
                    </header>
                <?php else : ?>
                    <img src="<?php echo PLUGINS_PATH.'PDFReport/assets/img/backgroud_header_report_opp.png'; ?>" 
                    style="float:left;  width: 650px"/>
                    <!-- <img src="<?php //$this->asset('img/backgroud_header_report_opp.png') ?>" alt=""> -->
                <?php endif; ?>
            </td>
        </tr>
        <thead>
</table>
<?php endif; ?>
<main>
<table style="width: 100%;" class="table-info-ins">
    <thead>
        <tr>
            <td style="width: 50%;" style=" background: #480dd1;">
                <label class="title-ins-label">Inscrição</label> <br>
                <label class="title-ins-sublabel"><?php echo $reg->id; ?></label>
            </td>
            <td  style="width: 50%;">
                <label class="title-ins-sublabel title-ins-sublabel-right">
                    Registrada no dia: <?php echo $reg->sentTimestamp->format('d/m/Y'); ?> 
                </label> <br>
            </td>
        </tr>
    </thead>
</table>

<table width="100%" style="height: 100px; margin-top: 16px">
    <thead>
        <tr class="">
            <td style="width: 10%;">

                <!-- <img src="<?php $this->asset('img/logo-saude.png') ?>"  class="pull-left" > -->
                <?php if (!empty($reg->opportunity->files['avatar'])) : ?>
                    <img src="<?php echo $reg->opportunity->files['avatar']->path; ?>" style="width: 80px; height: 80px;">
                <?php else : ?>
                    <img src="<?php echo THEMES_PATH . 'BaseV1/assets/img/avatar--opportunity.png'; ?>" 
                    style="width: 80px; height: 80px;">
                    <!-- <label for=""><?php echo THEMES_PATH . 'BaseV1/assets/img/avatar--opportunity.png'; ?></label> -->
                <?php endif; ?>

            </td>
            <td style="width: 90%;">
                <!-- <img src="<?php $this->asset('img/ESP-CE-ORGAO-SEC-INVERTIDA-WEB2_3.png') ?>" class="pull-right" alt=""> -->
                <label for="" class="title-edital">Edital</label><br>
                <label class="sub-title-edital"><?php echo $reg->opportunity->ownerEntity->name; ?></label>
                <br>
                <label for="" class="title-edital">Oportunidade</label><br>
                <label class="sub-title-edital"><?php echo $reg->opportunity->name; ?></label>
            </td>
        </tr>
    </thead>
</table>

<table style="margin-top: 24px">
    <thead>
        <tr>
            <td>
                <p class="my-registration-email-confirm">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt harum similique pariatur obcaecati tempora 
                    recusandae delectus, id ipsa totam exercitationem impedit libero blanditiis ullam quae sit labore quod optio 
                    laudantium?
                </p>
            </td>
        </tr>
    </thead>
</table>

<table style="width: 100%;">
    <tbody>
        <tr>
            <td>
                <div  style="border: 1px solid #E8E8E8; border-radius: 8px; width:  100%;; height: 400px;">
                    <label class="my-registration-fields">
                        Agente responsável pela inscrição
                    </label>
                    <br>
                    <?php if(!empty($reg->owner->avatar)): ?>
                        <img src="<?php echo $reg->owner->avatar->transform('avatarSmall')->url ?>" alt="">
                    <?php else: ?>
                        <img src="<?php echo PLUGINS_PATH.'PDFReport/assets/img/avatar--agent.png'; ?>" alt=""
                        style="width: 24px;height: 24px;flex: none;order: 0;flex-grow: 0;margin: 8px 8px;
                        background: rgba(0, 0, 0, 0.38);  border-radius: 80%">
                        <label style="font-size: 12px;line-height: 9px;color: rgba(0, 0, 0, 0.87);
                        font-style: normal;font-weight: normal;letter-spacing: 0.5px;
                        align-items: center;">
                            <?php echo $reg->number; ?>
                        </label> 
                        <!-- <img src="<?php $this->asset('img/avatar--agent.png') ?>" alt=""
                        style="width: 24px;height: 24px;flex: none;order: 0;flex-grow: 0;margin: 0px 8px;"> -->
                    <?php endif; 
                        $data_nascimento_pdf = !empty($reg->owner->metadata['dataDeNascimento'])? date("d/m/Y", strtotime($reg->owner->metadata['dataDeNascimento'])) : "";
                        $genero_pdf = !empty($reg->owner->metadata['genero']) ? $reg->owner->metadata['genero']: "";
                        $orientacao_sexual_pdf = !empty($reg->owner->metadata['orientacaoSexual']) ? $reg->owner->metadata['orientacaoSexual']: "";
                        $raca_pdf = !empty($reg->owner->metadata['raca']) ? $reg->owner->metadata['raca']: "";
                        $email_privado_pdf = !empty($reg->owner->metadata['emailPrivado']) ? $reg->owner->metadata['emailPrivado']: "";
                        $email_publico_pdf = !empty($reg->owner->metadata['emailPublico']) ? $reg->owner->metadata['emailPublico']: "";
                        $telefone_publico_pdf = !empty($reg->owner->metadata['telefonePublico']) ? $reg->owner->metadata['telefonePublico']: "";
                        $telefone1_pdf = !empty($reg->owner->metadata['telefone1']) ? $reg->owner->metadata['telefone1']: "";
                        $telefone2_pdf = !empty($reg->owner->metadata['telefone2']) ? $reg->owner->metadata['telefone2']: "";
                        $curriculo_lattes_pdf = !empty($reg->owner->metadata['curriculoLattes']) ? $reg->owner->metadata['curriculoLattes']: "";
                        $profissionais_graus_academicos = !empty($reg->owner->metadata['profissionais_graus_academicos']) ? $reg->owner->metadata['profissionais_graus_academicos']: "";

                    ?>
                    <br> <br>
                    <label class="my-registration-fields">Site: </label><span><?php echo ""; ?></label><br>
                    <label class="my-registration-fields">Nome completo: </label><span> <?php echo $reg->owner->name ? $reg->owner->name : ""; ?></span><br>
                    <label class="my-registration-fields">Data de Nascimento/Fundação: </label><span><?php echo $data_nascimento_pdf; ?></span><br>
                    <label class="my-registration-fields">Gênero: </label><span><?php echo $genero_pdf;?></span><br>
                    <label class="my-registration-fields">Orientação Sexual: </label><span><?php echo $orientacao_sexual_pdf; ?></span><br>
                    <label class="my-registration-fields">Raça/Cor: </label><span><?php echo $raca_pdf; ?></span><br>
                    <label class="my-registration-fields">Email Privado: </label><span><?php echo $email_privado_pdf; ?></span><br>
                    <label class="my-registration-fields">E-mail: </label><span><?php echo $email_publico_pdf; ?></span><br>
                    <label class="my-registration-fields">Telefone Público: </label><span><?php echo $telefone_publico_pdf; ?></span><br>
                    <label class="my-registration-fields">Telefone 1: </label><span><?php echo $telefone1_pdf; ?></span><br>
                    <label class="my-registration-fields">Telefone 2: </label><span><?php echo $telefone2_pdf; ?></span><br>
                    <label class="my-registration-fields">Currículo Lattes: </label><span><?php echo $curriculo_lattes_pdf; ?></span><br>
                    <label class="my-registration-fields">Grau acadêmico: </label><span><?php echo $profissionais_graus_academicos; ?></span><br>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php
$fieldOp = $app->view->regObject['fieldsOpportunity'];
$this->part('reports/section', ['field' => $fieldOp, 'reg' => $reg]);


include_once('footerPdf.php');