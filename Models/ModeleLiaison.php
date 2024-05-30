<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleLiaison extends Model
{
    protected $table = "liaison";
    protected $primaryKey ="NOLIAISON";
    protected $useAutoIncrement = true;
    protected $returnType = "object";
    protected $allowedFields = ['NOLIAISON', 'NOPORT_DEPART', 'NOSECTEUR', 'NOPORT_ARRIVEE', 'DISTANCE'];

    public function getLiaisonSecteur()
    {
        return  $this   ->join('port as P1', 'liaison.noport_depart = P1.noport')
                        ->join('port as P2', 'liaison.noport_arrivee = P2.noport')
                        ->join('secteur', 'liaison.nosecteur = secteur.nosecteur')
                        ->select('secteur.nom as "nom", liaison.noliaison, distance, P1.nom as "Port_depart", P2.nom as "Port_arrivee"')
                        ->get()->getResult();
    }
    public function getTarif($noliaison)
    {
        return $this    ->join('tarifer as t', 't.noliaison = liaison.noliaison')
                        ->join('periode as p', 'p.noperiode = t.noperiode')
                        ->join('type as ty', 'ty.lettrecategorie = t.lettrecategorie and ty.notype = t.notype')
                        ->join('categorie c', 'c.lettrecategorie = t.lettrecategorie')
                        ->join('port as port_depart', 'port_depart.noport = liaison.noport_depart')
                        ->join('port as port_arrivee', 'port_arrivee.noport = liaison.noport_arrivee')
                        ->where('liaison.noliaison', $noliaison) //ajouter pour la période
                        ->select('t.LETTRECATEGORIE, c.LIBELLE, ty.NOTYPE, ty.LIBELLE as "libelleType", t.TARIF, p.DATEDEBUT, p.DATEFIN, port_depart.NOM as "portDepart", port_arrivee.NOM as "portArrivee"')
                        ->get()->getResult();
    }
    public function getLiaison($noSecteur)
    {
        return $this    ->join('port as port_depart', 'port_depart.noport = liaison.noport_depart')
                        ->join('port as port_arrivee', 'port_arrivee.noport = liaison.noport_arrivee')
                        ->where('nosecteur', $noSecteur)
                        ->select('noliaison, port_depart.NOM as port_depart, port_arrivee.NOM as port_arrivee')
                        ->get()->getResult();
    }
    public function getTraverseeBateau($noliaison, $date)
    {
        return $this    ->join('traversee as t', 't.noliaison = liaison.noliaison')
                        ->join('bateau as b', 'b.nobateau = t.nobateau')
                        ->where('t.noliaison', $noliaison)
                        ->like('dateheuredepart', $date, 'after')
                        ->select('notraversee, dateheuredepart, b.nom')
                        ->get()->getResult();
    }
    public function getLesCategories()
    {
        return $this    ->join('tarifer as t', 't.noliaison = liaison.noliaison')
                        ->join('type as ty', 'ty.notype = t.notype')
                        ->join('categorie as c', 'c.LETTRECATEGORIE = ty.LETTRECATEGORIE')
                        ->select('DISTINCT(c.lettrecategorie), c.libelle')
                        ->get()->getResult();
    }
    public function getCapaciteMaximal($noTraversee, $lettreCategorie)
    {
        return $this    ->join('traversee as t', 't.noliaison = liaison.noliaison')
                        ->join('bateau as b', 'b.nobateau = t.nobateau')
                        ->join('contenir c', 'c.nobateau = b.nobateau')
                        ->where('c.lettrecategorie', $lettreCategorie)
                        ->where('t.notraversee', $noTraversee)
                        ->select('c.capacitemax')
                        ->get()->getResult();
    }
    public function getQuantiteEnregistree($noTraversee, $lettreCategorie)
    {
        return $this    ->join('traversee as t', 't.noliaison = liaison.noliaison')
                        ->join('reservation as r', 'r.notraversee = t.notraversee')
                        ->join('enregistrer as e', 'e.noreservation = r.noreservation')
                        ->where('r.notraversee', $noTraversee)
                        ->where('e.lettrecategorie', $lettreCategorie)
                        ->select('sum(e.quantitereservee)')
                        ->get()->getResult();
    }
}