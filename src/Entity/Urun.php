<?php

namespace App\Entity;

use App\Repository\UrunRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UrunRepository::class)
 */
class Urun
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
    private $isim;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aciklama;

    /**
     * @ORM\Column(type="integer")
     */
    private $fiyat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tag;
    /**
     * @ORM\Column(type="integer", length=30, nullable=true)
     */
    private $performans;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ozelFiyat;

    /**
     * @ORM\ManyToOne(targetEntity=Kategori::class, inversedBy="urunler")
     * @ORM\JoinColumn(nullable=false)
     */
    private $kategori;

    /**
     * @ORM\Column(type="boolean")
     */
    private $durum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $renk;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    public function setIsim(string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    public function getAciklama(): ?string
    {
        return $this->aciklama;
    }

    public function setAciklama(?string $aciklama): self
    {
        $this->aciklama = $aciklama;

        return $this;
    }

    public function getFiyat(): ?int
    {
        return $this->fiyat;
    }

    public function setFiyat(int $fiyat): self
    {
        $this->fiyat = $fiyat;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }
    public function getPerformans(): ?int
    {
        return $this->performans;
    }

    public function setPerformans(?int $performans): self
    {
        $this->performans = $performans;

        return $this;
    }

    public function getOzelFiyat(): ?bool
    {
        return $this->ozelFiyat;
    }

    public function setOzelFiyat(?bool $ozelFiyat): self
    {
        $this->ozelFiyat = $ozelFiyat;

        return $this;
    }

    public function getKategori(): ?Kategori
    {
        return $this->kategori;
    }

    public function setKategori(?Kategori $kategori): self
    {
        $this->kategori = $kategori;

        return $this;
    }

    public function getDurum(): ?bool
    {
        return $this->durum;
    }

    public function setDurum(bool $durum): self
    {
        $this->durum = $durum;

        return $this;
    }

    public function getRenk(): ?string
    {
        return $this->renk;
    }

    public function setRenk(string $renk): self
    {
        $this->renk = $renk;

        return $this;
    }
}
