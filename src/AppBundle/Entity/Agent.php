<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agent
 *
 * @ORM\Table(name="agent")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgentRepository")
 * @Gedmo\Loggable
 */
class Agent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=7)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="cni", type="string", length=11, nullable=true)
     */
    private $cni;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=25)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenoms", type="string", length=75)
     */
    private $prenoms;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="datenaiss", type="string", length=10, nullable=true)
     */
    private $datenaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="lieunaiss", type="string", length=30, nullable=true)
     */
    private $lieunaiss;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=50, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=75, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=8, nullable=true)
     */
    private $contact;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"nom","prenoms","matricule"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(name="publie_par", type="string", length=25, nullable=true)
     */
    private $publiePar;

    /**
     * @var string
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(name="modifie_par", type="string", length=25, nullable=true)
     */
    private $modifiePar;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="publie_le", type="datetimetz", nullable=true)
     */
    private $publieLe;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifie_le", type="datetimetz", nullable=true)
     */
    private $modifieLe;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agent", inversedBy="agents")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agent", inversedBy="agents")
     * @ORM\JoinColumn(name="echelon_id", referencedColumnName="id")
     */
    private $echelon;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agent", inversedBy="agents")
     * @ORM\JoinColumn(name="grade_id", referencedColumnName="id")
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Agent", inversedBy="agents")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Agent
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set cni
     *
     * @param string $cni
     *
     * @return Agent
     */
    public function setCni($cni)
    {
        $this->cni = $cni;

        return $this;
    }

    /**
     * Get cni
     *
     * @return string
     */
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Agent
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenoms
     *
     * @param string $prenoms
     *
     * @return Agent
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Agent
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set datenaiss
     *
     * @param string $datenaiss
     *
     * @return Agent
     */
    public function setDatenaiss($datenaiss)
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    /**
     * Get datenaiss
     *
     * @return string
     */
    public function getDatenaiss()
    {
        return $this->datenaiss;
    }

    /**
     * Set lieunaiss
     *
     * @param string $lieunaiss
     *
     * @return Agent
     */
    public function setLieunaiss($lieunaiss)
    {
        $this->lieunaiss = $lieunaiss;

        return $this;
    }

    /**
     * Get lieunaiss
     *
     * @return string
     */
    public function getLieunaiss()
    {
        return $this->lieunaiss;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Agent
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Agent
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return Agent
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return Agent
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Agent
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set publiePar
     *
     * @param string $publiePar
     *
     * @return Agent
     */
    public function setPubliePar($publiePar)
    {
        $this->publiePar = $publiePar;

        return $this;
    }

    /**
     * Get publiePar
     *
     * @return string
     */
    public function getPubliePar()
    {
        return $this->publiePar;
    }

    /**
     * Set modifiePar
     *
     * @param string $modifiePar
     *
     * @return Agent
     */
    public function setModifiePar($modifiePar)
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    /**
     * Get modifiePar
     *
     * @return string
     */
    public function getModifiePar()
    {
        return $this->modifiePar;
    }

    /**
     * Set publieLe
     *
     * @param \DateTime $publieLe
     *
     * @return Agent
     */
    public function setPublieLe($publieLe)
    {
        $this->publieLe = $publieLe;

        return $this;
    }

    /**
     * Get publieLe
     *
     * @return \DateTime
     */
    public function getPublieLe()
    {
        return $this->publieLe;
    }

    /**
     * Set modifieLe
     *
     * @param \DateTime $modifieLe
     *
     * @return Agent
     */
    public function setModifieLe($modifieLe)
    {
        $this->modifieLe = $modifieLe;

        return $this;
    }

    /**
     * Get modifieLe
     *
     * @return \DateTime
     */
    public function getModifieLe()
    {
        return $this->modifieLe;
    }

    /**
     * Set classe
     *
     * @param \AppBundle\Entity\Agent $classe
     *
     * @return Agent
     */
    public function setClasse(\AppBundle\Entity\Agent $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \AppBundle\Entity\Agent
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set echelon
     *
     * @param \AppBundle\Entity\Agent $echelon
     *
     * @return Agent
     */
    public function setEchelon(\AppBundle\Entity\Agent $echelon = null)
    {
        $this->echelon = $echelon;

        return $this;
    }

    /**
     * Get echelon
     *
     * @return \AppBundle\Entity\Agent
     */
    public function getEchelon()
    {
        return $this->echelon;
    }

    /**
     * Set grade
     *
     * @param \AppBundle\Entity\Agent $grade
     *
     * @return Agent
     */
    public function setGrade(\AppBundle\Entity\Agent $grade = null)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return \AppBundle\Entity\Agent
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set service
     *
     * @param \AppBundle\Entity\Agent $service
     *
     * @return Agent
     */
    public function setService(\AppBundle\Entity\Agent $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\Agent
     */
    public function getService()
    {
        return $this->service;
    }
}
