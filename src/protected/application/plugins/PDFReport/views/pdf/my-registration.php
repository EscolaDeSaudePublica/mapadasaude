<?php
$this->layout = 'nolayout';
$reg = $app->view->regObject['ins'];

// dump($reg->opportunity); die;
include_once('header.php');  ?>

<table width="100%" style="height: 100px;">
    <thead>
        <tr>
            <td>
                <?php if (empty($reg->opportunity->getFile('header')->path)) : ?>
                    <!-- <img src="<?php echo $reg->opportunity->getFile('header')->path; ?>" alt=""> -->
                    <div>
                        <br><br><br>
                    </div>
                    <header class="main-content-header" style="border-radius: 8px;">
                        <div
                            <?php if ($header = $reg->opportunity->getFile('header')) : ?>
                                class="header-image"
                                style="background-image: url(<?php echo $header->transform('header')->url; ?>);"
                            <?php endif; ?>
                        >
                        </div>
                    <!-- <div>
                        <img src="<?php echo $reg->opportunity->getFile('header')->path; ?>" alt="">
                    </div> -->
                    </header>
                <?php else : ?>
                    <img src="<?php $this->asset('img/backgroud_header_report_opp.png') ?>" alt="">
                <?php endif; ?>
            </td>
        </tr>
        <thead>
</table>

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
                    <img src="<?php echo THEMES_PATH . 'BaseV1/assets/img/avatar--opportunity.png'; ?>" style="width: 80px; height: 80px;">
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

<table  style="width: 100%;">
    <tbody>
        <tr>
            <td>
                <div  style="border: 1px solid #E8E8E8; border-radius: 8px; width:  100%;; height: 400px;">
                    <label style="float: left; color: rgba(0, 0, 0, 0.87);font-weight: bold; width: 100%; font-size: 10px">
                        Agente responsável pela inscrição
                       
                    </label>
                    <br>
                    <?php if(!empty($reg->owner->avatar)): ?>
                        <img src="<?php echo $reg->owner->avatar->transform('avatarSmall')->url ?>" alt="">
                    <?php else: ?>
                        <img src="<?php echo PLUGINS_PATH.'PDFReport/assets/img/avatar--agent.png'; ?>" alt=""
                        style="width: 24px;height: 24px;flex: none;order: 0;flex-grow: 0;margin: 0px 8px;
                        background: rgba(0, 0, 0, 0.38);  border-radius: 80%">
                        <label style="font-size: 12px;line-height: 9px;color: rgba(0, 0, 0, 0.87);
                        font-style: normal;font-weight: normal;letter-spacing: 0.5px;
                        align-items: center;">
                            <?php echo $reg->number; ?>
                        </label> 
                        <!-- <img src="<?php $this->asset('img/avatar--agent.png') ?>" alt=""
                        style="width: 24px;height: 24px;flex: none;order: 0;flex-grow: 0;margin: 0px 8px;"> -->
                    <?php endif; ?>
                    <br> <br>
                    <label class="mt-4">Site: </label><span><?php echo ""; ?></span><br>
                    <label class="mt-4">Nome completo: </label><span> <?php echo $reg->owner->name; ?></span><br>
                    <label class="mt-4">Data de Nascimento/Fundação: </label><span><?php echo $reg->owner->metadata['dataDeNascimento']; ?></span><br>
                    <label class="mt-4">Gênero: </label><span><?php echo $reg->owner->metadata['genero']; ?></span><br>
                    <label class="mt-4">Orientação Sexual: </label><span><?php echo $reg->owner->metadata['orientacaoSexual']; ?></span><br>
                    <label class="mt-4">Raça/Cor: </label><span><?php echo $reg->owner->metadata['raca']; ?></span><br>
                    <label class="mt-4">Email Privado: </label><span><?php echo $reg->owner->metadata['emailPrivado']; ?></span><br>
                    <label class="mt-4">E-mail: </label><span><?php echo $reg->owner->metadata['emailPublico']; ?></span><br>
                    <label class="mt-4">Telefone Público: </label><span><?php echo $reg->owner->metadata['telefonePublico']; ?></span><br>
                    <label class="mt-4">Telefone 1: </label><span><?php echo $reg->owner->metadata['telefone1']; ?></span><br>
                    <label class="mt-4">Telefone 2: </label><span><?php echo $reg->owner->metadata['telefone2']; ?></span><br>
                    <label class="mt-4">Currículo Lattes: </label><span><?php echo $reg->owner->metadata['curriculoLattes']; ?></span><br>
                    <label class="mt-4">Grau acadêmico: </label><span><?php echo $reg->owner->metadata['profissionais_graus_academicos']; ?></span><br>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<?php
include_once('footerPdf.php');