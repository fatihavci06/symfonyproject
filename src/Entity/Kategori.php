<?php

namespace App\Entity;

use App\Repository\KategoriRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KategoriRepository::class)
 */
class Kategori
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    
    private $isim;

    /**
     * @ORM\OneToMany(targetEntity=Urun::class, mappedBy="kategori", orphanRemoval=true)
     */
    public $urunler;

    public function __construct()
    {
        $this->urunler = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    public function setIsim(?string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    /**
     * @return Collection<int, Urun>
     */
    public function getUrunler(): Collection
    {
        return $this->urunler;
    }

    public function addUrunler(Urun $urun): self
    {
        if (!$this->urunler->contains($urun)) {
            $this->urunler[] = $urun;
            $urun->setKategori($this);
        }

        return $this;
    }

    public function removeUrunler(Urun $urun): self
    {
        if ($this->urunler->removeElement($urun)) {
            // set the owning side to null (unless already changed)
            if ($urun->getKategori() === $this) {
                $urun->setKategori(null);
            }
        }

        return $this;
    }
}
