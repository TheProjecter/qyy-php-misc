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
 * Headers
 *
 * @author Qyy
 */
class Headers {

  /**
   * Content-Types attendus<br/>
   * Exemple :
   * <code>
   *   Accept: text/plain
   * </code>
   */
  const REQUEST_ACCEPT
    = 'Accept';

  /**
   * Les jeux de caractères attendus<br/>
   * Exemple :
   * <code>
   *   Accept-Charset: utf-8
   * </code>
   */
  const REQUEST_ACCEPT_CHARSET
    = 'Accept-Charset';

  /**
   * Encodages attendus<br/>
   * Exemple :
   * <code>
   *   Accept-Encoding: <compress | gzip | identity>
   * </code>
   */
  const REQUEST_ACCEPT_ENCODING
    = 'Accept-Encoding';

  /**
   * Langues attendus pour la réponse<br/>
   * Exemple :
   * <code>
   *   Accept-Language: en-US
   * </code>
   */
  const REQUEST_ACCEPT_LANGUAGE
    = 'Accept-Language';

  /**
   * Permet au serveur d'indiquer sa plage de requete acceptable pour une
   * ressource<br/>
   * Exemple :
   * <code>
   *   Accept-Ranges: bytes
   * </code>
   */
  const REQUEST_ACCEPT_RANGES
    = 'Accept-Ranges';

  /**
   * Informations d'authentification pour l'authentification HTTP<br/>
   * Exemple :
   * <code>
   *   Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==
   * </code>
   */
  const REQUEST_AUTHORIZATION
    = 'Authorization';

  /**
   * Utilisé pour spécifier les directives qui doivent être respectées par tous
   * les mécanismes de mise en cache le long de la chaîne requetes/réponses<br/>
   * Exemple :
   * <code>
   *   Cache-Control: no-cache
   * </code>
   */
  const REQUEST_CACHE_CONTROL
    = 'Cache-Control';

  /**
   * Le type de connection préféré par le logiciel client<br/>
   * Exemple :
   * <code>
   *   Connection: close
   * </code>
   */
  const REQUEST_CONNECTION
    = 'Connection';

  /**
   * Un cookie HTTP envoyé précédemment par "Set-Cookie"<br/>
   * Exemple :
   * <code>
   *   Cookie: $Version=1; Skin=new;
   * </code>
   */
  const REQUEST_COOKIE
    = 'Cookie';

  /**
   * La longueur du corps de la requete en octets (8 bit)<br/>
   * Exemple :
   * <code>
   *   Content-Length: 348
   * </code>
   */
  const REQUEST_CONTENT_LENGTH
    = 'Content-Length';

  /**
   * Le type MIME du corps de la requete (utilisé avec les requêtes POST et
   * PUT)<br/>
   * Exemple :
   * <code>
   *   Content-Type: application/x-www-form-urlencoded
   * </code>
   */
  const REQUEST_CONTENT_TYPE
    = 'Content-Type';

  /**
   * La date et l'heure auxquelles le message a été envoyé<br/>
   * Exemple :
   * <code>
   *   Date: Tue, 15 Nov 1994 08:12:31 GMT
   * </code>
   */
  const REQUEST_DATE
    = 'Date';

  /**
   * Indique que des comportements de serveur particulier, sont requis par le
   * client<br/>
   * Exemple :
   * <code>
   *   Expect: 100-continue
   * </code>
   */
  const REQUEST_EXPECT
    = 'Expect';

  /**
   * L'adresse email de l'utilisateur qui effectue la demande<br/>
   * Exemple :
   * <code>
   *   From: user@email.com
   * </code>
   */
  const REQUEST_FROM
    = 'From';

  /**
   * Le nom de domaine du serveur (pour l'hébergement virtuel), obligatoire
   * depuis HTTP/1.1<br/>
   * Exemple :
   * <code>
   *   Host: en.wikipedia.org
   * </code>
   */
  const REQUEST_HOST
    = 'Host';

  /**
   * Ne répondre à la requete que si l'entité cliente fourni correspond à la
   * même entité sur le serveur. C'est principalement pour des méthodes telles
   * que PUT pour ne mettre à jour une ressource si elle n'a pas été modifié
   * depuis la derniere mise à jour par l'utilisateur.<br/>
   * Exemple :
   * <code>
   *   If-Match: "737060cd8c284d8af7ad3082f209582d"
   * </code>
   */
  const REQUEST_IF_MATCH
    = 'If-Match';

