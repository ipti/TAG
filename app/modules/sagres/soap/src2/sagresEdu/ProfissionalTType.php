<?php

namespace SagresEdu;

/**
 * Class representing ProfissionalTType
 *
 * 
 * XSD Type: profissional_t
 */
class ProfissionalTType
{
    /**
     * @var string $cpfProfissional
     */
    private $cpfProfissional = null;

    /**
     * @var string $especialidade
     */
    private $especialidade = null;

    /**
     * @var int $idEscola
     */
    private $idEscola = null;

    /**
     * @var bool $fundeb
     */
    private $fundeb = null;

    /**
     * @var \SagresEdu\AtendimentoTType[] $atendimento
     */
    private $atendimento = [
        
    ];

    /**
     * Gets as cpfProfissional
     *
     * @return string
     */
    public function getCpfProfissional()
    {
        return $this->cpfProfissional;
    }

    /**
     * Sets a new cpfProfissional
     *
     * @param string $cpfProfissional
     * @return self
     */
    public function setCpfProfissional($cpfProfissional)
    {
        $this->cpfProfissional = $cpfProfissional;
        return $this;
    }

    /**
     * Gets as especialidade
     *
     * @return string
     */
    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    /**
     * Sets a new especialidade
     *
     * @param string $especialidade
     * @return self
     */
    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;
        return $this;
    }

    /**
     * Gets as idEscola
     *
     * @return int
     */
    public function getIdEscola()
    {
        return $this->idEscola;
    }

    /**
     * Sets a new idEscola
     *
     * @param int $idEscola
     * @return self
     */
    public function setIdEscola($idEscola)
    {
        $this->idEscola = $idEscola;
        return $this;
    }

    /**
     * Gets as fundeb
     *
     * @return bool
     */
    public function getFundeb()
    {
        return $this->fundeb;
    }

    /**
     * Sets a new fundeb
     *
     * @param bool $fundeb
     * @return self
     */
    public function setFundeb($fundeb)
    {
        $this->fundeb = $fundeb;
        return $this;
    }

    /**
     * Adds as atendimento
     *
     * @return self
     * @param \SagresEdu\AtendimentoTType $atendimento
     */
    public function addToAtendimento(\SagresEdu\AtendimentoTType $atendimento)
    {
        $this->atendimento[] = $atendimento;
        return $this;
    }

    /**
     * isset atendimento
     *
     * @param int|string $index
     * @return bool
     */
    public function issetAtendimento($index)
    {
        return isset($this->atendimento[$index]);
    }

    /**
     * unset atendimento
     *
     * @param int|string $index
     * @return void
     */
    public function unsetAtendimento($index)
    {
        unset($this->atendimento[$index]);
    }

    /**
     * Gets as atendimento
     *
     * @return \SagresEdu\AtendimentoTType[]
     */
    public function getAtendimento()
    {
        return $this->atendimento;
    }

    /**
     * Sets a new atendimento
     *
     * @param \SagresEdu\AtendimentoTType[] $atendimento
     * @return self
     */
    public function setAtendimento(array $atendimento = null)
    {
        $this->atendimento = $atendimento;
        return $this;
    }
}

