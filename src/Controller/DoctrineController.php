<?php

namespace App\Controller;

use App\Entity\Grup;
use App\Entity\Kategori;
use App\Entity\Urun;
use App\Entity\User;
use App\Repository\KategoriRepository;
use App\Repository\UrunRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DoctrineController extends AbstractController
{

    /**
     * @Route("/reqtest")
     */
    public function reqtest(Request $request):string
    {
        $data=$request->request->all();
        
        return new Response($data['name']) ;
        
        return new jsonResponse($data);
    }

     /**
     * @Route("/kullanicigrup")
     */
    public function kullanicigrup(UserRepository $userRepository, SerializerInterface $serializer)
    {

        $user=$userRepository->find(1);
        $userlar=$user->getGroups();
        $jsonContent = $serializer->serialize($userlar, 'json');

        echo $jsonContent;
        die;

        return $this->json($json);
        foreach ($userlar as $u){
            echo $u->getIsim().'<hr>';
        }
        return new Response('');
    }

    /**
     * @Route("/many-to-many-veri-kaydetme")
     */
    public function manyToManyVeriKaydetme()
    {
        $em = $this->getDoctrine()->getManager();

        $user1 = new User();
        $user1->setIsim('Behram');
        $user1->setUsername('behramcelen');

        $user2 = new User();
        $user2->setIsim('Selim');
        $user2->setUsername('slmyldz');

        $user3 = new User();
        $user3->setIsim('Harun');
        $user3->setUsername('harunglc');

        $grup1 = new Grup();
        $grup1->setIsim('Admin');

        $grup2 = new Grup();
        $grup2->setIsim('Editor');

        $grup1->addUser($user1);
        $grup1->addUser($user2);

        $grup2->addUser($user2);
        $grup2->addUser($user3);

        $em->persist($user1);
        $em->persist($user2);
        $em->persist($user3);
        $em->persist($grup1);
        $em->persist($grup2);

        $em->flush();


        return new Response('');
    }
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
    public function oneToManyVeriInceleme(Kategori $kategori)
    {
        $urunler = $kategori->getUrunler();
        
       
        foreach ($urunler as $urun){
            echo $urun->getIsim().'<hr>';
        }
        return new Response('');
    }  
    /**
     * @Route("/relation-query-builder-inceleme/{id}")
     */
    public function relationQueryBuilder(UrunRepository $urunRepository,  Kategori $kategori)
    {
        

        $urunler = $urunRepository->findByCategory($kategori);

        foreach ($urunler as $urun){
            echo $urun->getIsim().'<hr>';
        }
        return new Response('');
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
        

        $sql = 'SELECT * FROM user u inner join user_grup ug on u.id=ug.user_id inner join grup g on ug.grup_id=g.id where u.username="slmyldz"   LIMIT 5';

        $statement = $conn->prepare($sql);

        $result = $statement->execute();

        $data=$result->fetchAll();
        
        return $this->json($data);
        
        dd($result->fetchAll());
        exit();
       

        // actually executes the queries (i.e. the INSERT query)
        
        return $this->render('doctrine/index.html.twig', [
            'controller_name' => 'DoctrineController',
        ]);
    }
    /**
     * @Route("/repo-sql", name="app_repo-sql")
     */
    public function reposql(UserRepository $userRepository): Response
    {

        $data=$userRepository->reposql();

        return $this->json($data);
        
    }
}
