<?php

namespace App\Controller;
use App\Entity\Club;
use App\Entity\User;
use App\Entity\Tours;
use App\Entity\Equipe;
use App\Entity\Groupe;
use App\Entity\Joueur;
use App\Form\ClubType;
use App\Entity\Tournoi;
use App\Form\ToursType;
use App\Form\EquipeType;
use App\Form\GroupeType;
use App\Form\JoueurType;
use App\Entity\Evenement;
use App\Form\TournoiType;
use App\Entity\MatchJouer;
use App\Form\EditClubType;
use App\Form\EditUserType;
use App\Form\EditMatchType;
use App\Form\EditToursType;
use App\Form\EvenementType;
use App\Form\EditEquipeType;
use App\Form\EditGroupeType;
use App\Form\EditJoueurType;
use App\Form\MatchJouerType;
use App\Form\EditTournoiType;
use App\Form\AjoutTournoiType;
use App\Form\EditEvenementType;
use App\Repository\UserRepository;
use App\Repository\ToursRepository;
use App\Repository\MatchJouerRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class Controller extends AbstractController
{
    /**
     * @Route("/index", name="")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Controller.php',
        ]);
    }

    /**
     * @Route("/", name="bienvenue")
     */
    public function bienvenue(){
        return $this ->render('bienvenue.html.twig', [
            'title' => "Bienvenue dans notre site !"
            
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/tournoi/newEvt/{nom<[0-9a-zA-Z ]+>}", name="newevt")
     */
    public function newevt($nom): Response {
            $ev=new Evenement(); // constructeur par défaut tjrs
            $ev->setNom($nom);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ev); // en tampon
            $entityManager->flush(); // en BD
        return new Response("Événement '$nom' créé avec l'id :".$ev->getId().' !');
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/tournoi/newTnoi/{evtid<[0-9]+>}/{nom<[0-9a-zA-Z]+>}/{desc?}", name="newTnoi")
     */
    public function newTnoi($evtid, $nom, $desc): Response {
        $tnoi=new Tournoi(); // constructeur par défaut tjrs
        $tnoi->setNom($nom);
        $tnoi->setDescription($desc);
        $em = $this->getDoctrine()->getManager();
        $evt = $em->find("App\Entity\Evenement",(int)$evtid);
        // remarque: on peut utiliser 'App:' qui est un alias de 'App\Entity\'
        if($evt === null){
            return new Response("L'événement $evtid n'existe pas ! Le tournoi n'a pas été créé !");
        } else {
            $tnoi->setEv($evt);
            $em->persist($tnoi); // en tampon
            $em->flush();
            return new Response("Le tournoi {$tnoi->getNom()} a été enregistré dans l'événement {$evt->getNom()} !");
        }
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function usersList(UserRepository $users) {
        return $this->render('users.html.twig', [
            'users' => $users->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un utilisateur
     * @Route("/utilisateur/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(User $user, Request $request){
        
    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('utilisateurs');
    }
    
    return $this->render('Edit/edituser.html.twig', [
        'userForm' => $form->createView(),
    ]);
}

/**
     * @IsGranted("ROLE_EDITOR")
     * modifier un evenement
     * @Route("/evenement/modifier/{id}", name="modifier_evenement")
     */
    public function editEvenement(Evenement $event, Request $request){
        
        $form = $this->createForm(EditEvenementType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'Evenement modifié avec succès');
            return $this->redirectToRoute('Evenements');
        }
        
        return $this->render('Edit/editEvenement.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un tournoi
     * @Route("/tournoi/modifier/{id}", name="modifier_tournoi")
     */
    public function editTournoi(Tournoi $event, Request $request){
        
        $form = $this->createForm(EditTournoiType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'tournoi modifié avec succès');
            return $this->redirectToRoute('tournois');
        }
        
        return $this->render('Edit/editTournoi.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

     /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un club
     * @Route("/club/modifier/{id}", name="modifier_club")
     */
    public function editClub(Club $event, Request $request){
        
        $form = $this->createForm(EditClubType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'club modifié avec succès');
            return $this->redirectToRoute('clubs');
        }
        
        return $this->render('Edit/editClub.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un groupe
     * @Route("/groupe/modifier/{id}", name="modifier_groupe")
     */
    public function editGroupe(Groupe $event, Request $request){
        
        $form = $this->createForm(EditGroupeType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'club modifié avec succès');
            return $this->redirectToRoute('groupes');
        }
        
        return $this->render('Edit/EditGroupe.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un equipe
     * @Route("/equipe/modifier/{id}", name="modifier_equipe")
     */
    public function editEquipe(Equipe $event, Request $request){
        
        $form = $this->createForm(EditEquipeType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'club modifié avec succès');
            return $this->redirectToRoute('equipes');
        }
        
        return $this->render('Edit/EditEquipe.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un Joueur
     * @Route("/joueur/modifier/{id}", name="modifier_joueur")
     */
    public function editJoueur(Joueur $event, Request $request){
        
        $form = $this->createForm(EditJoueurType::class, $event);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
    
            $this->addFlash('message', 'club modifié avec succès');
            return $this->redirectToRoute('joueurs');
        }
        
        return $this->render('Edit/EditJoueur.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un Joueur
     * @Route("/match/modifier/{id}", name="modifier_match")
     */
    public function editMatch(MatchJouer $match, Request $request){
        
        $form = $this->createForm(EditMatchType::class, $match);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
    
            $this->addFlash('message', 'le Match est modifié avec succès');
            return $this->redirectToRoute('matchsJouer');
        }
        
        return $this->render('Edit/EditMatch.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * modifier un tour
     * @Route("/tour/modifier/{id}", name="modifier_tour")
     */
    public function editTour(Tours $tour, Request $request){
        
        $form = $this->createForm(EditToursType::class, $tour);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tour);
            $entityManager->flush();
    
            $this->addFlash('message', 'le tour est modifié avec succès');
            return $this->redirectToRoute('tours');
        }
        
        return $this->render('Edit/EditTours.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }


//=======================================================================================================================

    /**
     * @Route("/tournoi/Evenements",name="Evenements")
     * liste des évts et des tournois
     */
    public function Evenements(): Response {
        $evts = $this->getDoctrine()->getManager()->getRepository("App\Entity\Evenement")->findAll();
        return $this->render('tournoi.html.twig', [
            'evts' => $evts,
        ]);
    }

    /**
     * @Route("/tournoi/tournois",name="tournois")
     * liste des évts et des tournois
     */
    public function tournois(): Response {
        $trns = $this->getDoctrine()->getManager()->getRepository("App\Entity\Tournoi")->findAll();
        return $this->render('tournoisAffichage.html.twig', [
            'trns' => $trns,
        ]);
    }

    /**
     * @Route("/tournoi/clubs",name="clubs")
     * liste des clubs 
     */
    public function clubs(): Response {
        $cls = $this->getDoctrine()->getManager()->getRepository("App\Entity\Club")->findAll();
        return $this->render('saisieClub.html.twig', [
            'cls' => $cls,
        ]);
    }

    /**
     * @Route("/tournoi/equipes",name="equipes")
     * liste des equipes 
     */
    public function equipes(): Response {
        $eqpes = $this->getDoctrine()->getManager()->getRepository("App\Entity\Equipe")->findAll();
        return $this->render('equipeAffichage.html.twig', [
            'eqpes' => $eqpes,
        ]);
    }

    /**
     * @Route("/tournoi/groupes",name="groupes")
     * liste des groupes 
     */
    public function groupes(): Response {
        $cls = $this->getDoctrine()->getManager()->getRepository("App\Entity\Groupe")->findAll();
        return $this->render('GroupeAffichage.html.twig', [
            'cls' => $cls,
        ]);
    }

    /**
     * @Route("/tournoi/joueurs",name="joueurs")
     * liste des clubs 
     */
    public function joueurs(): Response {
        $Jrs = $this->getDoctrine()->getManager()->getRepository("App\Entity\Equipe")->findAll();
        return $this->render('joueurAffichage.html.twig', [
            'Jrs' => $Jrs,
        ]);
    }

    /**
     * @Route("/matchsJouer", name="matchsJouer")
     */
    public function matchsList(MatchJouerRepository $matchs) {
        return $this->render('MatchJouerAffichage.html.twig', [
            'matchs' => $matchs->findAll(),
        ]);
    }

    /**
     * @Route("/tours", name="tours")
     */
    public function tours(ToursRepository $tours) {
        return $this->render('TourAffichage.html.twig', [
            'tours' => $tours->findAll(),
        ]);
    }

//=========================================================================================================================

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutEvenement", name="ajoutEvenement")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutEvenement(Evenement $event = null, Request $request): Response {
        if(!$event){
            $event=new Evenement();
        }
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            // the original `$tnoi` variable has also been updated
            // $tnoi = $form->getData(); // inutile
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            return $this->redirectToRoute('Evenements');
        }
        return $this->render('evenement.html.twig', [
            'form' => $form->createView(),
            //'editMode' => $tnoi->getId() != null
        ]);
    }

    /**
     *@IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/saisieTnoi/{evtid<[0-9]+>}", name="saisieTnoi")
     */
    public function saisieTnoi($evtid): Response {
        $tnoi=new Tournoi();
        $tnoi->setNom("");
        $tnoi->setDescription(""); // saisie donc vide
        $form = $this->createFormBuilder($tnoi)
        ->add('nom', TextType::class)
        ->add('description', TextType::class)
        ->add('sauver', SubmitType::class, ['label' => 'Créer le tournoi !'])
        ->getForm(); // le formulaire est créé
        return $this->render('saisieTnoi.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     *@IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/saisirTnoi", name="saisTnoi")
     * AVEC type de formulaire
     */
    // sans make:form (creation manuelle)
    public function saisirTnoi(Request $request): Response {
        $tnoi=new Tournoi();
        $form = $this->createForm(TournoiType::class, $tnoi);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tnoi);
            $entityManager->flush();
            return $this->redirectToRoute('Evenements');
        }

        return $this->render('saisieTnoi.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajTnoi", name="saisirTnoi")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajTnoi(Tournoi $tnoi = null, Request $request): Response {
        if(!$tnoi){
            $tnoi=new Tournoi();
        }
        $form = $this->createForm(AjoutTournoiType::class, $tnoi);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            // the original `$tnoi` variable has also been updated
            // $tnoi = $form->getData(); // inutile
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tnoi);
            $entityManager->flush();
            return $this->redirectToRoute('Evenements');
        }
        return $this->render('saisieTnoi.html.twig', [
            'form' => $form->createView(),
            //'editMode' => $tnoi->getId() != null
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutClub", name="ajoutClub")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutClub(Club $club = null, Request $request): Response {
        if(!$club){
            $club=new Club();
        }
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            // the original `$tnoi` variable has also been updated
            // $tnoi = $form->getData(); // inutile
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($club);
            $entityManager->flush();
            return $this->redirectToRoute('clubs');
        }
        return $this->render('club.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutEquipe", name="ajoutEquipe")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutEquipe(Equipe $equipe = null, Request $request): Response {
        if(!$equipe){
            $equipe=new Equipe();
        }
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipe);
            $entityManager->flush();
            //return $this->redirectToRoute('clubs');
            return $this->redirectToRoute('groupes');
        }
        return $this->render('equipe.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutJoueur", name="ajoutJoueur")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutJoueur(Joueur $joueur = null, Request $request): Response {
        if(!$joueur){
            $joueur=new Joueur();
        }
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($joueur);
            $entityManager->flush();
            return $this->redirectToRoute('equipes');
        }
        return $this->render('joueur.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutGroupes", name="ajoutGroupes")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutGroupes(Groupe $groupe = null, Request $request): Response {
        if(!$groupe){
            $groupe=new Groupe();
        }
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->flush();
            return $this->redirectToRoute('tournois');
        }
        return $this->render('groupe.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutMatchs", name="ajoutMatchs")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutMatchs(MatchJouer $match = null, Request $request): Response {
        if(!$match){
            $match=new MatchJouer();
        }
        $form = $this->createForm(MatchJouerType::class, $match);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
            return $this->redirectToRoute('matchsJouer');
        }
        return $this->render('saisirMatchJouer.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/tournoi/ajoutTours", name="ajoutTours")
     * AVEC type de formulaire
     */
    // avec make:form (creation automatique)
    public function ajoutTours(Tours $tour = null, Request $request): Response {
        if(!$tour){
            $tour=new Tours();
        }
        $form = $this->createForm(ToursType::class, $tour);
        $form->handleRequest($request); // avant ou après saisie
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tour);
            $entityManager->flush();
            return $this->redirectToRoute('tours');
        }
        return $this->render('saisirTours.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

}