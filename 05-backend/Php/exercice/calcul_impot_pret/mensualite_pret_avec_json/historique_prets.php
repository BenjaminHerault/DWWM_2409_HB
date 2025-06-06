<?php

class HistoriquePrets
{
    private $filePath; // Chemin du fichier JSON pour stocker l'historique des prêts

    /**
     * Constructeur de la classe HistoriquePrets
     * @param string $filePath Chemin du fichier JSON (par défaut : 'historique_prets.json')
     */
    public function __construct($filePath = './report/historique_prets.json')
    {
        $this->filePath = $filePath;
    }

    /**
     * Charger l'historique des prêts depuis le fichier JSON
     * @return array Retourne un tableau contenant l'historique des prêts
     */
    public function chargerHistorique(): array
    {
        // Vérifie si le fichier existe
        if (file_exists($this->filePath)) {
            $data = file_get_contents($this->filePath); // Lit le contenu du fichier
            return json_decode($data, true) ?? []; // Décode le JSON en tableau PHP
        }
        return []; // Retourne un tableau vide si le fichier n'existe pas
    }

    /**
     * Ajouter un nouveau prêt à l'historique
     * @param array $pret Données du prêt à ajouter
     */
    public function ajouterPret($pret)
    {
        $historique = $this->chargerHistorique(); // Charge l'historique existant
        //$historique[] = $pret; // Ajoute le nouveau prêt à l'historique
        array_push($historique, $pret); // Ajoute le nouveau prêt à l'historique
        $this->sauvegarderHistorique($historique); // Sauvegarde l'historique mis à jour
    }

    /**
     * Sauvegarder l'historique des prêts dans le fichier JSON
     * @param array $historique Tableau contenant l'historique des prêts
     */
    private function sauvegarderHistorique($historique)
    {
        // Encode le tableau en JSON et l'écrit dans le fichier
        file_put_contents($this->filePath, json_encode($historique, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Récupérer l'historique complet des prêts
     * @return array Retourne un tableau contenant l'historique complet
     */
    public function getHistorique()
    {
        return $this->chargerHistorique(); // Retourne l'historique chargé depuis le fichier
    }
}