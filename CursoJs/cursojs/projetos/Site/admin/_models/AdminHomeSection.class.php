<?php

/**
 * AdminHomeSection.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os homesections no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminHomeSection {

    private $Data;
    private $HomeSection;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_homesections';

    /**
     * <b>Cadastrar o HomeSection:</b> Envelope os dados do homesection em um array atribuitivo e execute esse método
     * para cadastrar o homesection. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um homesection, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['homesection_image']):
                $upload = new Upload;
                $upload->Image($this->Data['homesection_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['homesection_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['homesection_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar HomeSection:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * homesection para atualiza-lo na tabela!
     * @param INT $HomeSectionId = Id do homesection
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($HomeSectionId, array $Data) {
        $this->HomeSection = (int) $HomeSectionId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este homesection, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['homesection_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE homesection_id = :homesection", "homesection={$this->HomeSection}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['homesection_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['homesection_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['homesection_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['homesection_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta HomeSection:</b> Informe o ID do homesection a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $HomeSectionId = Id do homesection
     */
    public function ExeDelete($HomeSectionId) {
        $this->HomeSection = (int) $HomeSectionId;

        $ReadHomeSection = new Read;
        $ReadHomeSection->ExeRead(self::Entity, "WHERE homesection_id = :homesection", "homesection={$this->HomeSection}");

        if (!$ReadHomeSection->getResult()):
            $this->Error = ["O homesection que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $HomeSectionDelete = $ReadHomeSection->getResult()[0];
            if (file_exists('../uploads/' . $HomeSectionDelete['homesection_image']) && !is_dir('../uploads/' . $HomeSectionDelete['homesection_image'])):
                unlink('../uploads/' . $HomeSectionDelete['homesection_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE homesection_id = :homesectionid", "homesectionid={$this->HomeSection}");

            $this->Error = ["O homesection <b>{$HomeSectionDelete['homesection_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa HomeSection:</b> Informe o ID do homesection e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os homesections!
     * @param INT $HomeSectionId = Id do homesection
     * @param STRING $HomeSectionStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($HomeSectionId, $HomeSectionStatus) {
        $this->HomeSection = (int) $HomeSectionId;
        $this->Data['homesection_status'] = (string) $HomeSectionStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE homesection_id = :id", "id={$this->HomeSection}");
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
        $Cover = $this->Data['homesection_image'];
        $Section = $this->Data['homesection_title'];
        unset($this->Data['homesection_image'], $this->Data['homesection_title']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['homesection_date'] = date('Y-m-d H:i:s');
        $this->Data['homesection_image'] = $Cover;
        $this->Data['homesection_title'] = $Section;
    }

    //Verifica o NAME homesection. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->HomeSection) ? "homesection_id != {$this->HomeSection} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} homesection_title = :t", "t={$this->Data['homesection_title']}");
        if ($readName->getResult()):
            $this->Data['homesection_title'] = $this->Data['homesection_title'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o homesection no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O homesection {$this->Data['homesection_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o homesection no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE homesection_id = :id", "id={$this->HomeSection}");
        if ($Update->getResult()):
            $this->Error = ["O homesection <b>{$this->Data['homesection_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}