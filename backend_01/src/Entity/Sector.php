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

    /**
     * @ORM\ManyToMany(targetEntity=AdminUser::class, mappedBy="Sector")
     */
    private $adminUsers;

    public function __construct()
    {
        $this->empresas = new ArrayCollection();
        $this->adminUsers = new ArrayCollection();
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

    /**
     * @return Collection|AdminUser[]
     */
    public function getAdminUsers(): Collection
    {
        return $this->adminUsers;
    }

    public function addAdminUser(AdminUser $adminUser): self
    {
        if (!$this->adminUsers->contains($adminUser)) {
            $this->adminUsers[] = $adminUser;
            $adminUser->addSector($this);
        }

        return $this;
    }

    public function removeAdminUser(AdminUser $adminUser): self
    {
        if ($this->adminUsers->removeElement($adminUser)) {
            $adminUser->removeSector($this);
        }

        return $this;
    }
}
