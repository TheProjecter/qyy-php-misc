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

// dépendances
require_once 'Css2.class.php';
require_once 'XhtmlTransitional.class.php';

// DOC: pointbeing.net - Adding a Doctype Declaration to a DOMDocument in PHP
// http://pointbeing.net/weblog/2009/03/adding-a-doctype-declaration-to-a-domdocument-in-php.html
  
// DOC: StackOverflow - Accessing Comments in XML using XPath
// http://stackoverflow.com/questions/784745/accessing-comments-in-xml-using-xpath

// DOC: SAXON - XPath Expression Syntax
// http://saxon.sourceforge.net/saxon6.5.3/expressions.html

// PROGRESS: Commentaires
// PROGRESS: Gestion d'ajout des CSS
// PROGRESS: Gestion d'ajout des Styles
// PROGRESS: Aller se documenter dans les RFC/W3C pour les metas et le reste

// TODO: Gestion META : passer init méta dans ajoute respectif (controle
// duplique...)
// TODO: CreeMeta($attr1, $attr2); plus gestion...
// TODO: Getters Setters META
// TODO: Orthographe
// TODO: Gestion d'ajout des scripts externe
// TODO: Gestion d'ajout des scripts interne (CDATA...)
// TODO: Gestion des retour avec les Headers (à l'aide de la class)
// TODO: Ajout d'XML brut avec validation
// TODO: Gérer la balise <base>
// TODO: Gestion des exceptions
// TODO: Ajouter des toudou ^^

// MAYBE: Gestion des langues fr-fr / en-en, enfin la norme là...
// MAYBE: Controler validité des chaines (genre pas de saut de lignes...)
//            url
//            mail

/**
 * Charge le gabarit d'une page XHTML paramétrable
 *
 * @author Qyy
 */
class GabaritXhtml
{

  const TYPE_DTD_XHTML_STRICT = 'Strict';
  const TYPE_DTD_XHTML_TRANSITIONAL = 'Transitional';

  const DISTRIBUTION_GLOBAL = 'global';
  const DISTRIBUTION_LOCALE = 'local';

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

  /// Métas \\\

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
   * @param string $langue
   * @param string $typeDTD
   */
  function __construct(
    $titre,
    $langue='fr-fr',
    $typeDTD = GabaritXhtml::TYPE_DTD_XHTML_TRANSITIONAL)
  {
    $titre = strval($titre);
    $langue = strval($langue);

    if($typeDTD != $this::TYPE_DTD_XHTML_TRANSITIONAL
    || $typeDTD != $this::TYPE_DTD_XHTML_STRICT)
    {
      $typeDTD = $this::TYPE_DTD_XHTML_TRANSITIONAL;
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

    $this->init($titre, $langue);
    $this->initMetas();
  }

  /**
   *
   * @param string $titre
   */
  private function init($titre, $langue)
  {
    $this->elementHtml     = $this->document->createElement('html');
    $this->elementHead     = $this->document->createElement('head');
    $this->elementBody     = $this->document->createElement('body');
    $this->elementTitle    = $this->document->createElement('title');
    $this->textTitre       = $this->document->createTextNode($titre);
    $this->attrLang        = $this->document->createAttribute('lang');
    $this->attrLang->value = $langue;

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
   * @param string $langue <p>
   * facultatif</p>
   */
  public function AjouteMetaAuthor($auteurs, $langue=false)
  {
    $auteurs = strval($auteurs);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $auteurs;

    $this->metaAuthor->appendChild($attrContent);

    if($langue)
    {
      $langue = strval($langue);
      $attrLang = $this->document->createAttribute('lang');
      $attrLang->value = $langue;

      $this->metaAuthor->appendChild($attrLang);
    }

    $this->elementHead->appendChild($this->metaAuthor);
  }

  /**
   * Ajoute la balise <meta> "category" qui sert à indiquer les catégories dans
   * lesquelles rentre le site.
   * @link http://corrigesduweb.com/popups/meta-category.htm
   * @param string $categories <p>
   * Liste des catégories séparées par une virgule.
   * </p>
   * @todo catégories assisté
   */
  public function AjouteMetaCategory($categories)
  {
    $categories = strval($categories);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $categories;

    $this->metaCategory->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaCategory);
  }

  /**
   * Ajoute la balise <meta> "Content-Language" qui sert à indiquer la langue
   * de rédaction du contenu de la page.
   * @link http://corrigesduweb.com/popups/meta-language.htm
   * @param string $langue <p>
   * La langue de rédaction du contenu de la page sur deux lettres.
   * </p>
   */
  public function AjouteMetaContentLanguage($langue = 'fr')
  {
    $langue = strval($langue);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $langue;

    $this->metaContentLanguage->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaContentLanguage);
  }

