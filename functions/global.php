<?php

/**
 * Déclarer ici, toutes les fonctions utiles
 * aux pages de notre projet. Parce que c'est
 * notre projet. Nous tous !
 */

/**
 * Déclarer ici, toutes les fonctions utiles
 * aux pages de notre projet. Parce que c'est
 * notre projet. Nous tous !
 */

session_start(); // Démarrage de la session PHP


/**
 * Permet de résumer un contenu.
 *
 * @param $text
 * @param int $nbChars
 * @return string
 */
function summarize($text, $nbChars = 180): string
{
    // Suppression des balises HTML
    $string = strip_tags($text);

    // Si mon string est > à 180
    if (iconv_strlen($string) > $nbChars ){

        // Je coupe ma chaine à 180
        $stringCut = substr($string, 0 ,$nbChars);

        // Je m'assure de couper un mot en recherchant derniere position
        $string = substr($stringCut, 0 , strrpos($stringCut, ' '));

        $string .= '...';

    }
    return $string ;

}

function dd($param) {
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    die;
}

/**
 * Permet de générer un slug.
 *
 * @param $text
 * @param string $divider
 * @return string
 */
function slugify($text, string $divider = '-'): string
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}


/**
 * Redirige l'utilisateur sur une
 * nouvelle page.
 *
 * @param $page
 */
function redirection($page){
    header('Location: '.$page);
}