  /**
   * Permet à un "304 Not Modified" d'être retourné si le contenu est
   * inchangé<br/>
   * Exemple :
   * <code>
   *   If-Modified-Since: Sat, 29 Oct 1994 19:43:31 GMT
   * </code>
   */
  const REQUEST_IF_MODIFIED_SINCE
    = 'If-Modified-Since';

  /**
   * Permet à un "304 Not Modified" d'être retourné si le contenu est inchangé,
   * voir le ETag HTTP<br/>
   * Exemple :
   * <code>
   *   If-None-Match: "737060cd8c284d8af7ad3082f209582d"
   * </code>
   */
  const REQUEST_IF_NONE_MATCH
    = 'If-None-Match';

  /**
   * Si l'entité est inchangé, ne demande de renvoyer que la (les) partie(s) qui
   * manque, sinon, renvoyer l'ensemble de la nouvelle entité<br/>
   * Exemple :
   * <code>
   *   If-Range: "737060cd8c284d8af7ad3082f209582d"
   * </code>
   */
  const REQUEST_IF_RANGE
    = 'If-Range';

  /**
   * N'envoyer de réponse que si l'entité n'a pas été modifié depuis un
   * moment.<br/>
   * Exemple :
   * <code>
   *   If-Unmodified-Since: Sat, 29 Oct 1994 19:43:31 GMT
   * </code>
   */
  const REQUEST_IF_UNMODIFIED_SINCE
    = 'If-Unmodified-Since';

  /**
   * Limiter le nombre de fois où le message peut être transmis par des proxies
   * ou des passerelles.<br/>
   * Exemple :
   * <code>
   *   Max-Forwards: 10
   * </code>
   */
  const REQUEST_MAX_FORWARDS
    = 'Max-Forwards';

  /**
   * Implémentations d'entête spécifiques qui peuvent avoir des effets
   * différents n'importe où le long de la chaîne requetes/réponses.<br/>
   * Exemple :
   * <code>
   *   Pragma: no-cache
   * </code>
   */
  const REQUEST_PRAGMA
    = 'Pragma';

  /**
   * Autorisation pour une connexion à un serveur proxy.<br/>
   * Exemple :
   * <code>
   *   Proxy-Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==
   * </code>
   */
  const REQUEST_PROXY_AUTHORIZATION
    = 'Proxy-Authorization';

  /**
   * Demande une partie seulement d'une entité. les octets sont indexés à partir
   * de 0.<br/>
   * Exemple :
   * <code>
   *   Range: bytes=500-999
   * </code>
   */
  const REQUEST_RANGE
    = 'Range';

  /**
   * L'adresse de la page Web précédente à partir de laquelle un lien vers la
   * page actuellement demandée a été suivie.<br/>
   * Exemple :
   * <code>
   *   Referer: http://en.wikipedia.org/wiki/Main_Page
   * </code>
   */
  const REQUEST_REFERER
    = 'Referer';

  /**
   * Liste des encodages de transfert que le logiciel client est pret à
   * accepter : ces mêmes valeur peuvent être utilisées pour l'entête de réponse
   * "Transfer-Encoding", ainsi que la valeur "trailers" (liés à la méthode de
   * transfert fragmenté "chunked") pour indiquer au serveur qu'il accepte de
   * recevoir des en-têtes supplémentaires ("trailers") après la dernière partie
   * de taille nulle.<br/>
   * Exemple :
   * <code>
   *   TE: trailers, deflate;q=0.5
   * </code>
   */
  const REQUEST_TE
    = 'TE';

  /**
   * Demander au serveur une mise à niveau vers un autre protocole.<br/>
   * Exemple :
   * <code>
   *   Upgrade: HTTP/2.0, SHTTP/1.3, IRC/6.9, RTA/x11
   * </code>
   */
  const REQUEST_UPGRADE
    = 'Upgrade';

  /**
   * La chaîne d'identification du logiciel client utilisé pour envoyer la
   * requete<br/>
   * Exemple :
   * <code>
   *   User-Agent: Mozilla/5.0 (Linux; X11)
   * </code>
   */
  const REQUEST_USER_AGENT
    = 'User-Agent';

  /**
   * Informe le serveur sur le proxy par lequel la demande a été envoyée.<br/>
   * Exemple :
   * <code>
   *   Via: 1.0 fred, 1.1 nowhere.com (Apache/1.1)
   * </code>
   */
  const REQUEST_VIA
    = 'Via';

  /**
   * Un avertissement général concernant d'éventuels problèmes avec le corps de
   * l'entité.<br/>
   * Exemple :
   * <code>
   *   Warning: 199 Miscellaneous warning
   * </code>
   */
  const REQUEST_WARNING
    = 'Warning';

  function __construct() {
 
  }

}