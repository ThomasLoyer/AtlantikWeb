<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;

Class Visiteur extends BaseController
{
    public function afficherAccueil()
    {
        return  view("templates/header").
                view("Visiteur/vue_Accueil").
                view("templates/footer");
    }
    public function formCreerCompte()
    {
        if(!$this->request->is("post")) {
            return  view("templates/header").
                    view("visiteur/vue_CreerCompte").
                    view("templates/footer");
        }

        $reglesValidation = [
            'txtNom'        => "required|string",
            'txtPrenom'     => "required|string",
            'txtAdresse'    => "required|string",
            'txtCP'         => "required|numeric|exact_length[5]",
            'txtVille'      => "required|string",
            'txtNoTelFixe'  => "required|numeric|exact_length[10]",
            'txtNoTelPort'  => "required|numeric|exact_length[10]",
            'txtMel'        => "required|valid_email",
            'txtMdp'        => "required|string",
        ];

        if(!$this->validate($reglesValidation)) {
            $data['TitreDeLaPage'] = "Erreur, saisie incorrecte";
            $data['erreur'] = $this->validator->getErrors();
            return  view("templates/header").
                    view("visiteur/vue_Erreur", $data).
                    view("templates/footer");
        }
        
        $donneesAInserer = array(
            'nom'               => $this->request->getPost('txtNom'),
            'prenom'            => $this->request->getPost('txtPrenom'),
            'adresse'           => $this->request->getPost('txtAdresse'),
            'codepostal'       => $this->request->getPost('txtCP'),
            'ville'             => $this->request->getPost('txtVille'),
            'telephonefixe'     => $this->request->getPost('txtNoTelFixe'),
            'telephonemobile'   => $this->request->getPost('txtNoTelPort'),
            'mel'               => $this->request->getPost('txtMel'),
            'motdepasse'        => $this->request->getPost('txtMdp'),
        );

        $modeleClient = new ModeleClient();
        $donnees['UtilisateurAjoute'] = $modeleClient->insert($donneesAInserer, false);

        return  view("templates/header").
                view("Visiteur/vue_Accueil").
                view("templates/footer");
    }
    public function afficherLiaison()
    {
        $modLiaison = new ModeleLiaison();
        $data['lesLiaisons'] = $modLiaison->getLiaisonSecteur();
        $data['titrePage'] = 'Liste des Liaisons';

        return  view("templates/header").
                view("Visiteur/vue_AfficherLiaison", $data).
                view("templates/footer");
    }
    public function afficherTarif($noLiaison)
    {
        $modTarif = new ModeleLiaison;
        $data['lesTarifs'] = $modTarif->getTarif($noLiaison);
        $data['titrePage'] = 'Liste des tarifs';

        return  view('templates/header').
                view('Visiteur/vue_AfficherTarif', $data).
                view('templates/footer');
    }

    public function afficherHorraire(...$noSecteur)
    {
        $modSecteur = new ModeleSecteur;
        $data['lesSecteurs'] = $modSecteur->getNoSecteur();
        $data['titrePage'] = 'Afficher les horraires';

        if(!empty($noSecteur)){
            $modliaison = new ModeleLiaison;
            $data['lesLiaisons'] = $modliaison->getLiaison($noSecteur);
        }
        
        if(!empty($_POST['date']) && !empty($_POST['liaisons']))
        { 
            $tableauHorraires = array();
            $modliaison = new ModeleLiaison;
            $catgoriePassager = $modliaison->getLesCategories();
            $LesTraversees = $modliaison->getTraverseeBateau($_POST['liaisons'], $_POST['date']);
            foreach($LesTraversees as $traversee)
            {
                foreach($catgoriePassager as $categorie)
                {
                    $capaciteMax = $modliaison->getCapaciteMaximal($traversee->notraversee, $categorie->lettrecategorie);
                    $quantiteEnregistree = $modliaison->getQuantiteEnregistree($traversee->notraversee, $categorie->lettrecategorie);
                    $tableauHorraires[] = [
                        'noTraversee'   => $traversee->notraversee,
                        'heure'         => $traversee->dateheuredepart,
                        'bateau'        => $traversee->nom,
                        'categorie'     => $categorie->lettrecategorie.' '.$categorie->libelle,
                        'placeRestante' => $quantiteEnregistree[0]->QUANTITERESERVEE ?? 0
                    ];
                }
            }
            $data['lesHorraires'] = $tableauHorraires;
        }

        return  view('templates/header').
                view('Visiteur/vue_AfficherHorraire', $data).
                view('templates/footer');
    }
    public function authentification()
    {
        helper(['form']);
        $session = session();

        $data['titrePage'] = 'authentification';
        if(!$this->request->is('post')){
            return  view('templates/header', $data).
                    view('Visiteur/vue_Authentification').
                    view('templates/footer');
        }

        $reglesValidation = [
            'txtIdentifiant' => 'required',
            'txtMotDePasse' => 'required',
        ];

        if(!$this->validate($reglesValidation)){
            $data['titrePage'] = 'Saisie incorrecte';
            return  view('templates/header', $data).
                    view('Visiteur/vue_Authentification').
                    view('templates/footer');
        }

        $identifiant = $this->request->getPost('txtIdentifiant');
        $Mdp = $this->request->getPost('txtMotDePasse');

        $modClient = new ModeleClient();
        $condition = ['mel' => $identifiant, 'motdepasse' => $Mdp];
        $utilisateurRetourne = $modClient->where($condition)->first();

        if($utilisateurRetourne != null){
            $session->set('Identifiant', $utilisateurRetourne->MEL);
            $session->set('profil', 'client');
            $session->set('ID',$utilisateurRetourne->NOCLIENT);
            $data['Identifiant'] = $identifiant;
            return    view('templates/header', $data).
                    view('Utilisateur/vue_AuthentificationReussie').
                    view('templates/footer');
        } else {
            $data['titrePage'] = 'Identifiant et/ou mot de passe inconnu(s)';
            return  view('templates/header', $data).
                    view('Visiteur/vue_Authentification').
                    view('templates/footer');
        }
    }
}