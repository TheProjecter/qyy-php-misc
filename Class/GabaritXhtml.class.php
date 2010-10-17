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

// DOC: pointbeing.net - Adding a Doctype Declaration to a DOMDocument in PHP
// http://pointbeing.net/weblog/2009/03/adding-a-doctype-declaration-to-a-domdocument-in-php.html
  
// DOC: StackOverflow - Accessing Comments in XML using XPath
// http://stackoverflow.com/questions/784745/accessing-comments-in-xml-using-xpath

// DOC: SAXON - XPath Expression Syntax
// http://saxon.sourceforge.net/saxon6.5.3/expressions.html

// TODO: Commentaires
// TODO: Orthographe
// TODO: Gestion des META
// TODO: Gestion d'ajout des CSS
// TODO: Gestion d'ajout des scripts externe
// TODO: Gestion d'ajout des scripts interne (CDATA...)
// TODO: Gestion d'ajout des Styles
// TODO: Gestion des retour avec les Headers (à l'aide de la class)
// TODO: Ajout d'XML brut avec validation
// TODO: Gérer la balise <base>
// TODO: Ajouter des toudou ^^

// PITETRE: Gestion des langues fr-fr / en-en, enfin la norme là...

// PITETRE: Controler validité des chaines (genre pas de saut de lignes...)
//            url
//            mail

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
   * @var DOMElement
   */
  private $metaAuthor;
  /**
   *
   * @var DOMElement
   */
  private $metaCategory;
  /**
   *
   * @var DOMElement
   */
  private $metaContentLanguage;
  /**
   *
   * @var DOMElement
   */
  private $metaCopyright;
  /**
   *
   * @var DOMElement
   */
  private $metaDateCreationYyyymmdd;
  /**
   *
   * @var DOMElement
   */
  private $metaDateRevisionYyyymmdd;
  /**
   *
   * @var DOMElement
   */
  private $metaDescription;
  /**
   *
   * @var DOMElement
   */
  private $metaDistribution;
  /**
   *
   * @var DOMElement
   */
  private $metaExpires;
  /**
   *
   * @var DOMElement
   */
  private $metaGenerator;
  /**
   *
   * @var DOMElement
   */
  private $metaIdentifierUrl;
  /**
   *
   * @var DOMElement
   */
  private $metaKeywords;
  /**
   *
   * @var DOMElement
   */
  private $metaReplyTo;
  /**
   *
   * @var DOMElement
   */
  private $metaRevisitAfter;
  /**
   *
   * @var DOMElement
   */
  private $metaRobots;

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
    $titre = strval($titre);
    $lang = strval($lang);

    if($typeDTD != TYPE_DTD_XHTML_TRANSITIONAL
    || $typeDTD != TYPE_DTD_XHTML_STRICT)
    {
      $typeDTD = TYPE_DTD_XHTML_TRANSITIONAL;
    }

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
    $this->initMetas();
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
   */
  private function initMetas()
  {
    $this->metaAuthor               = $this->document->createElement('meta');
    $this->metaCategory             = $this->document->createElement('meta');
    $this->metaContentLanguage      = $this->document->createElement('meta');
    $this->metaCopyright            = $this->document->createElement('meta');
    $this->metaDateCreationYyyymmdd = $this->document->createElement('meta');
    $this->metaDateRevisionYyyymmdd = $this->document->createElement('meta');
    $this->metaDescription          = $this->document->createElement('meta');
    $this->metaDistribution         = $this->document->createElement('meta');
    $this->metaExpires              = $this->document->createElement('meta');
    $this->metaGenerator            = $this->document->createElement('meta');
    $this->metaIdentifierUrl        = $this->document->createElement('meta');
    $this->metaKeywords             = $this->document->createElement('meta');
    $this->metaReplyTo              = $this->document->createElement('meta');
    $this->metaRevisitAfter         = $this->document->createElement('meta');
    $this->metaRobots               = $this->document->createElement('meta');

    $attr = $this->document->createAttribute('name');
    $attr->value = 'author';
    $this->metaAuthor->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'category';
    $this->metaCategory->appendChild($attr);
    $attr = $this->document->createAttribute('http-equiv');
    $attr->value = 'Content-Language';
    $this->metaContentLanguage->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'copyright';
    $this->metaCopyright->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'Date-Creation-yyyymmdd';
    $this->metaDateCreationYyyymmdd->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'Date-Revision-yyyymmdd';
    $this->metaDateRevisionYyyymmdd->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'description';
    $this->metaDescription->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'distribution';
    $this->metaDistribution->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'expires';
    $this->metaExpires->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'generator';
    $this->metaGenerator->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'identifier-url';
    $this->metaIdentifierUrl->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'keywords';
    $this->metaKeywords->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'reply-to';
    $this->metaReplyTo->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'revisit-after';
    $this->metaRevisitAfter->appendChild($attr);
    $attr = $this->document->createAttribute('name');
    $attr->value = 'robots';
    $this->metaRobots->appendChild($attr);
  }

  /**
   * Ajoute la balise <meta> "author" informant sur le ou les auteurs.
   * @link http://corrigesduweb.com/popups/meta-author.htm
   * @param string $auteurs <p>
   * Prénom en minuscules, puis nom en majuscules ('Prénom NOM').
   * Les auteurs multiples doivent êtres séparés d'une virgule.</p>
   * @param string $lang <p>
   * facultatif</p>
   */
  public function AjouteMetaAuthor($auteurs, $lang=false)
  {
    $auteurs = strval($auteurs);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $auteurs;

    $this->metaAuthor->appendChild($attrContent);

    if($lang)
    {
      $lang = strval($lang);
      $attrLang = $this->document->createAttribute('lang');
      $attrLang->value = $lang;

      $this->metaAuthor->appendChild($attrLang);
    }

    $this->elementHead->appendChild($this->metaAuthor);
  }

  /**
   * Ajoute la balise <meta> "expires" qui indique la date d'expiration de la
   * page (à priori, la date à laquelle la page ne sera donc plus
   * disponible).<br/>
   * Si le paramètre d'expiration n'est pas renseigné, la valeur 'never' est
   * affecté par défaut (la page n'expire jamais).
   * @link http://corrigesduweb.com/popups/meta-expires.htm
   * @param DateTime $expiration <p>
   * La date d'expiration de la page. Si le format est incorecte, la valeur
   * 'never' sera attribué par défaut.
   * </p>
   */
  public function AjouteMetaExpires($expiration = 'never')
  {
    if(!is_object($expiration) || !is_a($expiration, 'DateTime'))
    {
      $expiration = 'never';
    }
    else
    {
      $expiration = strtolower($expiration->format('d F Y'));
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $expiration;

    $this->metaExpires->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaExpires);
  }

  /**
   * Ajoute la balise <meta> "generator" qui sert à indiquer le nom du logiciel
   * qui à généré la page.
   * @link http://corrigesduweb.com/popups/meta-generator.htm
   * @param string $generateur <p>
   * Le nom du générateur de la page.
   * </p>
   */
  public function AjouteMetaGenerator($generateur)
  {
    $generateur = strval($generateur);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $generateur;

    $this->metaGenerator->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaGenerator);
  }

  /**
   * Ajoute la balise <meta> "identifier-url" qui sert à indiquer l'url de la
   * porte d'entrée du site web.
   * @link http://corrigesduweb.com/popups/meta-url.htm
   * @param string $site <p>
   * L'url de la porte d'entrée du site web.
   * </p>
   */
  public function AjouteMetaIdentifierUrl($url)
  {
    $url = strval($url);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $url;

    $this->metaIdentifierUrl->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaIdentifierUrl);
  }

  /**
   * Ajoute la balise <meta> "keywords" contenant les mots clef facilitant
   * l'indexation de la page. Les moteurs de recherches ne prennent que
   * rarement en compte plus de 400 caractères, et il est préférable de ne pas
   * dépasser 100 mots clef ainsi que d'éviter les répétitions de
   * mots similaires.
   * @link http://corrigesduweb.com/popups/meta-keywords.htm
   * @param string $motsClefs <p>
   * La chaine de mot clefs spéraré par des virgules, limité à 1000 caractères
   * espaces compris. Pour cette raison, éviter de mettre des espaces avant et
   * après les virgules.<br/>
   * Les saut de lignes ne sonts pas permis, et si la chaine dépasse 1000
   * caractères, elle sera tronqué.
   * </p>
   * @param string $lang <p>
   * facultatif</p>
   */
  public function AjouteMetaKeywords($motsClefs, $lang=false)
  {
    $motsClefs = strval($motsClefs);

    if(strlen($motsClefs) > 1000)
    {
      $motsClefs = substr($motsClefs, 0, 1000);
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $motsClefs;

    $this->metaKeywords->appendChild($attrContent);

    if($lang)
    {
      $lang = strval($lang);
      $attrLang = $this->document->createAttribute('lang');
      $attrLang->value = $lang;

      $this->metaKeywords->appendChild($attrLang);
    }

    $this->elementHead->appendChild($this->metaKeywords);
  }
  // TODO: Gérer multiples meta keywords

  /**
   * Ajoute la balise <meta> "reply-to" informant sur l'adresse e-mail <br/>
   * principale du site. Cette adresse est systématiquement collecté par les
   * spammers
   * @link http://corrigesduweb.com/popups/meta-reply.htm
   * @param string $email <p>
   * L'adresse e-mail principale du site
   * </p>
   */
  public function AjouteMetaReplyTo($email)
  {
    $email = strval($email);
    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $email;

    $this->metaReplyTo->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaReplyTo);
  }

  /**
   * Ajoute la balise <meta> "revisit-after" informant la fréquence<br/>
   * à laquelle les moteurs de recherches doivent revisiter le site.
   * @link http://corrigesduweb.com/popups/meta-revisit.htm
   * @param int $unite <p>
   * L'unité de fréquence à laquelle les moteurs de recherche doivent
   * revisiter le site. Si la valeur n'est pas renseigné correctement ou
   * est à 0, elle sera initialisé à 1</p>
   * @param string $frequence <p>
   * Valeurs acceptés : 'days' (jours), 'weeks' (semaines) ou 'month' (mois).
   * Si la valeur n'est pas renseigné correctement, 'days' sera utilisé.</p>
   */
  public function AjouteMetaRevisitAfter($unite, $frequence='days')
  {
    $unite = intval($unite);
    if($unite == 0)
    {
      $unite++;
    }

    if($frequence != 'days' || $frequence != 'weeks' || $frequence != 'month')
    {
      $frequence = 'days';
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $unite.' '.$frequence;

    $this->metaRevisitAfter->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaRevisitAfter);
  }

  /**
   * Ajoute la balise <meta> "robots" informant les moteurs de recherche sur
   * l'utilité d'indexer la page ou de suivre les liens.<br/>
   * Si la balise n'est pas présente, l'instruction par défaut est d'indexer la
   * page et de suivre les liens.
   * @link http://corrigesduweb.com/popups/meta-robots.htm
   * @param boolean $indexer <p>
   * true = indexer la page, false = ne pas indexer la page
   * </p>
   * @param boolean $suivre <p>
   * true = suivre les liens, false= ne pas suivre les liens
   * </p>
   */
  public function AjouteMetaRobots($indexer=true, $suivre=true)
  {
    if ($indexer)
    {
      $indexer = 'index';
    }
    else
    {
      $indexer = 'noindex';
    }

    if($suivre)
    {
      $suivre = 'follow';
    }
    else
    {
      $suivre = 'nofollow';
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $indexer.','.$suivre;

    $this->metaRobots->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaRobots);
  }

  ////// GETTERS \\\\\\

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
   * @return string
   */
  public function GetLang()
  {
    return $this->attrLang->value;
  }

  /**
   *
   * @return DOMDocument
   */
  public function GetDocument()
  {
    return $this->document;
  }

  ////// SETTERS \\\\\\

  /**
   *
   * @param string $titre
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
   * @param string $lang
   */
  public function SetLang($lang)
  {
    $this->attrLang->value = $lang;
  }

}