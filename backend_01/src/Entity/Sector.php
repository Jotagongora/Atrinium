<?php

namespace App\Entity;

use App\Repository\SectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectorRepository::class)
 */
class Sector
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity=Empresa::class, mappedBy="Sector")
     */
    private $empresas;

    public function __construct()
    {
        $this->empresas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection|Empresa[]
     */
    public function getEmpresas(): Collection
    {
        return $this->empresas;
    }

    public function addEmpresa(Empresa $empresa): self
    {
        if (!$this->empresas->contains($empresa)) {
            $this->empresas[] = $empresa;
            $empresa->setSector($this);
        }

        return $this;
    }

    public function removeEmpresa(Empresa $empresa): self
    {
        if ($this->empresas->removeElement($empresa)) {
            // set the owning side to null (unless already changed)
            if ($empresa->getSector() === $this) {
                $empresa->setSector(null);
            }
        }

        return $this;
    }
}
