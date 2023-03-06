<?php

namespace App\Controller;

use App\Entity\Kategori;
use App\Entity\Urun;
use App\Repository\KategoriRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctrineController extends AbstractController
{
    /**
     * @Route("/many-to-one-veri-kaydetme")
     */
    public function manyToOneVeriKaydetme()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $kategori = new Kategori();
        $kategori->setIsim('Spor Giyim Yeni Kategori');

        $urun = new Urun();
        $urun->setIsim('Koşu Ayakkabısı');
        $urun->setFiyat(100);
        $urun->setKategori($kategori);//relati

        $urun1 = new Urun();
        $urun1->setIsim('Esofman');
        $urun1->setFiyat(50);
        $urun1->setKategori($kategori);

        $urun2 = new Urun();
        $urun2->setIsim('Spor Atlet');
        $urun2->setFiyat(40);
        $urun2->setKategori($kategori);

        $entityManager->persist($kategori);
        $entityManager->persist($urun);
        $entityManager->persist($urun1);
        $entityManager->persist($urun2);

        $entityManager->flush();

        return new Response(sprintf('Urun Kaydedildi ürün id: %s -> Kategori Id: %s', $urun->getId(), $kategori->getId()));
    }
    /**
     * @Route("/many-to-one-veri-inceleme/{id}")
     */
    public function manyToOneVeriInceleme(Urun $urun)
    {
        $kategori = $urun->getKategori();

        return new Response(sprintf('Urun id: %s -> kategori isim: %s', $urun->getId(), $kategori->getIsim()));
    }
     /**
     * @Route("/one-to-many-veri-inceleme/{id}")
     */
    public function oneToManyVeriInceleme($id,KategoriRepository $kategoriRepository)
    {
        $kategori = $kategoriRepository->find(2);
       
    }

    /**
     * @Route("/bind-sql", name="app_bind-sql")
     */
    public function bindsql(): Response
    {
        $conn = $this->getDoctrine()
            ->getConnection();
        

        $sql = 'SELECT * FROM urun where performans > :degisken';

        $statement = $conn->prepare($sql);

        $result =  $statement->execute(array('degisken' => 5));
        dd($result->fetchAll());
        exit();
    }
    /**
     * @Route("/saf-sql", name="app_saf-sql")
     */
    public function index(): Response
    {

        
        $conn = $this->getDoctrine()
            ->getConnection();
        

        $sql = 'SELECT isim FROM urun LIMIT 5';

        $statement = $conn->prepare($sql);

        $result = $statement->execute();

        

        dd($result->fetchAll());
        exit();
       

        // actually executes the queries (i.e. the INSERT query)
        
        return $this->render('doctrine/index.html.twig', [
            'controller_name' => 'DoctrineController',
        ]);
    }
}
