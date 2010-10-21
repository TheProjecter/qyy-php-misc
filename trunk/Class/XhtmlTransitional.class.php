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
   * <!-- generic metainformation -->
   * <!ELEMENT meta EMPTY>
   * <!ATTLIST meta
   *   %i18n;
   *   id          ID             #IMPLIED
   *   http-equiv  CDATA          #IMPLIED
   *   name        CDATA          #IMPLIED
   *   content     CDATA          #REQUIRED
   *   scheme      CDATA          #IMPLIED
   *   >
   * </code>
   * @link http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd
   * @link http://www.ietf.org/rfc/rfc3066.txt
   * @param DOMDocument $document <p>
   * Requis. Le DOMDocument auquel sera ajouté la "meta".
   * </p>
   * @param string $content CDATA <p>
   * Requis.
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
   * @param string $scheme <p>
   * CDATA implicite.
   * </p>
   * @param string $id <p>
   * ID implicite.
   * </p>
   * @param string $i18nLang <p>
   * Internationalisation : Sens de l'écriture<br/>
   * 'ltr' : de gauche à droite<br/>
   * 'rtl' : de droite à gauche<br/>
   * </p>
   * @return DOMElement La balise meta sous la forme d'une nouvelle instance de
   * la class DOMElement ou false si une erreur se produit.
   */
  public static function CreeMeta(
    $document,
    $content,
    $name=null,
    $httpEquiv=null,
    $i18nLang=null,
    $scheme=null,
    $id=null,
    $i18nDir=null)
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
}