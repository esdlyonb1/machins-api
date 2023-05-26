<?php

namespace App\Controller;

use App\Entity\Machin;
use App\Form\MachinType;
use App\Repository\MachinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/machin')]
class MachinController extends AbstractController
{
    #[Route('/', name: 'app_machin_index', methods: ['GET'])]
    public function index(MachinRepository $machinRepository): Response
    {
        return $this->json($machinRepository->findAll(),
        200);
    }

    #[Route('/new', name: 'app_machin_new', methods: ['POST'])]
    public function new(SerializerInterface $serializer,Request $request, MachinRepository $machinRepository): Response
    {
        $json = $request->getContent();

        $machin = $serializer->deserialize($json,Machin::class,'json');

        $machinRepository->save($machin, true);

        return $this->json($machin, 200);



    }

    #[Route('/show/{id}', name: 'app_machin_show', methods: ['GET'])]
    public function show(Machin $machin): Response
    {
        return $this->json($machin, 200);
    }

    #[Route('/{id}/edit', name: 'app_machin_edit', methods: ['PUT'])]
    public function edit(SerializerInterface$serializer,Request $request, Machin $machin, MachinRepository $machinRepository): Response
    {
            $editedMachin = $serializer->deserialize($request->getContent(), Machin::class, 'json');

           $machin->setDescription($editedMachin->getDescription());

           $machinRepository->save($machin, true);


        return $this->json($machin, 200);
    }

    #[Route('/{id}', name: 'app_machin_delete', methods: ['DELETE'])]
    public function delete(Request $request, Machin $machin, MachinRepository $machinRepository): Response
    {
        $machinRepository->remove($machin, true);

        return $this->json('thing was deleted successfully', 200);

    }
}
