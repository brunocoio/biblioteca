<?php

/**
 * AdminBanner.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os banners no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminBanner {

    private $Data;
    private $Banner;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_banners';

    /**
     * <b>Cadastrar o Banner:</b> Envelope os dados do banner em um array atribuitivo e execute esse método
     * para cadastrar o banner. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um banner, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['banner_image']):
                $upload = new Upload;
                $upload->Image($this->Data['banner_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['banner_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['banner_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Banner:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * banner para atualiza-lo na tabela!
     * @param INT $BannerId = Id do banner
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($BannerId, array $Data) {
        $this->Banner = (int) $BannerId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este banner, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['banner_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE banner_id = :banner", "banner={$this->Banner}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['banner_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['banner_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['banner_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['banner_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Banner:</b> Informe o ID do banner a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $BannerId = Id do banner
     */
    public function ExeDelete($BannerId) {
        $this->Banner = (int) $BannerId;

        $ReadBanner = new Read;
        $ReadBanner->ExeRead(self::Entity, "WHERE banner_id = :banner", "banner={$this->Banner}");

        if (!$ReadBanner->getResult()):
            $this->Error = ["O banner que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $BannerDelete = $ReadBanner->getResult()[0];
            if (file_exists('../uploads/' . $BannerDelete['banner_image']) && !is_dir('../uploads/' . $BannerDelete['banner_image'])):
                unlink('../uploads/' . $BannerDelete['banner_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE banner_id = :bannerid", "bannerid={$this->Banner}");

            $this->Error = ["O banner <b>{$BannerDelete['banner_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Banner:</b> Informe o ID do banner e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os banners!
     * @param INT $BannerId = Id do banner
     * @param STRING $BannerStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($BannerId, $BannerStatus) {
        $this->Banner = (int) $BannerId;
        $this->Data['banner_status'] = (string) $BannerStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE banner_id = :id", "id={$this->Banner}");
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
        $Cover = $this->Data['banner_image'];
        $Content = $this->Data['banner_content'];
        unset($this->Data['banner_image'], $this->Data['banner_content']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['banner_date'] = date('Y-m-d H:i:s');
        $this->Data['banner_image'] = $Cover;
        $this->Data['banner_content'] = $Content;
    }

    //Verifica o NAME banner. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Banner) ? "banner_id != {$this->Banner} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} banner_title = :t", "t={$this->Data['banner_title']}");
        if ($readName->getResult()):
            $this->Data['banner_name'] = $this->Data['banner_name'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o banner no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O banner {$this->Data['banner_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o banner no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE banner_id = :id", "id={$this->Banner}");
        if ($Update->getResult()):
            $this->Error = ["O banner <b>{$this->Data['banner_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}