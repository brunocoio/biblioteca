<?php

/**
 * AdminMidia.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os mídias no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminMidia {

    private $Data;
    private $Midia;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_midias';

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
     * @param INT $MidiaId = Id do mídia
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($MidiaId, array $Data) {
        $this->Midia = (int) $MidiaId;
        $this->Data = $Data;

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Mídia:</b> Informe o ID do mídia que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $MidiaId = Id do mídia
     */
    public function ExeDelete($MidiaId) {
        $this->Midia = (int) $MidiaId;

        $readMidia = new Read;
        $readMidia->ExeRead(self::Entity, "WHERE midia_id = :id", "id={$this->Midia}");

        if (!$readMidia->getResult()):
            $this->Error = ['Oppsss, você tentou remover uma mídia que não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $this->Delete();
        endif;
    }

    /**
     * <b>Ativa/Inativa Midia:</b> Informe o ID do midia e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os midias!
     * @param INT $MidiaId = Id do midia
     * @param STRING $MidiaStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($MidiaId, $MidiaStatus) {
        $this->Midia = (int) $MidiaId;
        $this->Data['midia_status'] = (string) $MidiaStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE midia_id = :id", "id={$this->Midia}");
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
            $this->checkMidia();
        endif;
    }

    //Verifica mídia pelo midia, Impede cadastro duplicado!
    private function checkMidia() {
        $Where = ( isset($this->Midia) ? "midia_id != {$this->Midia} AND" : '');

        $readMidia = new Read;
        $readMidia->ExeRead(self::Entity, "WHERE {$Where} midia_name = :name", "name={$this->Data['midia_name']}");

        if ($readMidia->getRowCount()):
            $this->Error = ["O midia informado foi cadastrado no sistema por outro usuário! Informe outro midia!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Cadasrtra Mídia!
    private function Create() {
        $Create = new Create;
        $this->Data['midia_date'] = date('Y-m-d H:i:s');

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O midia <b>{$this->Data['midia_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();
        endif;
    }

    //Atualiza Mídia!
    private function Update() {
        $Update = new Update;

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE midia_id = :id", "id={$this->Midia}");
        if ($Update->getResult()):
            $this->Error = ["O midia <b>{$this->Data['midia_name']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    //Remove Mídia
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE midia_id = :id", "id={$this->Midia}");
        if ($Delete->getResult()):
            $this->Error = ["Midia removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}