<?php

/**
 * AdminHomeTestimonial.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os hometestimonials no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminHomeTestimonial {

    private $Data;
    private $HomeTestimonial;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_hometestimonials';

    /**
     * <b>Cadastrar o HomeTestimonial:</b> Envelope os dados do hometestimonial em um array atribuitivo e execute esse método
     * para cadastrar o hometestimonial. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um hometestimonial, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['hometestimonial_image']):
                $upload = new Upload;
                $upload->Image($this->Data['hometestimonial_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['hometestimonial_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['hometestimonial_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar HomeTestimonial:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * hometestimonial para atualiza-lo na tabela!
     * @param INT $HomeTestimonialId = Id do hometestimonial
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($HomeTestimonialId, array $Data) {
        $this->HomeTestimonial = (int) $HomeTestimonialId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este hometestimonial, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['hometestimonial_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE hometestimonial_id = :hometestimonial", "hometestimonial={$this->HomeTestimonial}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['hometestimonial_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['hometestimonial_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['hometestimonial_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['hometestimonial_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta HomeTestimonial:</b> Informe o ID do hometestimonial a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $HomeTestimonialId = Id do hometestimonial
     */
    public function ExeDelete($HomeTestimonialId) {
        $this->HomeTestimonial = (int) $HomeTestimonialId;

        $ReadHomeTestimonial = new Read;
        $ReadHomeTestimonial->ExeRead(self::Entity, "WHERE hometestimonial_id = :hometestimonial", "hometestimonial={$this->HomeTestimonial}");

        if (!$ReadHomeTestimonial->getResult()):
            $this->Error = ["O hometestimonial que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $HomeTestimonialDelete = $ReadHomeTestimonial->getResult()[0];
            if (file_exists('../uploads/' . $HomeTestimonialDelete['hometestimonial_image']) && !is_dir('../uploads/' . $HomeTestimonialDelete['hometestimonial_image'])):
                unlink('../uploads/' . $HomeTestimonialDelete['hometestimonial_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE hometestimonial_id = :hometestimonialid", "hometestimonialid={$this->HomeTestimonial}");

            $this->Error = ["O hometestimonial <b>{$HomeTestimonialDelete['hometestimonial_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa HomeTestimonial:</b> Informe o ID do hometestimonial e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os hometestimonials!
     * @param INT $HomeTestimonialId = Id do hometestimonial
     * @param STRING $HomeTestimonialStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($HomeTestimonialId, $HomeTestimonialStatus) {
        $this->HomeTestimonial = (int) $HomeTestimonialId;
        $this->Data['hometestimonial_status'] = (string) $HomeTestimonialStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE hometestimonial_id = :id", "id={$this->HomeTestimonial}");
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
        $Cover = $this->Data['hometestimonial_image'];
        $Testimonial = $this->Data['hometestimonial_title'];
        unset($this->Data['hometestimonial_image'], $this->Data['hometestimonial_title']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        $this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['hometestimonial_date'] = date('Y-m-d H:i:s');
        $this->Data['hometestimonial_image'] = $Cover;
        $this->Data['hometestimonial_title'] = $Testimonial;
    }

    //Verifica o NAME hometestimonial. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->HomeTestimonial) ? "hometestimonial_id != {$this->HomeTestimonial} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} hometestimonial_title = :t", "t={$this->Data['hometestimonial_title']}");
        if ($readName->getResult()):
            $this->Data['hometestimonial_title'] = $this->Data['hometestimonial_title'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o hometestimonial no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O hometestimonial {$this->Data['hometestimonial_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o hometestimonial no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE hometestimonial_id = :id", "id={$this->HomeTestimonial}");
        if ($Update->getResult()):
            $this->Error = ["O hometestimonial <b>{$this->Data['hometestimonial_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}