<?php

/**
 * AdminHomeContent.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os homecontents no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminHomeContent {

    private $Data;
    private $HomeContent;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_homecontents';

    /**
     * <b>Cadastrar o HomeContent:</b> Envelope os dados do homecontent em um array atribuitivo e execute esse método
     * para cadastrar o homecontent. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um homecontent, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['homecontent_image']):
                $upload = new Upload;
                $upload->Image($this->Data['homecontent_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['homecontent_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['homecontent_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar HomeContent:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * homecontent para atualiza-lo na tabela!
     * @param INT $HomeContentId = Id do homecontent
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($HomeContentId, array $Data) {
        $this->HomeContent = (int) $HomeContentId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este homecontent, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['homecontent_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE homecontent_id = :homecontent", "homecontent={$this->HomeContent}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['homecontent_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['homecontent_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['homecontent_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['homecontent_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta HomeContent:</b> Informe o ID do homecontent a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $HomeContentId = Id do homecontent
     */
    public function ExeDelete($HomeContentId) {
        $this->HomeContent = (int) $HomeContentId;

        $ReadHomeContent = new Read;
        $ReadHomeContent->ExeRead(self::Entity, "WHERE homecontent_id = :homecontent", "homecontent={$this->HomeContent}");

        if (!$ReadHomeContent->getResult()):
            $this->Error = ["O homecontent que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $HomeContentDelete = $ReadHomeContent->getResult()[0];
            if (file_exists('../uploads/' . $HomeContentDelete['homecontent_image']) && !is_dir('../uploads/' . $HomeContentDelete['homecontent_image'])):
                unlink('../uploads/' . $HomeContentDelete['homecontent_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE homecontent_id = :homecontentid", "homecontentid={$this->HomeContent}");

            $this->Error = ["O homecontent <b>{$HomeContentDelete['homecontent_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa HomeContent:</b> Informe o ID do homecontent e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os homecontents!
     * @param INT $HomeContentId = Id do homecontent
     * @param STRING $HomeContentStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($HomeContentId, $HomeContentStatus) {
        $this->HomeContent = (int) $HomeContentId;
        $this->Data['homecontent_status'] = (string) $HomeContentStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE homecontent_id = :id", "id={$this->HomeContent}");
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
        $Cover = $this->Data['homecontent_image'];
        $Content = $this->Data['homecontent_content'];
        unset($this->Data['homecontent_image'], $this->Data['homecontent_content']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['homecontent_date'] = date('Y-m-d H:i:s');
        $this->Data['homecontent_image'] = $Cover;
        $this->Data['homecontent_content'] = $Content;
    }

    //Verifica o NAME homecontent. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->HomeContent) ? "homecontent_id != {$this->HomeContent} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} homecontent_title = :t", "t={$this->Data['homecontent_title']}");
        if ($readName->getResult()):
            $this->Data['homecontent_title'] = $this->Data['homecontent_title'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o homecontent no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O homecontent {$this->Data['homecontent_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o homecontent no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE homecontent_id = :id", "id={$this->HomeContent}");
        if ($Update->getResult()):
            $this->Error = ["O homecontent <b>{$this->Data['homecontent_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}