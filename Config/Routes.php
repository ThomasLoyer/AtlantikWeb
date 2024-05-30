<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::afficherAccueil');
$routes->match(['get', 'post'], 'creercompte','Visiteur::formCreerCompte' );
$routes->get('afficherliaison', 'Visiteur::afficherLiaison');
$routes->get('tarifliaison/(:num)', 'Visiteur::afficherTarif/$1');
$routes->get('afficherhorraire', 'Visiteur::afficherHorraire');
$routes->match(['get', 'post'], '/afficherhorraire/(:num)', 'Visiteur::afficherHorraire/$1');
$routes->match(['get', 'post'], 'authentification', 'Visiteur::authentification');
$routes->get('deconnexion', 'Utilisateur::deconnexion', ['filter' => 'UtilisateurConnecte']);
$routes->get('reserver/(:num)', 'Utilisateur::reserver/$1', ['filter' => 'UtilisateurConnecte']);
$routes->post('traiterreservation', 'Utilisateur::traiterReservation', ['filter' => 'UtilisateurConnecte']);
$routes->match(['get', 'post'],'modifiercompte', 'Utilisateur::formModifierCompte',['filter' => 'UtilisateurConnecte']);