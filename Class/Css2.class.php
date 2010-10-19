<?php


/**
 * Description of Css2
 *
 * @author Qyy
 */
class Css2
{

  /**
   * Convient à tout les appareils.
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_ALL = 'all';
  /**
   * Destiné aux appareils braille à retour tactile.
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_BRAILLE = 'braille';
  /**
   * Destiné à l'impression braille.
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_EMBOSSED = 'embossed';
  /**
   * Destiné aux appareils portatifs (petit écran, bande passante limitée...).
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_HANDHELD = 'handheld';
  /**
   * Destiné aux médias paginée et pour les documents affichés à l'écran en mode
   * aperçu avant impression. Consulter la section sur les médias paginés pour
   * informations sur leurs spécificités.
   * @link http://www.w3.org/TR/CSS2/media.html
   * @link http://www.w3.org/TR/CSS2/page.html
   */
  const MEDIA_PRINT = 'print';
  /**
   * Destiné aux présentations projetées, par exemple avec des vidéo-projecteurs.
   * Consulter la section sur les médias paginés pour informations sur leurs
   * spécificités.
   * @link http://www.w3.org/TR/CSS2/media.html
   * @link http://www.w3.org/TR/CSS2/page.html
   */
  const MEDIA_PROJECTION = 'projection';
  /**
   * Destiné principalement aux écrans couleur d'ordinateur.
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_SCREEN = 'screen';
  /**
   * Destiné à des synthétiseurs vocaux. Note: CSS2 avait un type de média dénommé
   * 'aural' à cette fin. Voir l'annexe sur les feuilles de style auditives pour
   * plus de détails.
   * @link http://www.w3.org/TR/CSS2/media.html
   * @link http://www.w3.org/TR/CSS2/aural.html
   */
  const MEDIA_SPEECH = 'speech';
  /**
   * Destiné aux médias utilisant une grille de caractères fixe (tels que
   * télétypes, les terminaux, les consoles unix, ou des appareils portables aux
   * capacités d'affichage limitées). Les unités en pixel ne devraient pas êtres
   * utilisées avec ce type de média.
   * @link http://www.w3.org/TR/CSS2/media.html
   * @link http://www.w3.org/TR/CSS2/syndata.html#pixel-units
   */
  const MEDIA_TTY = 'tty';
  /**
   * Destiné aux appareils du type télévision (basse résolution, couleur et
   * possibilité de défillement limitée, sons disponibles).
   * @link http://www.w3.org/TR/CSS2/media.html
   */
  const MEDIA_TV = 'tv';

}
?>