  /**
   * Ajoute la balise <meta> "copyright" qui sert à indiquer le ou les copyright
   * attenant au contenu de la page.
   * @link http://corrigesduweb.com/popups/meta-copyright.htm
   * @param string $copyright <p>
   * Le ou les mentions de copyright. En cas de mentions multiples, les séparer
   * par une virgule.
   * </p>
   */
  public function AjouteMetaCopyright($copyright)
  {
    $copyright = strval($copyright);

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $copyright;

    $this->metaCopyright->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaCopyright);
  }

  /**
   * Ajoute la balise <meta> "Date-Creation-yyyymmdd" informant sur la date à
   * laquelle la page à été créé (et non pas généré).
   * @link http://corrigesduweb.com/popups/meta-creation.htm
   * @param DateTime $dateCreation <p>
   * Date de la création de la page. Si le format fournit est incorecte, le
   * DateTime récupéré sera celui de la génération de la page ('now').
   * </p>
   */
  public function AjouteMetaDateCreationYyyymmdd($dateCreation)
  {
    if(!is_object($dateCreation) || !is_a($dateCreation, 'DateTime'))
    {
      $dateCreation = new DateTime('now');
    }

    $dateCreation = $dateCreation->format('dmY');

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $dateCreation;

    $this->metaDateCreationYyyymmdd->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaDateCreationYyyymmdd);
  }

  /**
   * Ajoute la balise <meta> "Date-Revision-yyyymmdd" informant sur la date à
   * laquelle le contenu de la page à été modifié pour la dernière fois.
   * @link http://corrigesduweb.com/popups/meta-revision.htm
   * @param DateTime $dateRevision <p>
   * Date de la dernière révision (denière modification du contenu) de la page.
   * Si le format fournit est incorecte, le DateTime récupéré sera celui de la
   * génération de la page ('now').
   * </p>
   */
  public function AjouteMetaDateRevisionYyyymmdd($dateRevision)
  {
    if(!is_object($dateRevision) || !is_a($dateRevision, 'DateTime'))
    {
      $dateRevision = new DateTime('now');
    }

    $dateRevision = $dateRevision->format('dmY');

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $dateRevision;

    $this->metaDateRevisionYyyymmdd->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaDateRevisionYyyymmdd);
  }

  /**
   * Ajoute la balise <meta> "description" qui doit contenir une description de
   * la page (et non du site).
   * @link http://corrigesduweb.com/popups/meta-description.htm
   * @param string $description <p>
   * La description doit faire 200 caractères maximum. Si la chaine fournie est
   * plus longue, elle serat tronqué. Les sauts de ligne ne sont pas permit.
   * </p>
   * @todo Améliorer les controles sur la chaine de description
   */
  public function AjouteMetaDescription($description)
  {
    $description = strval($description);

    if(strlen($description) > 200)
    {
      $description = substr($description, 0, 200);
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $description;

    $this->metaDescription->appendChild($attrContent);

    // On insert la meta juste après le titre
    // DOC: http://fr2.php.net/manual/fr/domnode.insertbefore.php#90833
    if($this->elementTitle->nextSibling) {
        $this->elementTitle->parentNode->insertBefore(
          $this->metaDescription,
          $this->elementTitle->nextSibling
        );
    } else {
        $this->elementTitle->parentNode->appendChild($this->metaDescription);
    }
  }

  /**
   * Ajoute la balise <meta> "distribution" qui indique la portée de la
   * distribution de la page. La valeur par défaut est DISTRIBUTION_GLOBAL.
   * @link http://corrigesduweb.com/popups/meta-distribution.htm
   * @param string $distribution <p>
   * Portée de la distribution de la page. Les choix possibles sont :<br/>
   * DISTRIBUTION_GLOBAL<br/>
   * DISTRIBUTION_LOCALE<br/>
   * Si la valeur n'est pas initialisé correctement, la valeur par défaut
   * DISTRIBUTION_GLOBAL serat utilisé.
   * </p>
   */
  public function AjouteMetaDistribution(
    $distribution = GabaritXhtml::DISTRIBUTION_GLOBAL)
  {
    if($distribution != $this::DISTRIBUTION_GLOBAL
    && $distribution != $this::DISTRIBUTION_LOCALE)
    {
      $distribution = $this::DISTRIBUTION_GLOBAL;
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $distribution;

    $this->metaDistribution->appendChild($attrContent);

    $this->elementHead->appendChild($this->metaDistribution);
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
   * @param string $langue <p>
   * facultatif</p>
   * @todo Gérer multiples meta keywords
   */
  public function AjouteMetaKeywords($motsClefs, $langue=false)
  {
    $motsClefs = strval($motsClefs);

    if(strlen($motsClefs) > 1000)
    {
      $motsClefs = substr($motsClefs, 0, 1000);
    }

    $attrContent = $this->document->createAttribute('content');
    $attrContent->value = $motsClefs;

    $this->metaKeywords->appendChild($attrContent);

    if($langue)
    {
      $langue = strval($langue);
      $attrLang = $this->document->createAttribute('lang');
      $attrLang->value = $langue;

      $this->metaKeywords->appendChild($attrLang);
    }

    $this->elementHead->appendChild($this->metaKeywords);
  }

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
   * @param string $langue
   */
  public function SetLang($langue)
  {
    $this->attrLang->value = $langue;
  }

}