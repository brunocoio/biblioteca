<?php

/**
 * AdminRodape.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os mídias no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminRodape {

    private $Data;
    private $Rodape;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_rodapes';

    /**
     * <b>Cadastrar Mídia:</b> Envelope os dados de um mídia em um array atribuitivo e execute esse método
     * para cadastrar o mesmo no sistema. Validações serão feitas!
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->checkData();

        if ($this->Result):
            $this->Create();
        endif;
    }

    /**
     * <b>Atualizar Mídia:</b> Envelope os dados em uma array atribuitivo e informe o id de um
     * mídia para atualiza-lo no sistema!
     * @param INT $RodapeId = Id do mídia
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($RodapeId, array $Data) {
        $this->Rodape = (int) $RodapeId;
        $this->Data = $Data;

        //$this->checkData();
        //não valida os campos preenchidos
        $this->checkRodape();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Mídia:</b> Informe o ID do mídia que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $RodapeId = Id do mídia
     */
    public function ExeDelete($RodapeId) {
        $this->Rodape = (int) $RodapeId;

        $readRodape = new Read;
        $readRodape->ExeRead(self::Entity, "WHERE rodape_id = :id", "id={$this->Rodape}");

        if (!$readRodape->getResult()):
            $this->Error = ['Oppsss, você tentou remover uma mídia que não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $this->Delete();
        endif;
    }

    /**
     * <b>Ativa/Inativa Rodape:</b> Informe o ID do rodape e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os rodapes!
     * @param INT $RodapeId = Id do rodape
     * @param STRING $RodapeStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($RodapeId, $RodapeStatus) {
        $this->Rodape = (int) $RodapeId;
        $this->Data['rodape_status'] = (string) $RodapeStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE rodape_id = :id", "id={$this->Rodape}");
    }

    /**
     * <b>Verificar Cadastro:</b> Retorna TRUE se o cadastro ou update for efetuado ou FALSE se não.
     * Para verificar erros execute um getError();
     * @return BOOL $Var = True or False
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Obter Erro:</b> Retorna um array associativo com um erro e um tipo.
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

    //Verifica os dados digitados no formulário
    private function checkData() {
        if (in_array('', $this->Data)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->checkRodape();
        endif;
    }

    //Verifica mídia pelo rodape, Impede cadastro duplicado!
    private function checkRodape() {
        $Where = ( isset($this->Rodape) ? "rodape_id != {$this->Rodape} AND" : '');

        $readRodape = new Read;
        $readRodape->ExeRead(self::Entity, "WHERE {$Where} rodape_name = :name", "name={$this->Data['rodape_name']}");

        if ($readRodape->getRowCount()):
            $this->Error = ["O rodape informado foi cadastrado no sistema por outro usuário! Informe outro rodape!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Cadasrtra Mídia!
    private function Create() {
        $Create = new Create;
        $this->Data['rodape_date'] = date('Y-m-d H:i:s');

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O rodape <b>{$this->Data['rodape_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();
        endif;
    }

    //Atualiza Mídia!
    private function Update() {
        $Update = new Update;

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE rodape_id = :id", "id={$this->Rodape}");
        if ($Update->getResult()):
            $this->Error = ["O rodape <b>{$this->Data['rodape_name']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    //Remove Mídia
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE rodape_id = :id", "id={$this->Rodape}");
        if ($Delete->getResult()):
            $this->Error = ["Rodape removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}