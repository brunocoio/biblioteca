<?php

/**
 * AdminProduto.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os produtos no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminProduto {

    private $Data;
    private $Produto;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_produtos';

    /**
     * <b>Cadastrar o Produto:</b> Envelope os dados do produto em um array atribuitivo e execute esse método
     * para cadastrar o produto. Envia a capa automaticamente!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um produto, favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if ($this->Data['produto_image']):
                $upload = new Upload;
                $upload->Image($this->Data['produto_image']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['produto_image'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['produto_image'] = null;
                $this->Create();
            endif;
        endif;
    }

    /**
     * <b>Atualizar Produto:</b> Envelope os dados em uma array atribuitivo e informe o id de um 
     * produto para atualiza-lo na tabela!
     * @param INT $ProdutoId = Id do produto
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($ProdutoId, array $Data) {
        $this->Produto = (int) $ProdutoId;
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este produto, preencha todos os campos ( Capa não precisa ser enviada! )", WS_ALERT];
            $this->Result = false;
        else:
            $this->setData();
            $this->setName();

            if (is_array($this->Data['produto_image'])):
                $readCapa = new Read;
                $readCapa->ExeRead(self::Entity, "WHERE produto_id = :produto", "produto={$this->Produto}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['produto_image'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload;
                $uploadCapa->Image($this->Data['produto_image']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['produto_image'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['produto_image']);
                $this->Update();
            endif;
        endif;
    }

    /**
     * <b>Deleta Produto:</b> Informe o ID do produto a ser removido para que esse método realize uma checagem de
     * pastas e galerias excluinto todos os dados nessesários!
     * @param INT $ProdutoId = Id do produto
     */
    public function ExeDelete($ProdutoId) {
        $this->Produto = (int) $ProdutoId;

        $ReadProduto = new Read;
        $ReadProduto->ExeRead(self::Entity, "WHERE produto_id = :produto", "produto={$this->Produto}");

        if (!$ReadProduto->getResult()):
            $this->Error = ["O produto que você tentou deletar não existe no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $ProdutoDelete = $ReadProduto->getResult()[0];
            if (file_exists('../uploads/' . $ProdutoDelete['produto_image']) && !is_dir('../uploads/' . $ProdutoDelete['produto_image'])):
                unlink('../uploads/' . $ProdutoDelete['produto_image']);
            endif;

            $deleta = new Delete;
            $deleta->ExeDelete(self::Entity, "WHERE produto_id = :produtoid", "produtoid={$this->Produto}");

            $this->Error = ["O produto <b>{$ProdutoDelete['produto_title']}</b> foi removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;

        endif;
    }

    /**
     * <b>Ativa/Inativa Produto:</b> Informe o ID do produto e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os produtos!
     * @param INT $ProdutoId = Id do produto
     * @param STRING $ProdutoStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($ProdutoId, $ProdutoStatus) {
        $this->Produto = (int) $ProdutoId;
        $this->Data['produto_status'] = (string) $ProdutoStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
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
        $Cover = $this->Data['produto_image'];
        $Section = $this->Data['produto_title'];
        unset($this->Data['produto_image'], $this->Data['produto_title']);

        //libera tag para edição
        //$this->Data = array_map('strip_tags', $this->Data);
        //$tags = OPENTAG;
        //$this->Data = array_map(function($item)use($tags){return strip_tags($item, $tags);}, $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['produto_date'] = date('Y-m-d H:i:s');
        $this->Data['produto_image'] = $Cover;
        $this->Data['produto_title'] = $Section;
    }

    //Verifica o NAME produto. Se existir adiciona um pós-fix -Count
    private function setName() {
        $Where = (isset($this->Produto) ? "produto_id != {$this->Produto} AND" : '');
        $readName = new Read;
        $readName->ExeRead(self::Entity, "WHERE {$Where} produto_title = :t", "t={$this->Data['produto_title']}");
        if ($readName->getResult()):
            $this->Data['produto_title'] = $this->Data['produto_title'] . '-' . $readName->getRowCount();
        endif;
    }

    //Cadastra o produto no banco!
    private function Create() {
        $cadastra = new Create;
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["O produto {$this->Data['produto_title']} foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    //Atualiza o produto no banco!
    private function Update() {
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE produto_id = :id", "id={$this->Produto}");
        if ($Update->getResult()):
            $this->Error = ["O produto <b>{$this->Data['produto_title']}</b> foi atualizado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}