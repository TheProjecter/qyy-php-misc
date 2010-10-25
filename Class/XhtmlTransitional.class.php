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

// TODO: créer des controles de chaines pour ID, NMTOKEN, etc.

/**
 * Description of XhtmlTransitional
 *
 * @author utilisateur
 */
class XhtmlTransitional {

  /**
   * Crée une balise "meta" en fonction du DOMDocument fournit, et la retourne
   * sous la forme d'un DOMElement<br/>
   * Les attributs sont ajouté par ordre alphabétique dans la balise.<br/>
   * Section DTD :
   * <code>
   *   <!-- generic metainformation -->
   *   <!ELEMENT meta EMPTY>
   *   <!ATTLIST meta
   *     %i18n;
   *     id          ID             #IMPLIED
   *     http-equiv  CDATA          #IMPLIED
   *     name        CDATA          #IMPLIED
   *     content     CDATA          #REQUIRED
   *     scheme      CDATA          #IMPLIED
   *     >
   * </code>
   * Section DTD "i18n" :
   * <code>
   *   <!-- internationalization attributes
   *    lang        language code (backwards compatible)
   *     xml:lang    language code (as per XML 1.0 spec)
   *     dir         direction for weak/neutral text
   *   -->
   *   <!ENTITY % i18n
   *    "lang        %LanguageCode; #IMPLIED
   *     xml:lang    %LanguageCode; #IMPLIED
   *     dir         (ltr|rtl)      #IMPLIED"
   *     >
   * </code>
   * @link http://bernard.quevillier.pagesperso-orange.fr/toposnew/meta.htm
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd
   * @param DOMDocument $document <p>
   * Le DOMDocument auquel sera ajouté la "meta".
   * </p>
   * @param string $content <p>
   * CDATA Requis.
   * </p>
   * @param string $name <p>
   * CDATA implicite.
   * </p>
   * @param string $httpEquiv <p>
   * CDATA implicite.
   * </p>
   * @param string $i18nLang <p>
   * Internationalisation : le code language comme définit dans la [RFC3066]
   * </p>
   * @param string $i18nDir <p>
   * Internationalisation : Sens de l'écriture<br/>
   * 'ltr' : de gauche à droite<br/>
   * 'rtl' : de droite à gauche<br/>
   * </p>
   * @param string $scheme <p>
   * CDATA implicite.
   * </p>
   * @param string $id <p>
   * ID implicite.
   * </p>
   * @return DOMElement La balise "meta" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public static function CreeMeta(
    $document,
    $content,
    $name=null,
    $httpEquiv=null,
    $i18nLang=null,
    $i18nDir=null,
    $scheme=null,
    $id=null)
  {
    $meta = $document->createElement('meta');
    
    $attr = $document->createAttribute('content');
    $attr->value = $content;
    $meta->appendChild($attr);

    if(!is_null($i18nDir) && ($i18nDir == 'ltr' || $i18nDir == 'rtl'))
    {
      $attr = $document->createAttribute('dir');
      $attr->value = $i18nDir;
      $meta->appendChild($attr);
    }

    if(!is_null($httpEquiv))
    {
      $attr = $document->createAttribute('http-equiv');
      $attr->value = $httpEquiv;
      $meta->appendChild($attr);
    }

    if(!is_null($id))
    {
      $attr = $document->createAttribute('id');
      $attr->value = $id;
      $meta->appendChild($attr);
    }

    if(!is_null($i18nLang))
    {
      $attr = $document->createAttribute('lang');
      $attr->value = $i18nLang;
      $meta->appendChild($attr);
    }
    
    if(!is_null($name))
    {
      $attr = $document->createAttribute('name');
      $attr->value = $name;
      $meta->appendChild($attr);
    }

    if(!is_null($scheme))
    {
      $attr = $document->createAttribute('scheme');
      $attr->value = $scheme;
      $meta->appendChild($attr);
    }
    
    return $meta;
  }

  /**
   * Crée une balise "link" en fonction du DOMDocument fournit, et la retourne
   * sous la forme d'un DOMElement<br/>
   * Les attributs sont ajouté par ordre alphabétique dans la balise.<br/>
   * Section DTD :
   * <code>
   *   <!--
   *     Relationship values can be used in principle:
   *
   *      a) for document specific toolbars/menus when used
   *         with the link element in document head e.g.
   *           start, contents, previous, next, index, end, help
   *      b) to link to a separate style sheet (rel="stylesheet")
   *      c) to make a link to a script (rel="script")
   *      d) by stylesheets to control how collections of
   *         html nodes are rendered into printed documents
   *      e) to make a link to a printable version of this document
   *         e.g. a PostScript or PDF version (rel="alternate" media="print")
   *   -->
   *
   *   <!ELEMENT link EMPTY>
   *   <!ATTLIST link
   *     %attrs;
   *     charset     %Charset;      #IMPLIED
   *     href        %URI;          #IMPLIED
   *     hreflang    %LanguageCode; #IMPLIED
   *     type        %ContentType;  #IMPLIED
   *     rel         %LinkTypes;    #IMPLIED
   *     rev         %LinkTypes;    #IMPLIED
   *     media       %MediaDesc;    #IMPLIED
   *     target      %FrameTarget;  #IMPLIED
   *     >
   * </code>
   * Section DTD "attrs" :
   * <code>
   *   <!ENTITY % attrs "%coreattrs; %i18n; %events;">
   * </code>
   * Section DTD "i18n" :
   * <code>
   *   <!-- internationalization attributes
   *    lang        language code (backwards compatible)
   *     xml:lang    language code (as per XML 1.0 spec)
   *     dir         direction for weak/neutral text
   *   -->
   *   <!ENTITY % i18n
   *    "lang        %LanguageCode; #IMPLIED
   *     xml:lang    %LanguageCode; #IMPLIED
   *     dir         (ltr|rtl)      #IMPLIED"
   *     >
   * </code>
   * Section DTD "coreattrs" :
   * <code>
   *   <!-- core attributes common to most elements
   *     id       document-wide unique id
   *     class    space separated list of classes
   *     style    associated style info
   *     title    advisory title/amplification
   *   -->
   *   <!ENTITY % coreattrs
   *    "id          ID             #IMPLIED
   *     class       CDATA          #IMPLIED
   *     style       %StyleSheet;   #IMPLIED
   *     title       %Text;         #IMPLIED"
   *     >
   * </code>
   * @todo Gérer events
   * @link http://bernard.quevillier.pagesperso-orange.fr/toposnew/link.htm
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd
   * @param DOMDocument $document <p>
   * Le DOMDocument auquel sera ajouté la "meta".
   * </p>
   * @param string $href <p>
   * une Uniform Resource Identifier, voir la [RFC2396] (rendu obsolete par
   * la [RFC3986]).
   * </p>
   * @param string $rel <p>
   * Liste de types de liens de séparées par des espaces.
   * </p>
   * @param string $type <p>
   * Type de média, selon la [RFC2045].
   * </p>
   * @param string $media <p>
   * Descripteur de média seul ou en liste séparées par des virgules.
   * </p>
   * @param string $charset <p>
   * Un encodage de caractères, selon la [RFC2045].
   * </p>
   * @param string $target <p>
   * Rendre dans ce cadre (cette frame).
   * </p>
   * @param string $hreflang <p>
   * Langue de la ressource pointé dans "href" avec un code language comme
   * définit dans la [RFC3066].
   * </p>
   * @param string $rev <p>
   * Liste de types de liens de séparées par des espaces.
   * </p>
   * @param string $i18nLang <p>
   * Internationalisation : le code language comme définit dans la [RFC3066]
   * </p>
   * @param string $i18nDir <p>
   * Internationalisation : Sens de l'écriture<br/>
   * 'ltr' : de gauche à droite<br/>
   * 'rtl' : de droite à gauche<br/>
   * </p>
   * @param string $title <p>
   * Utilisé pour les titres, etc.
   * </p>
   * @param string $id <p>
   * ID implicite.
   * </p>
   * @param string $class <p>
   * CDATA implicite.
   * </p>
   * @param string $style <p>
   * Données de feuille de style
   * </p>
   * @return DOMElement La balise "link" sous la forme d'une nouvelle instance
   * de la class DOMElement ou false si une erreur se produit.
   */
  public static function Creelink(
    $document,
    $href = null,
    $rel = null,
    $type = null,
    $media = null,
    $charset = null,
    $target = null,
    $hreflang = null,
    $rev = null,
    $i18nLang = null,
    $i18nDir = null,
    $title = null,
    $id = null,
    $class = null,
    $style = null)
  {
    $link = $document->createElement('meta');

    if(!is_null($charset))
    {
      $attr = $document->createAttribute('charset');
      $attr->value = $charset;
      $link->appendChild($attr);
    }

    if(!is_null($class))
    {
      $attr = $document->createAttribute('class');
      $attr->value = $class;
      $link->appendChild($attr);
    }

    if(!is_null($i18nDir))
    {
      $attr = $document->createAttribute('dir');
      $attr->value = $i18nDir;
      $link->appendChild($attr);
    }

    if(!is_null($href))
    {
      $attr = $document->createAttribute('href');
      $attr->value = $href;
      $link->appendChild($attr);
    }

    if(!is_null($hreflang))
    {
      $attr = $document->createAttribute('hreflang');
      $attr->value = $hreflang;
      $link->appendChild($attr);
    }

    if(!is_null($id))
    {
      $attr = $document->createAttribute('id');
      $attr->value = $id;
      $link->appendChild($attr);
    }

    if(!is_null($i18nLang))
    {
      $attr = $document->createAttribute('lang');
      $attr->value = $i18nLang;
      $link->appendChild($attr);
    }

    if(!is_null($media))
    {
      $attr = $document->createAttribute('media');
      $attr->value = $media;
      $link->appendChild($attr);
    }

    if(!is_null($rel))
    {
      $attr = $document->createAttribute('rel');
      $attr->value = $rel;
      $link->appendChild($attr);
    }

    if(!is_null($rev))
    {
      $attr = $document->createAttribute('rev');
      $attr->value = $rev;
      $link->appendChild($attr);
    }

    if(!is_null($style))
    {
      $attr = $document->createAttribute('style');
      $attr->value = $style;
      $link->appendChild($attr);
    }

    if(!is_null($target))
    {
      $attr = $document->createAttribute('target');
      $attr->value = $target;
      $link->appendChild($attr);
    }

    if(!is_null($title))
    {
      $attr = $document->createAttribute('title');
      $attr->value = $title;
      $link->appendChild($attr);
    }

    if(!is_null($type))
    {
      $attr = $document->createAttribute('type');
      $attr->value = $type;
      $link->appendChild($attr);
    }

    return $link;
  }

