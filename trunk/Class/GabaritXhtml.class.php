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

define('TYPE_DTD_XHTML_STRICT', 'Strict');
define('TYPE_DTD_XHTML_TRANSITIONAL', 'Transitional');

// pointbeing.net - Adding a Doctype Declaration to a DOMDocument in PHP
// DOC: http://pointbeing.net/weblog/2009/03/adding-a-doctype-declaration-to-a-domdocument-in-php.html
  
// StackOverflow - Accessing Comments in XML using XPath
// DOC: http://stackoverflow.com/questions/784745/accessing-comments-in-xml-using-xpath

// SAXON - XPath Expression Syntax
// DOC: http://saxon.sourceforge.net/saxon6.5.3/expressions.html

/**
 * Charge le gabarit d'une page XHTML paramétrable
 *
 * @author Qyy
 */
class GabaritXhtml {

  /**
   *
   * @var DOMImplementation
   */
  private $implementation;

  /**
   *
   * @var DOMDocumentType
   */
  private $dtd;

  /**
   *
   * @var DOMDocument
   */
  private $document;

  /**
   *
   * @var DOMElement
   */
  private $elementHtml;

  /**
   *
   * @var DOMElement
   */
  private $elementHead;

  /**
   *
   * @var DOMElement
   */
  private $elementBody;

  /**
   *
   * @var DOMElement
   */
  private $elementTitle;

  /**
   *
   * @var DOMText
   */
  private $textTitre;

  /**
   *
   * @var DOMAttr
   */
  private $attrLang;

  /**
   *
   * @param string $titre
   * @param string $lang
   * @param string $typeDTD
   */
  function __construct(
    $titre,
    $lang='fr-fr',
    $typeDTD = TYPE_DTD_XHTML_TRANSITIONAL)
  {

    $this->implementation = new DOMImplementation();

    $this->dtd =
      $this->implementation->createDocumentType(
        'html',                                     // qualifiedName
        '-//W3C//DTD XHTML 1.0 '.$typeDTD.'//EN',   // publicId
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-'
          .strtolower($typeDTD).'.dtd'              // systemId
      );

    $this->document = $this->implementation->createDocument('', '', $this->dtd);

    $this->init($titre, $lang);

  }

  /**
   *
   * @param string $titre
   */
  private function init($titre, $lang)
  {
    $this->elementHtml     = $this->document->createElement('html');
    $this->elementHead     = $this->document->createElement('head');
    $this->elementBody     = $this->document->createElement('body');
    $this->elementTitle    = $this->document->createElement('title');
    $this->textTitre       = $this->document->createTextNode($titre);
    $this->attrLang        = $this->document->createAttribute('lang');
    $this->attrLang->value = $lang;

    $this->document->appendChild($this->elementHtml);
    $this->elementHtml->appendChild($this->elementHead);
    $this->elementHtml->appendChild($this->attrLang);
    $this->elementHead->appendChild($this->elementTitle);
    $this->elementTitle->appendChild($this->textTitre);
    $this->elementHtml->appendChild($this->elementBody);
  }



  /**
   *
   * @param string $titre 
   * @return void
   */
  public function SetTitre($titre)
  {
    $set = $this->document->createTextNode($titre);

    $this->elementTitle->replaceChild($set, $this->textTitre);

    $this->textTitre = $set;

    // Si seulement cette fonction était implémenté...
    //$this->textTitre->replaceWholeText($titre);
  }

  /**
   *
   * @return string
   */
  public function GetTitre()
  {
    return $this->textTitre->wholeText;
  }

  /**
   *
   * @return DOMDocument
   */
  public function GetDocument()
  {
    return $this->document;
  }

}

?>
