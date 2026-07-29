<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Statuts des fiches (Leads)
    |--------------------------------------------------------------------------
    |
    | Liste complète et ordonnée des statuts par lesquels peut passer une
    | fiche prospect/lead au sein du centre d'appel VISIONBF.
    |
    */
    'statuts' => [
        'Nouveau',
        'A Rappeler',
        'Nrp',
        'A retraiter',
        'Confirmer régie',
        'Confirmer',
        'VT programmée',
        'VT réalisée',
        'Chantier programmé',
        'Chantier terminé nettoyage',
        'Installer 100%',
        'Chantier terminé remplacement',
        'Chantier annulé',
        'Annulé tole',
        'SAV',
        'SAV réalisé',
    ],

    /*
    |--------------------------------------------------------------------------
    | Statut par défaut
    |--------------------------------------------------------------------------
    |
    | Le statut attribué automatiquement lors de la création d'une nouvelle fiche.
    |
    */
    'default_statut' => 'Nouveau',

    /*
    |--------------------------------------------------------------------------
    | Produits gérés dans le CRM
    |--------------------------------------------------------------------------
    |
    | Liste des produits prospectés par les différentes équipes.
    |
    */
    'produits' => [
        'lanterneau' => 'Lanterneau',
        'energie'    => 'Énergie',
        'isolation'  => 'Isolation',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rôles du personnel
    |--------------------------------------------------------------------------
    |
    | Rôles d'accès pour le système de gestion des permissions (RBAC).
    |
    */
    'roles' => [
        'agent'       => 'Agent',
        'superviseur' => 'Superviseur',
        'secretaire'  => 'Secrétaire',
        'admin'       => 'Administrateur',
    ],

];