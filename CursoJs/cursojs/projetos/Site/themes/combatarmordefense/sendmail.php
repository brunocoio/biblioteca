<?php
ob_start();
require('../../_app/Config.inc.php');
require('../../_app/Models/Email.class.php');
$Session = new Session;
?>
<?php

if (isset($_POST)):
    $Contato = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($Contato['SendFormContato']);
    $Contato['Assunto'] = 'Mensagem Contato';
    $Contato['DestinoNome'] = $Contato['RemetenteNome'];
    $Contato['DestinoEmail'] = MAILUSER;
    $Contato['RemetenteEmail'] = $Contato['RemetenteEmail'];
    $Contato['Mensagem'] = 'Nome: '.$Contato['RemetenteNome'] .'<br />Telefone: '. $Contato['RemetenteTelefone'] .'<br />E-mail: '. $Contato['RemetenteEmail'] .'<br />Mensagem: '. $Contato['Mensagem'];
//var_dump($Contato);die();
    $SendMail = new Email;
    $SendMail->Enviar($Contato);

    if ($SendMail->getError()):
        WSErro($SendMail->getError()[0], $SendMail->getError()[1]);
    endif;

endif;
?>