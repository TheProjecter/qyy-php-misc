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

// DOC: Zvon - DTD Tutorial
// http://zvon.org/xxl/DTDTutorial/General_fre/contents.html

// DOC: W3C Systems Team Blog - W3C's Excessive DTD Traffic
// http://www.w3.org/blog/systeam/2008/02/08/w3c_s_excessive_dtd_traffic
// Voilà pourquoi on ne peut pas utiliser DOMDocument::validate() de merde :
// Cette connerie de PHP pouris va chercher la DTD systématiquement créant un
// DDOS chez le W3C qui bloque tout !

// PROGRESS: Commentaires
// PROGRESS: Gestion d'ajout des Styles
// PROGRESS: Aller se documenter dans les RFC/W3C pour les metas et le reste

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
class GabaritXhtmlTransitional
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

  /**
   *
   * @param string $titre
   * @param string $langue
   */
  function __construct(
    $titre,
    $langue='fr-fr')
    //$typeDTD = GabaritXhtml::TYPE_DTD_XHTML_TRANSITIONAL)
  {
    $titre = strval($titre);
    $langue = strval($langue);

//    if($typeDTD != $this::TYPE_DTD_XHTML_TRANSITIONAL
//    || $typeDTD != $this::TYPE_DTD_XHTML_STRICT)
//    {
//      $typeDTD = $this::TYPE_DTD_XHTML_TRANSITIONAL;
//    }
    $typeDTD = $this::TYPE_DTD_XHTML_TRANSITIONAL;

    $this->implementation = new DOMImplementation();

    $this->dtd =
      $this->implementation->createDocumentType
      (
        'html',                                     // qualifiedName
        '-//W3C//DTD XHTML 1.0 '.$typeDTD.'//EN',   // publicId
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-'
          .strtolower($typeDTD).'.dtd'              // systemId
      );

    $this->document = $this->implementation->createDocument('', '', $this->dtd);

    $this->init($titre, $langue);
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
   * Crée une balise "meta" "author" informant sur le ou les auteurs, l'ajoute
   * dans l'entête du gabarit et la retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-author.htm
   * @param string $auteurs <p>
   * Prénom en minuscules, puis nom en majuscules ('Prénom NOM').
   * Les auteurs multiples doivent êtres séparés d'une virgule.
   * </p>
   * @param string $i18nLang <p>
   * Internationalisation : le code language comme définit dans la [RFC 3066]
   * </p>
   * @param string $i18nDir <p>
   * Internationalisation : Sens de l'écriture<br/>
   * 'ltr' : de gauche à droite<br/>
   * 'rtl' : de droite à gauche<br/>
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaAuthor($auteurs, $i18nLang=null, $i18nDir=null)
  {
    $auteurs = strval($auteurs);

    if(!is_null($i18nLang))
    {
      $i18nLang = strval($i18nLang);
    }

    if(!is_null($i18nDir))
    {
      $i18nDir = strval($i18nDir);
    }

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $auteurs,        // content
      'author',        // name
      null,            // http-equiv
      $i18nLang,       // lang
      $i18nDir         // dir
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "category" qui sert à indiquer les catégories dans
   * lesquelles rentre le site, l'ajoute dans l'entête du gabarit et la retourne
   * sous forme de DOMElement.
   * @todo catégories assisté
   * @link http://corrigesduweb.com/popups/meta-category.htm
   * @param string $categories <p>
   * Liste des catégories séparées par une virgule.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaCategory($categories)
  {
    $categories = strval($categories);

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $categories,     // content
      'category'       // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "copyright" qui sert à indiquer le ou les copyright
   * attenant au contenu de la page, l'ajoute dans l'entête du gabarit et la
   * retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-copyright.htm
   * @param string $copyright <p>
   * Le ou les mentions de copyright. En cas de mentions multiples, les séparer
   * par une virgule.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaCopyright($copyright)
  {
    $copyright = strval($copyright);

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $copyright,      // content
      'copyright'      // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée un balise "meta" "Date-Creation-yyyymmdd" informant sur la date à
   * laquelle la page a été créé (et non pas généré), l'ajoute dans l'entête du
   * gabarit et la retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-creation.htm
   * @param DateTime $dateCreation <p>
   * Date de la création de la page. Si le format fournit est incorecte, le
   * DateTime récupéré sera celui de la génération de la page ('now').
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaDateCreationYyyymmdd($dateCreation)
  {
    if(!is_object($dateCreation) || !is_a($dateCreation, 'DateTime'))
    {
      $dateCreation = new DateTime('now');
    }

    $dateCreation = $dateCreation->format('dmY');

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document,         // DOMDocument
      $dateCreation,           // content
      'Date-Creation-yyyymmdd' // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "Date-Revision-yyyymmdd" informant sur la date à
   * laquelle le contenu de la page a été modifié pour la dernière fois,
   * l'ajoute dans l'entête du gabarit et la retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-revision.htm
   * @param DateTime $dateRevision <p>
   * Date de la dernière révision (denière modification du contenu) de la page.
   * Si le format fournit est incorecte, le DateTime récupéré sera celui de la
   * génération de la page ('now').
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaDateRevisionYyyymmdd($dateRevision)
  {
    if(!is_object($dateRevision) || !is_a($dateRevision, 'DateTime'))
    {
      $dateRevision = new DateTime('now');
    }

    $dateRevision = $dateRevision->format('dmY');

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document,         // DOMDocument
      $dateRevision,           // content
      'Date-Revision-yyyymmdd' // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "description" qui doit contenir une description de
   * la page (et non du site), l'ajoute dans l'entête du gabarit juste après la
   * balise "title" et la retourne sous forme de DOMElement.
   * @todo Améliorer les tests sur la chaine de description
   * @todo Vérifier si y'a pas une question de i18n sur la description
   * @link http://corrigesduweb.com/popups/meta-description.htm
   * @param string $description <p>
   * La description doit faire 200 caractères maximum. Si la chaine fournie est
   * plus longue, elle serat tronqué. Les sauts de ligne ne sont pas permit.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaDescription($description)
  {
    $description = strval($description);

    if(strlen($description) > 200)
    {
      $description = substr($description, 0, 200);
    }

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $description,    // content
      'description'    // name
    );

    // On insert la meta juste après le titre
    // DOC: http://fr2.php.net/manual/fr/domnode.insertbefore.php#90833
    if($this->elementTitle->nextSibling)
    {
      $this->elementTitle->parentNode->insertBefore(
        $meta,
        $this->elementTitle->nextSibling
      );
    }
    else
    {
      $this->elementTitle->parentNode->appendChild($meta);
    }

    return $meta;
  }

  /**
   * Crée une balise "meta" "distribution" qui indique la portée de la
   * distribution de la page, l'ajoute dans l'entête du gabarit et la retourne
   * sous forme de DOMElement.<br/>
   * La valeur par défaut est GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL.
   * @link http://corrigesduweb.com/popups/meta-distribution.htm
   * @param string $distribution <p>
   * Portée de la distribution de la page. Les choix possibles sont :<br/>
   * GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL<br/>
   * GabaritXhtmlTransitional::DISTRIBUTION_LOCALE<br/>
   * Si la valeur n'est pas initialisé correctement, la valeur par défaut
   * GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL serat utilisé.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaDistribution(
    $distribution = GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL)
  {
    if($distribution != GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL
    && $distribution != GabaritXhtmlTransitional::DISTRIBUTION_LOCALE)
    {
      $distribution = GabaritXhtmlTransitional::DISTRIBUTION_GLOBAL;
    }

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $distribution,   // content
      'distribution'   // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "expires" qui indique la date d'expiration de la
   * page (à priori, la date à laquelle la page ne sera donc plus
   * disponible), l'ajoute dans l'entête du gabarit et la retourne
   * sous forme de DOMElement.<br/>
   * Si le paramètre d'expiration n'est pas renseigné, la valeur 'never' est
   * affecté par défaut (la page n'expire jamais).
   * @link http://corrigesduweb.com/popups/meta-expires.htm
   * @param DateTime $expiration <p>
   * La date d'expiration de la page. Si le format est incorecte, la valeur
   * 'never' sera attribué par défaut.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
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

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $expiration,     // content
      'expires'        // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "generator" qui sert à indiquer le nom du logiciel
   * qui à généré la page, l'ajoute dans l'entête du gabarit et la retourne
   * sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-generator.htm
   * @param string $generateur <p>
   * Le nom du générateur de la page.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaGenerator($generateur)
  {
    $generateur = strval($generateur);

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $generateur,     // content
      'generator'      // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "identifier-url" qui sert à indiquer l'url de la
   * porte d'entrée du site web, l'ajoute dans l'entête du gabarit et la
   * retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-url.htm
   * @param string $site <p>
   * L'url de la porte d'entrée du site web.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaIdentifierUrl($url)
  {
    $url = strval($url);

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $url,            // content
      'identifier-url' // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "keywords" contenant les mots clef facilitant
   * l'indexation de la page, l'ajoute dans l'entête du gabarit et la
   * retourne sous forme de DOMElement.<br/>
   * Les moteurs de recherche ne prennent que rarement en compte plus de 400
   * caractères, et il est préférable de ne pas dépasser 100 mots clef ainsi que
   * d'éviter les répétitions de mots similaires.
   * @link http://corrigesduweb.com/popups/meta-keywords.htm
   * @param string $motsClefs <p>
   * La chaine de mot clefs spéraré par des virgules, limité à 1000 caractères
   * espaces compris. Pour cette raison, éviter de mettre des espaces avant et
   * après les virgules.<br/>
   * Les saut de lignes ne sonts pas permis, et si la chaine dépasse 1000
   * caractères, elle sera tronqué.
   * </p>
   * @param string $i18nLang <p>
   * Internationalisation : le code language comme définit dans la [RFC 3066]
   * </p>
   * @param string $i18nDir <p>
   * Internationalisation : Sens de l'écriture<br/>
   * 'ltr' : de gauche à droite<br/>
   * 'rtl' : de droite à gauche<br/>
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaKeywords($motsClefs, $i18nLang=null, $i18nDir=null)
  {
    $motsClefs = strval($motsClefs);

    if(strlen($motsClefs) > 1000)
    {
      $motsClefs = substr($motsClefs, 0, 1000);
    }

    if(!is_null($i18nLang))
    {
      $i18nLang = strval($i18nLang);
    }

    if(!is_null($i18nDir))
    {
      $i18nDir = strval($i18nDir);
    }

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $motsClefs,      // content
      'keywords',      // name
      null,            // http-equiv
      $i18nLang,       // lang
      $i18nDir         // dir
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "reply-to" informant sur l'adresse e-mail principale
   * du site, l'ajoute dans l'entête du gabarit et la retourne sous forme de
   * DOMElement.<br/>
   * Cette adresse est systématiquement collecté par les spammers.
   * @link http://corrigesduweb.com/popups/meta-reply.htm
   * @param string $email <p>
   * L'adresse e-mail principale du site
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteMetaReplyTo($email)
  {
    $email = strval($email);

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document, // DOMDocument
      $email,          // content
      'reply-to'       // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "revisit-after" informant la fréquence à laquelle
   * les moteurs de recherche doivent revisiter le site, l'ajoute dans l'entête
   * du gabarit et la retourne sous forme de DOMElement.
   * @link http://corrigesduweb.com/popups/meta-revisit.htm
   * @param integer $unite <p>
   * L'unité de fréquence à laquelle les moteurs de recherche doivent
   * revisiter le site. Si la valeur n'est pas renseigné correctement ou
   * est à 0, elle sera initialisé à 1
   * </p>
   * @param string $frequence <p>
   * Valeurs acceptés : 'days' (jours), 'weeks' (semaines) ou 'month' (mois).
   * Si la valeur n'est pas renseigné correctement, 'days' sera utilisé.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
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

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document,       // DOMDocument
      $unite.' '.$frequence, // content
      'revisit-after'        // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "meta" "robots" informant les moteurs de recherche sur
   * l'utilité d'indexer la page ou de suivre les liens, l'ajoute dans l'entête
   * du gabarit et la retourne sous forme de DOMElement.<br/>
   * Si la balise n'est pas présente, l'instruction par défaut est d'indexer la
   * page et de suivre les liens.
   * @link http://corrigesduweb.com/popups/meta-robots.htm
   * @param boolean $indexer <p>
   * true = indexer la page, false = ne pas indexer la page
   * </p>
   * @param boolean $suivre <p>
   * true = suivre les liens, false= ne pas suivre les liens
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
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

    $meta = XhtmlTransitional::CreeMeta
    (
      $this->document,      // DOMDocument
      $indexer.','.$suivre, // content
      'robots'              // name
    );

    $this->elementHead->appendChild($meta);

    return $meta;
  }

  /**
   * Crée une balise "link" "stylesheet" faisant référence à une feuille de
   * style, l'ajoute dans l'entête du gabarit et la retourne sous forme de
   * DOMMElement.
   * @link http://bernard.quevillier.pagesperso-orange.fr/toposnew/link.htm
   * @param string $href <p>
   * une Uniform Resource Identifier, voir la [RFC2396] (rendu obsolete par
   * la [RFC3986]).
   * </p>
   * @param string $media <p>
   * Descripteur de média seul ou en liste séparées par des virgules.
   * </p>
   * @return DOMElement La balise "link" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public function AjouteLinkCss($href, $media=null)
  {
    $href  = strval($href);

    if (!is_null($media))
    {
      $media = strval($media);
    }
    
    $link = XhtmlTransitional::Creelink(
      $this->document, // DOMDocument
      $href,           // href
      'stylesheet',    // rel
      'text/css',      // type
      $media           // media
      //$charset=null  // TODO: Charset CSS ?
    );

    $this->elementHead->appendChild($link);

    return $link;
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

  /**
   *
   * @return DOMElement
   */
  public function GetElementHtml()
  {
    return $this->elementHtml;
  }

  /**
   *
   * @return DOMElement
   */
  public function GetElementHead()
  {
    return $this->elementHead;
  }

  /**
   *
   * @return DOMElement
   */
  public function GetElementBody()
  {
    return $this->elementBody;
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

  /**
   *
   * @param string $xhtml <p>
   * Le corp de la page au format XHTML Transitional valide
   * </p>
   * @return mixed true si l'opération s'est correctement exectué, une exception
   * dans le cas contraire.
   */
  public function SetBody($xhtml)
  {
    try
    {
      // HACK: J'ai pas trouvé d'autre moyen pour importer du XML en chaine...
      $simpleXmlElement = new SimpleXMLElement(
                            XhtmlTransitional::ConvertieEntiteVersUnicode(
                              $xhtml
                            )
                          );
      $domElement = dom_import_simplexml($simpleXmlElement);
      
      $domElement = $this->document->importNode($domElement, true);

      $this->elementBody->appendChild($domElement);

      return true;
    }
    catch (Exception $ex)
    {
      return $ex;
    }
  }

// TODO: meta 'http-equiv' généré auto. par rapport header http
//
//  /**
//   * Ajoute la balise "meta" "Content-Language" qui sert à indiquer la langue
//   * de rédaction du contenu de la page.
//   * @link http://corrigesduweb.com/popups/meta-language.htm
//   * @param string $langue <p>
//   * La langue de rédaction du contenu de la page sur deux lettres.
//   * </p>
//   */
//  public function AjouteMetaContentLanguage($langue = 'fr')
//  {
//    $langue = strval($langue);
//
//    $attrContent = $this->document->createAttribute('content');
//    $attrContent->value = $langue;
//
//    $this->metaContentLanguage->appendChild($attrContent);
//
//    $this->elementHead->appendChild($this->metaContentLanguage);
//  }

}