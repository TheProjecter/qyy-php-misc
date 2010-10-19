<?php
/*
 * Copyright G. Qyy, (2010)
 *
 * code@qyy.fr
 *
 * Ce logiciel est un programme informatique servant d'exemple de code.
 * Ce logiciel a une visée purement éducative et n'est pas destiné à être
 * utilisé en production.
 *
 * Ce logiciel est régi par la licence CeCILL-B soumise au droit français et
 * respectant les principes de diffusion des logiciels libres. Vous pouvez
 * utiliser, modifier et/ou redistribuer ce programme sous les conditions
 * de la licence CeCILL-B telle que diffusée par le CEA, le CNRS et l'INRIA
 * sur le site "http://www.cecill.info"
 * ("http://www.cecill.info/licences/Licence_CeCILL-B_V1-fr.html").
 *
 * En contrepartie de l'accessibilité au code source et des droits de copie,
 * de modification et de redistribution accordés par cette licence, il n'est
 * offert aux utilisateurs qu'une garantie limitée.  Pour les mêmes raisons,
 * seule une responsabilité restreinte pèse sur l'auteur du programme,  le
 * titulaire des droits patrimoniaux et les concédants successifs.
 *
 * A cet égard  l'attention de l'utilisateur est attirée sur les risques
 * associés au chargement,  à l'utilisation,  à la modification et/ou au
 * développement et à la reproduction du logiciel par l'utilisateur étant
 * donné sa spécificité de logiciel libre, qui peut le rendre complexe à
 * manipuler et qui le réserve donc à des développeurs et des professionnels
 * avertis possédant  des  connaissances  informatiques approfondies.  Les
 * utilisateurs sont donc invités à charger  et  tester  l'adéquation  du
 * logiciel à leurs besoins dans des conditions permettant d'assurer la
 * sécurité de leurs systèmes et ou de leurs données et, plus généralement,
 * à l'utiliser et l'exploiter dans les mêmes conditions de sécurité.
 *
 * Le fait que vous puissiez accéder à cet en-tête signifie que vous avez
 * pris connaissance de la licence CeCILL-B, et que vous en avez accepté les
 * termes.
 */

// DOC: W3.org - CSS2 : 7 Media types
// http://www.w3.org/TR/CSS2/media.html

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
