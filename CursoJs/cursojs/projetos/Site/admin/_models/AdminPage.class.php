<?php

/**
 * AdminPage.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os pages no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminPage {

    private $Data;
    private $Page;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_pages';

    /**
     * <b>Cadastrar o Page:</b> Envelope os dados do page em um array atribuitivo e execute esse método
     * para cadastrar o page. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um page, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['page_image']):
                $upload = new Upload;
                $upload->Image($this->Data['page_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['page_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['page_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Page:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * page para atualiza-lo na tabela!
     * @param INT $PageId = Id do page
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($PageId, array $Data) {
        $this->Page = (int) $PageId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este page, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['page_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE page_id = :page", "page={$this->Page}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['page_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['page_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['page_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['page_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Page:</b> Informe o ID do page a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $PageId = Id do page
     */
    public function ExeDelete($PageId) {
        $this->Page = (int) $PageId;

        $ReadPage = new Read;
        $ReadPage->ExeRead(self::Entity, "WHERE page_id = :page", "page={$this->Page}");

        if (!$ReadPage->getResult()):
            $this->Error = ["O page que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $PageDelete = $ReadPage->getResult()[0];
            if (file_exists('../uploads/' . $PageDelete['page_image']) && !is_dir('../uploads/' . $PageDelete['page_image'])):
                unlink('../uploads/' . $PageDelete['page_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE page_id = :pageid", "pageid={$this->Page}");

            $this->Error = ["O page <b>{$PageDelete['page_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Page:</b> Informe o ID do page e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os pages!
     * @param INT $PageId = Id do page
     * @param STRING $PageStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($PageId, $PageStatus) {
        $this->Page = (int) $PageId;
        $this->Data['page_status'] = (string) $PageStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE page_id = :id", "id={$this->Page}");
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
        $Cover = $this->Data['page_image'];
        $Section = $this->Data['page_title'];
        unset($this->Data['page_image'], $this->Data['page_title']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['page_date'] = date('Y-m-d H:i:s');
        $this->Data['page_image'] = $Cover;
        $this->Data['page_title'] = $Section;
    }

    //Verifica o NAME page. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Page) ? "page_id != {$this->Page} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} page_title = :t", "t={$this->Data['page_title']}");
        if ($readName->getResult()):
            $this->Data['page_title'] = $this->Data['page_title'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o page no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O page {$this->Data['page_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o page no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE page_id = :id", "id={$this->Page}");
        if ($Update->getResult()):
            $this->Error = ["O page <b>{$this->Data['page_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}