<?php

namespace App\Controller;

use App\Entity\MusicGroup;
use App\Repository\MusicGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;


class MusicGroupController extends AbstractController
{
//     #[Route('/music/group', name: 'app_music_group')]
//     public function index(): JsonResponse
//     {
//         return $this->json([
//             'message' => 'Welcome to your new controller!',
//             'path' => 'src/Controller/MusicGroupController.php',
//         ]);
//     }

    // *******
    // getList
    // *******
    #[Route('/api/music/groups', name: 'app_music_groups', methods: ['GET'])]
    public function getMusicGroupList(MusicGroupRepository $musicGroupRepository, SerializerInterface $serializer): JsonResponse
    {
        $musicGroupList = $musicGroupRepository->findAll();
        $jsonMusicGroupList = $serializer->serialize($musicGroupList, 'json');
        return new JsonResponse($jsonMusicGroupList, Response::HTTP_OK, [], true);
    }
    
    // ******
    // getElm
    // ******
    // TODO : Tentative pour récupérer à partir du nom du groupe   
    // ---------------------------------------------------------
    //     #[Route('/api/music/group/{groupName}', name: 'detail_music_group', methods: ['GET'])]
    //     public function getDetailMusicGroup(string $groupName, SerializerInterface $serializer, MusicGroupRepository $musicGroupRepository): JsonResponse {
    // 
    //         $musicGroup = $musicGroupRepository->find($groupName);
    //         if ($musicGroup) {
    //             $jsonMusicGroup = $serializer->serialize($musicGroup, 'json');
    //             return new JsonResponse($jsonMusicGroup, Response::HTTP_OK, [], true);
    //         }
    //         return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    //    }
    // Version sans ParamConverter
    // ---------------------------
    #[Route('/api/music/groups/{id}', name: 'detailMusicGroup', methods: ['GET'])]
    public function getDetailMusicGroup(int $id, SerializerInterface $serializer, MusicGroupRepository $musicGroupRepository): JsonResponse {

        $musicGroup = $musicGroupRepository->find($id);
        if ($musicGroup) {
            $jsonMusicGroup = $serializer->serialize($musicGroup, 'json');
            return new JsonResponse($jsonMusicGroup, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
    // Tentative version avec ParamConverter
    // TODO : Package sensio/framework-extra-bundle is abandoned, you should avoid using it. Use Symfony instead.
    // ----------------------------------------------------------------------------------------------------------
    //     #[Route('/api/music/groups/{id}', name: 'detail_music_group', methods: ['GET'])]
    //     public function getDetailMusicGroup(MusicGroup $musicGroup, SerializerInterface $serializer): JsonResponse {
    // 
    //         $jsonMusicGroup = $serializer->serialize($musicGroup, 'json');
    //         return new JsonResponse($jsonMusicGroup, Response::HTTP_OK, ['accept' => 'json'], true);
    //    }
    
    
    // *********
    // deleteElm
    // *********
    #[Route('/api/music/groups/{id}', name: 'deleteMusicGroup', methods: ['DELETE'])]
    public function deleteMusicGroup(MusicGroup $musicGroup, EntityManagerInterface $em): JsonResponse 
    {
        $em->remove($musicGroup);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
    
    
    // *********
    // createElm
    // *********
    // Tentative de renvoie de l'URL correspondant à l'élément créé
    // TODO : fix empty response
    // ----------------------------------------------------------------------------------------------------------
    #[Route('/api/music/groups', name:"createMusicGroup", methods: ['POST'])]
    public function createMusicGroup(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator): JsonResponse 
    {

        $musicGroup = $serializer->deserialize($request->getContent(), MusicGroup::class, 'json');
        $em->persist($musicGroup);
        $em->flush();

        $jsonMusicGroup = $serializer->serialize($musicGroup, 'json', ['groups' => 'getMusicGroups']);
        
        $location = $urlGenerator->generate('detailMusicGroup', ['id' => $musicGroup->getId()], UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonMusicGroup, Response::HTTP_CREATED, ["Location" => $location], true);
    }
    
    
    
    // *********
    // updateElm
    // *********
    #[Route('/api/music/groups/{id}', name:"updateMusicGroup", methods:['PUT'])]
    public function updateMusicGroup(Request $request, SerializerInterface $serializer, MusicGroup $currentMusicGroup, EntityManagerInterface $em): JsonResponse 
    {
        $updatedMusicGroup = $serializer->deserialize($request->getContent(), 
                MusicGroup::class, 
                'json', 
                [AbstractNormalizer::OBJECT_TO_POPULATE => $currentMusicGroup]);
        $content = $request->toArray();
        $idAuthor = $content['idAuthor'] ?? -1;
        
        $em->persist($updatedMusicGroup);
        $em->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
   }
    
}
