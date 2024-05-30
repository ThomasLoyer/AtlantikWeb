<?php
namespace App\Models;
use CodeIgniter\Model;

Class ModeleTraversee extends Model
{
    protected $table = 'traversee';
    protected $primaryKey = 'notraversee';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['notraversee', 'noliaison', 'nobateau', 'dateheuredepart', 'dateheurearrivee', 'clotureembarquement'];

    public function getTypeTarrif($noTraversee)
    {
        return $this    ->join('liaison l', 'traversee.NOLIAISON=l.NOLIAISON', 'inner')
                        ->join('tarifer ta', 'ta.NOLIAISON=l.NOLIAISON')
                        ->join('periode p', 'p.NOPERIODE=ta.NOPERIODE')
                        ->join('type ty','ty.NOTYPE=ta.NOTYPE and ty.LETTRECATEGORIE=ta.LETTRECATEGORIE')
                        ->select('ty.lettrecategorie, ty.notype, ty.libelle , ta.tarif')
                        ->where('traversee.notraversee', $noTraversee)
                        ->where('traversee.DATEHEUREDEPART >= p.datedebut')
                        ->where('traversee.DATEHEUREDEPART <= p.datefin')
                        ->get()->getResult();
    }
}