<?php

/**
 * AdminBlindagem.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os blindagens no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminBlindagem {

    private $Data;
    private $Blindagem;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_blindagens';

    /**
     * <b>Cadastrar o Blindagem:</b> Envelope os dados do blindagem em um array atribuitivo e execute esse método
     * para cadastrar o blindagem. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um blindagem, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['blindagem_image']):
                $upload = new Upload;
                $upload->Image($this->Data['blindagem_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['blindagem_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['blindagem_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Blindagem:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * blindagem para atualiza-lo na tabela!
     * @param INT $BlindagemId = Id do blindagem
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($BlindagemId, array $Data) {
        $this->Blindagem = (int) $BlindagemId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este blindagem, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['blindagem_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE blindagem_id = :blindagem", "blindagem={$this->Blindagem}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['blindagem_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['blindagem_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['blindagem_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['blindagem_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Blindagem:</b> Informe o ID do blindagem a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $BlindagemId = Id do blindagem
     */
    public function ExeDelete($BlindagemId) {
        $this->Blindagem = (int) $BlindagemId;

        $ReadBlindagem = new Read;
        $ReadBlindagem->ExeRead(self::Entity, "WHERE blindagem_id = :blindagem", "blindagem={$this->Blindagem}");

        if (!$ReadBlindagem->getResult()):
            $this->Error = ["O blindagem que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $BlindagemDelete = $ReadBlindagem->getResult()[0];
            if (file_exists('../uploads/' . $BlindagemDelete['blindagem_image']) && !is_dir('../uploads/' . $BlindagemDelete['blindagem_image'])):
                unlink('../uploads/' . $BlindagemDelete['blindagem_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE blindagem_id = :blindagemid", "blindagemid={$this->Blindagem}");

            $this->Error = ["O blindagem <b>{$BlindagemDelete['blindagem_name']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Blindagem:</b> Informe o ID do blindagem e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os blindagems!
     * @param INT $BlindagemId = Id do blindagem
     * @param STRING $BlindagemStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($BlindagemId, $BlindagemStatus) {
        $this->Blindagem = (int) $BlindagemId;
        $this->Data['blindagem_status'] = (string) $BlindagemStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE blindagem_id = :id", "id={$this->Blindagem}");
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna ID do registro se o cadastro for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = InsertID or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com uma mensagem e o tipo de erro.
     * @return ARRAY $Error = Array associatico com o erro
     */
    public function getError() {
        return $this->Error;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    //Valida e cria os dados para realizar o cadastro
    private function setData() {
        $Cover = $this->Data['blindagem_image'];
        $Content = $this->Data['blindagem_content'];
        unset($this->Data['blindagem_image'], $this->Data['blindagem_content']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['blindagem_date'] = date('Y-m-d H:i:s');
        $this->Data['blindagem_image'] = $Cover;
        $this->Data['blindagem_content'] = $Content;
    }

    //Verifica o NAME blindagem. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Blindagem) ? "blindagem_id != {$this->Blindagem} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} blindagem_name = :t", "t={$this->Data['blindagem_name']}");
        if ($readName->getResult()):
            $this->Data['blindagem_name'] = $this->Data['blindagem_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o blindagem no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O blindagem {$this->Data['blindagem_name']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o blindagem no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE blindagem_id = :id", "id={$this->Blindagem}");
        if ($Update->getResult()):
            $this->Error = ["O blindagem <b>{$this->Data['blindagem_name']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}