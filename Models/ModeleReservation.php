<?php 
namespace App\Models;
use CodeIgniter\Model;

class ModeleReservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'noreservation';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['noreservation', 'notraversee', 'noclient', 'dateheure','montanttotal', 'paye', 'modereglement'];

    public function getInfoReservation($noclient, ?int $perPage = null):array
    {

        $this   ->builder()        
                ->join('traversee as t', 't.notraversee = reservation.notraversee')
                ->join('liaison as l', 'l.noliaison = t.noliaison')
                ->join('port as portArrivee', 'portArrivee.noport = l.noport_arrivee')
                ->join('port as portDepart', 'portDepart.noport = l.noport_depart')                        
                ->where('noclient', $noclient)
                ->select('noreservation, t.notraversee, dateheure, portDepart.nom as depart, portArrivee.nom as arrivee, dateheuredepart as datedepart, montanttotal');

        return [
            'reservation'   => $this->paginate($perPage),
            'pager'         => $this->pager,
        ];
    }
}