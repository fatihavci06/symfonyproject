<?php

namespace App\Controller;

use App\Entity\Urun;
use App\Repository\UrunRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UrunController extends AbstractController
{
    /**
     * @Route("/urun", name="app_urun")
     */
    public function index(UrunRepository $urunRepository): Response
    {
      ///listeleme
       $data=$urunRepository->findAll();
       
        
        return $this->render('urun/index.html.twig', [
            'controller_name' => 'UrunController',
            'sehirler'=>['Ankara','İstanbul'],
            'data'=>$data
        ]);
    }
    /**
     * @Route("/urun/create", name="urun_create")
     */
    public function create(UrunRepository $urunRepository): Response
    {
        $urun=new Urun;
        $urun
            ->setIsim('Behram Gömlek2')
            ->setAciklama('Yırtılmaz Mükemmel Gömlek')
            ->setFiyat(100)
            ;
            $urunRepository->add($urun);
          

       

        

        return new Response(sprintf('Urun başarı ile Oluşturuldu Id: %s', $urun->getId()));


        
        
    }

    /**
     * @Route("/urun/show/{id}", name="urun_show")
     */
    public function show(UrunRepository $urunRepository,$id): Response
    {
      
       $data=$urunRepository->find($id);
         dd($data);
        dd($data->getIsim());
        die;
        
        return $this->render('urun/index.html.twig', [
            'controller_name' => 'UrunController',
            'sehirler'=>['Ankara','İstanbul'],
            'data'=>$data
        ]);
    }
    /**
     * @Route("/urun/update/{id}", name="urun_show")
     */
    public function update(UrunRepository $urunRepository,$id,Request $request): Response
    {
      
       $data=$urunRepository->find($id);
        $data
            ->setIsim($request->get('isim'))
            ->setAciklama($request->get('aciklama'))
            ->setFiyat($request->get('fiyat'));
            
        $urunRepository->add($data);
        
        return new Response($data->getIsim());
        return $this->render('urun/index.html.twig', [
            'controller_name' => 'UrunController',
            'sehirler'=>['Ankara','İstanbul'],
            'data'=>$data
        ]);
    }
    /**
     * @Route("/urun/delete/{id}", name="urun_show")
     */
    public function delete(UrunRepository $urunRepository,$id,Request $request): Response
    {
        $data=$urunRepository->find($id);
        if($data){
            $urunRepository->remove($data);
        }
        else{
            return new Response('Urun yok');
        }
       

       return new Response('Urun silindi');

    }

    /**
     * @Route("/urun/show2/{id}", name="urun_show2" )
     */
    public function show2(UrunRepository $urunRepository,Urun $urun): Response
    {
      
        if (!$urun) {
            throw new NotFoundHttpException('Sorry not existing!');
        }
        die;
        dd($urun->getIsim());
        die;
        
        return $this->render('urun/index.html.twig', [
            'controller_name' => 'UrunController',
            'sehirler'=>['Ankara','İstanbul'],
            'data'=>$data
        ]);
    }
}
