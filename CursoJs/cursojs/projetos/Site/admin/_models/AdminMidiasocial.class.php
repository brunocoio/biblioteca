<?php

/**
 * AdminMidiasocial.class [ MODEL ADMIN ]
 * Respnsável por gerenciar os mídias no Admin do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class AdminMidiasocial {

    private $Data;
    private $Midiasocial;
    private $Error;
    private $Result;

    //Nome da tabela no banco de dados
    const Entity = 'cad_midiassociais';

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
     * @param INT $MidiasocialId = Id do mídia
     * @param ARRAY $Data = Atribuitivo
     */
    public function ExeUpdate($MidiasocialId, array $Data) {
        $this->Midiasocial = (int) $MidiasocialId;
        $this->Data = $Data;

        $this->checkData();

        if ($this->Result):
            $this->Update();
        endif;
    }

    /**
     * <b>Remover Mídia:</b> Informe o ID do mídia que deseja remover. Este método não permite deletar
     * o próprio perfil ou ainda remover todos os ADMIN'S do sistema!
     * @param INT $MidiasocialId = Id do mídia
     */
    public function ExeDelete($MidiasocialId) {
        $this->Midiasocial = (int) $MidiasocialId;

        $readMidiasocial = new Read;
        $readMidiasocial->ExeRead(self::Entity, "WHERE midiasocial_id = :id", "id={$this->Midiasocial}");

        if (!$readMidiasocial->getResult()):
            $this->Error = ['Oppsss, você tentou remover uma mídia que não existe no sistema!', WS_ERROR];
            $this->Result = false;
        else:
            $this->Delete();
        endif;
    }

    /**
     * <b>Ativa/Inativa Midiasocial:</b> Informe o ID do midiasocial e o status e um status sendo 1 para ativo e 0 para
     * rascunho. Esse méto ativa e inativa os midiassociais!
     * @param INT $MidiasocialId = Id do midiasocial
     * @param STRING $MidiasocialStatus = 1 para ativo, 0 para inativo
     */
    public function ExeStatus($MidiasocialId, $MidiasocialStatus) {
        $this->Midiasocial = (int) $MidiasocialId;
        $this->Data['midiasocial_status'] = (string) $MidiasocialStatus;
        $Update = new Update;
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE midiasocial_id = :id", "id={$this->Midiasocial}");
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
            $this->checkMidiasocial();
        endif;
    }

    //Verifica mídia pelo midiasocial, Impede cadastro duplicado!
    private function checkMidiasocial() {
        $Where = ( isset($this->Midiasocial) ? "midiasocial_id != {$this->Midiasocial} AND" : '');

        $readMidiasocial = new Read;
        $readMidiasocial->ExeRead(self::Entity, "WHERE {$Where} midiasocial_name = :name", "name={$this->Data['midiasocial_name']}");

        if ($readMidiasocial->getRowCount()):
            $this->Error = ["O midiasocial informado foi cadastrado no sistema por outro usuário! Informe outro midiasocial!", WS_ERROR];
            $this->Result = false;
        else:
            $this->Result = true;
        endif;
    }

    //Cadasrtra Mídia!
    private function Create() {
        $Create = new Create;
        $this->Data['midiasocial_date'] = date('Y-m-d H:i:s');

        $Create->ExeCreate(self::Entity, $this->Data);

        if ($Create->getResult()):
            $this->Error = ["O midiasocial <b>{$this->Data['midiasocial_name']}</b> foi cadastrado com sucesso no sistema!", WS_ACCEPT];
            $this->Result = $Create->getResult();
        endif;
    }

    //Atualiza Mídia!
    private function Update() {
        $Update = new Update;

        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE midiasocial_id = :id", "id={$this->Midiasocial}");
        if ($Update->getResult()):
            $this->Error = ["O midiasocial <b>{$this->Data['midiasocial_name']}</b> foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    //Remove Mídia
    private function Delete() {
        $Delete = new Delete;
        $Delete->ExeDelete(self::Entity, "WHERE midiasocial_id = :id", "id={$this->Midiasocial}");
        if ($Delete->getResult()):
            $this->Error = ["Midiasocial removido com sucesso do sistema!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}