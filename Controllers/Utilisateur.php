<?php
namespace App\Controllers;
use App\Models\ModeleClient;
use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;
use App\Models\ModeleTraversee;

Class Utilisateur extends BaseController
{
    public function deconnexion()
    {
        session()->destroy();
        return redirect()->route('accueil');
    }
    public function reserver($noTraversee)
    {
        $modClient = new ModeleClient();
        $modTraversee = new ModeleTraversee();
        $data['infoClient'] = $modClient->getNomAdresse(session()->get('Identifiant'));
        $data['lesTarifs'] = $modTraversee->getTypeTarrif($noTraversee);
        $data['noTraversee'] = $noTraversee;

        return  view('templates/header').
                view('utilisateur/vue_Reserver', $data).
                view('templates/footer');
    }
    public function traiterReservation()
    {
        if(!$this->request->is("post")){
            return  view("templates/header").
                    view("visiteur/vue_Accueil").
                    view("templates/footer");
        }
        
        //  /!\ A FINIRf

    }
    public function formModifierCompte()
    {
        $session = session();

        $modclient = new ModeleClient();
        $infoClient = $modclient->getToutLesInformation($session->get('ID'));
        $data['prechargement'] = $infoClient[0];

        if(!$this->request->is("post")) {
            return  view("templates/header").
                    view("Utilisateur/vue_ModifierCompte", $data).
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
            'codepostal'        => $this->request->getPost('txtCP'),
            'ville'             => $this->request->getPost('txtVille'),
            'telephonefixe'     => $this->request->getPost('txtNoTelFixe'),
            'telephonemobile'   => $this->request->getPost('txtNoTelPort'),
            'mel'               => $this->request->getPost('txtMel'),
            'motdepasse'        => $this->request->getPost('txtMdp'),
        );

        $id_client = $session->get('ID');
        $modeleClient = new ModeleClient();
        $modeleClient->update($id_client, $donneesAInserer, false);

        return  view("templates/header").
                view("Visiteur/vue_Accueil").
                view("templates/footer");
    }
}