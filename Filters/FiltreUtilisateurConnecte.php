<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FiltreUtilisateurConnecte implements FilterInterface
{
    public function before(RequestInterface $request, $argument = null)
    {
        if(empty(session()->get('ID'))){
            return redirect()->to(base_url('authentification'));
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}