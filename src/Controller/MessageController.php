<?php

namespace App\Controller;

use App\DTO\MessageDTO;
use App\Entity\Message;
use App\Form\ContactType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/messages', name: 'message.')]
class MessageController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;

    }
    
    #[Route('/', name: 'index', methods: ["GET"])]
    public function index(MessageRepository $messageRepository): Response
    {
        $messageDTOs = [];
        $messages = $messageRepository->findAll();

        foreach($messages as $entity){

            $messageDTO = new MessageDTO();
            $messageDTO->setId($entity->getId()); 
            $messageDTO->setName($entity->getName());
            $messageDTO->setEmail($entity->getEmail());
            $messageDTO->setMessage($entity->getMessage());

            $messageDTOs[] = $messageDTO;
        }

        return $this->render('message/index.html.twig', [
            'messages' => $messageDTOs,
        ]);
    }

    #[Route('/show/{id}', name: 'show', methods: ["GET"])]
    public function showMessage(Message $message): Response
    {

        $messageDTO = new MessageDTO();
        $messageDTO->setId(null); 
        $messageDTO->setName($message->getName());
        $messageDTO->setEmail($message->getEmail());
        $messageDTO->setMessage($message->getMessage());

        return $this->render('message/show.html.twig', [
            'message' => $messageDTO,
        ]);
    }

    #[Route("/delete/{id}", name: 'delete', methods: ["GET", "DELETE"])]
    public function remove(Message $message): Response
    {

        $this->em->remove($message);
        $this->em->flush();

        $this->addFlash(type: 'success', message: 'Üzenet törölve');

        return $this->redirect($this->generateUrl(route: 'message.index'));

    }

    #[Route('/contact', name: 'contact', methods: ["GET", "POST"])]
    public function contact(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(ContactType::class);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // request (DTO) -> Message entity 
            $message->setName($form->getData()->getName());
            $message->setEmail($form->getData()->getEmail());
            $message->setMessage($form->getData()->getMessage());

            $this->em->persist($message);
            $this->em->flush();

            $this->addFlash('success', 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.');
            return $this->redirect($this->generateUrl(route: 'home'));
        }

        return $this->render('message/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