  /**
   * Convertit toutes les entités déclarées dans la DTD XHTML Transitional en
   * entités Unicode. Si c'est pas triste de devoir en arriver là...<br/>
   * Section DTD :
   * <code>
   *   <!--================ Character mnemonic entities =========================-->
   *
   *   <!ENTITY % HTMLlat1 PUBLIC
   *      "-//W3C//ENTITIES Latin 1 for XHTML//EN"
   *      "xhtml-lat1.ent">
   *   %HTMLlat1;
   *
   *   <!ENTITY % HTMLsymbol PUBLIC
   *      "-//W3C//ENTITIES Symbols for XHTML//EN"
   *      "xhtml-symbol.ent">
   *   %HTMLsymbol;
   *
   *   <!ENTITY % HTMLspecial PUBLIC
   *      "-//W3C//ENTITIES Special for XHTML//EN"
   *      "xhtml-special.ent">
   *   %HTMLspecial;
   * </code>
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml-lat1.ent
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml-symbol.ent
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml-special.ent
   * @param string $chaine <p>
   * Une chaine contenant des entités déclarées dans la DTD XHTML Transitional
   * </p>
   * @return string La chaine fournit dont les entités déclarées dans la DTD 
   * XHTML Transitional ont été convertis en entités Unicode.
   */
  static function ConvertieEntiteVersUnicode($chaine)
  {
    $unicode = array(
      '&#34;','&#38;','&#60;','&#62;','&#39;','&#338;','&#339;','&#352;',
      '&#353;','&#376;','&#710;','&#732;','&#8194;','&#8195;','&#8201;',
      '&#8204;','&#8205;','&#8206;','&#8207;','&#8211;','&#8212;','&#8216;',
      '&#8217;','&#8218;','&#8220;','&#8221;','&#8222;','&#8224;','&#8225;',
      '&#8240;','&#8249;','&#8250;','&#8364;','&#160;','&#161;','&#162;',
      '&#163;','&#164;','&#165;','&#166;','&#167;','&#168;','&#169;','&#170;',
      '&#171;','&#172;','&#173;','&#174;','&#175;','&#176;','&#177;','&#178;',
      '&#179;','&#180;','&#181;','&#182;','&#183;','&#184;','&#185;','&#186;',
      '&#187;','&#188;','&#189;','&#190;','&#191;','&#192;','&#193;','&#194;',
      '&#195;','&#196;','&#197;','&#198;','&#199;','&#200;','&#201;','&#202;',
      '&#203;','&#204;','&#205;','&#206;','&#207;','&#208;','&#209;','&#210;',
      '&#211;','&#212;','&#213;','&#214;','&#215;','&#216;','&#217;','&#218;',
      '&#219;','&#220;','&#221;','&#222;','&#223;','&#224;','&#225;','&#226;',
      '&#227;','&#228;','&#229;','&#230;','&#231;','&#232;','&#233;','&#234;',
      '&#235;','&#236;','&#237;','&#238;','&#239;','&#240;','&#241;','&#242;',
      '&#243;','&#244;','&#245;','&#246;','&#247;','&#248;','&#249;','&#250;',
      '&#251;','&#252;','&#253;','&#254;','&#255;','&#402;','&#913;','&#914;',
      '&#915;','&#916;','&#917;','&#918;','&#919;','&#920;','&#921;','&#922;',
      '&#923;','&#924;','&#925;','&#926;','&#927;','&#928;','&#929;','&#931;',
      '&#932;','&#933;','&#934;','&#935;','&#936;','&#937;','&#945;','&#946;',
      '&#947;','&#948;','&#949;','&#950;','&#951;','&#952;','&#953;','&#954;',
      '&#955;','&#956;','&#957;','&#958;','&#959;','&#960;','&#961;','&#962;',
      '&#963;','&#964;','&#965;','&#966;','&#967;','&#968;','&#969;','&#977;',
      '&#978;','&#982;','&#8226;','&#8230;','&#8242;','&#8243;','&#8254;',
      '&#8260;','&#8472;','&#8465;','&#8476;','&#8482;','&#8501;','&#8592;',
      '&#8593;','&#8594;','&#8595;','&#8596;','&#8629;','&#8656;','&#8657;',
      '&#8658;','&#8659;','&#8660;','&#8704;','&#8706;','&#8707;','&#8709;',
      '&#8711;','&#8712;','&#8713;','&#8715;','&#8719;','&#8721;','&#8722;',
      '&#8727;','&#8730;','&#8733;','&#8734;','&#8736;','&#8743;','&#8744;',
      '&#8745;','&#8746;','&#8747;','&#8756;','&#8764;','&#8773;','&#8776;',
      '&#8800;','&#8801;','&#8804;','&#8805;','&#8834;','&#8835;','&#8836;',
      '&#8838;','&#8839;','&#8853;','&#8855;','&#8869;','&#8901;','&#8968;',
      '&#8969;','&#8970;','&#8971;','&#9001;','&#9002;','&#9674;','&#9824;',
      '&#9827;','&#9829;','&#9830;'
    );
 
    $entite = array(
      '&quot;','&amp;','&lt;','&gt;','&apos;','&OElig;','&oelig;','&Scaron;',
      '&scaron;','&Yuml;','&circ;','&tilde;','&ensp;','&emsp;','&thinsp;',
      '&zwnj;','&zwj;','&lrm;','&rlm;','&ndash;','&mdash;','&lsquo;','&rsquo;',
      '&sbquo;','&ldquo;','&rdquo;','&bdquo;','&dagger;','&Dagger;','&permil;',
      '&lsaquo;','&rsaquo;','&euro;','&nbsp;','&iexcl;','&cent;','&pound;',
      '&curren;','&yen;','&brvbar;','&sect;','&uml;','&copy;','&ordf;',
      '&laquo;','&not;','&shy;','&reg;','&macr;','&deg;','&plusmn;','&sup2;',
      '&sup3;','&acute;','&micro;','&para;','&middot;','&cedil;','&sup1;',
      '&ordm;','&raquo;','&frac14;','&frac12;','&frac34;','&iquest;','&Agrave;',
      '&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;',
      '&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;',
      '&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;',
      '&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;',
      '&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;',
      '&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;',
      '&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;',
      '&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;',
      '&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;',
      '&fnof;','&Alpha;','&Beta;','&Gamma;','&Delta;','&Epsilon;','&Zeta;',
      '&Eta;','&Theta;','&Iota;','&Kappa;','&Lambda;','&Mu;','&Nu;','&Xi;',
      '&Omicron;','&Pi;','&Rho;','&Sigma;','&Tau;','&Upsilon;','&Phi;','&Chi;',
      '&Psi;','&Omega;','&alpha;','&beta;','&gamma;','&delta;','&epsilon;',
      '&zeta;','&eta;','&theta;','&iota;','&kappa;','&lambda;','&mu;','&nu;',
      '&xi;','&omicron;','&pi;','&rho;','&sigmaf;','&sigma;','&tau;',
      '&upsilon;','&phi;','&chi;','&psi;','&omega;','&thetasym;','&upsih;',
      '&piv;','&bull;','&hellip;','&prime;','&Prime;','&oline;','&frasl;',
      '&weierp;','&image;','&real;','&trade;','&alefsym;','&larr;','&uarr;',
      '&rarr;','&darr;','&harr;','&crarr;','&lArr;','&uArr;','&rArr;','&dArr;',
      '&hArr;','&forall;','&part;','&exist;','&empty;','&nabla;','&isin;',
      '&notin;','&ni;','&prod;','&sum;','&minus;','&lowast;','&radic;','&prop;',
      '&infin;','&ang;','&and;','&or;','&cap;','&cup;','&int;','&there4;',
      '&sim;','&cong;','&asymp;','&ne;','&equiv;','&le;','&ge;','&sub;','&sup;',
      '&nsub;','&sube;','&supe;','&oplus;','&otimes;','&perp;','&sdot;',
      '&lceil;','&rceil;','&lfloor;','&rfloor;','&lang;','&rang;','&loz;',
      '&spades;','&clubs;','&hearts;','&diams;'
    );

    $chaine = str_replace($entite, $unicode, $chaine);

    //$chaine = str_ireplace($entite, $unicode, $chaine);

    return $chaine;
  }
}