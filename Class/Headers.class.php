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

  // DOC: List of HTTP header fields
  // http://en.wikipedia.org/wiki/List_of_HTTP_header_fields

  // DOC: Liste des codes HTTP
  // http://fr.wikipedia.org/wiki/Liste_des_codes_HTTP

  // DOC: Un EXCELLENT diagrame sur les STATUS CODES !
  // http://upload.wikimedia.org/wikipedia/commons/6/65/Http-headers-status.gif

  // TODO: Rendre cette doc plus cohérente, RFC, toussa...

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

  // TODO: traduire
  /**
   * What partial content range types this server supports<br/>
   * Exemple :
   * <code>
   *   Accept-Ranges: bytes
   * </code>
   */
  const RESPONSE_ACCEPT_RANGES
    = 'Accept-Ranges';

  /**
   * The age the object has been in a proxy cache in seconds<br/>
   * Exemple :
   * <code>
   *   Age: 12
   * </code>
   */
  const RESPONSE_AGE
    = 'Age';

  /**
   * Valid actions for a specified resource. To be used for a "405 Method not
   * allowed"<br/>
   * Exemple :
   * <code>
   *   Allow: GET, HEAD
   * </code>
   */
  const RESPONSE_ALLOW
    = 'Allow';

  /**
   * Tells all caching mechanisms from server to client whether they may cache
   * this object<br/>
   * Exemple :
   * <code>
   *   Cache-Control: max-age
   * </code>
   */
  const RESPONSE_CACHE_CONTROL
    = 'Cache-Control';

  /**
   * The type of encoding used on the data<br/>
   * Exemple :
   * <code>
   *   Content-Encoding: gzip
   * </code>
   */
  const RESPONSE_CONTENT_ENCODING
    = 'Content-Encoding';

  /**
   * The language the content is in<br/>
   * Exemple :
   * <code>
   *   Content-Language: da
   * </code>
   */
  const RESPONSE_CONTENT_LANGUAGE
    = 'Content-Language';

  /**
   * The length of the response body in octets (8-bit bytes)<br/>
   * Exemple :
   * <code>
   *   Content-Length: 348
   * </code>
   */
  const RESPONSE_CONTENT_LENGTH
    = 'Content-Length';

  /**
   * An alternate location for the returned data<br/>
   * Exemple :
   * <code>
   *   Content-Location: /index.htm
   * </code>
   */
  const RESPONSE_CONTENT_LOCATION
    = 'Content-Location';

  /**
   * An opportunity to raise a "File Download" dialogue box for a known MIME
   * type<br/>
   * Exemple :
   * <code>
   *   Content-Disposition: attachment; filename=fname.ext
   * </code>
   */
  const RESPONSE_CONTENT_DISPOSITION
    = 'Content-Disposition';

  /**
   * A Base64-encoded binary MD5 sum of the content of the response<br/>
   * Exemple :
   * <code>
   *   Content-MD5: Q2hlY2sgSW50ZWdyaXR5IQ==
   * </code>
   */
  const RESPONSE_CONTENT_MD5
    = 'Content-MD5';

  /**
   * Where in a full body message this partial message belongs<br/>
   * Exemple :
   * <code>
   *   Content-Range: bytes 21010-47021/47022
   * </code>
   */
  const RESPONSE_CONTENT_RANGE
    = 'Content-Range';

  /**
   * The mime type of this content<br/>
   * Exemple :
   * <code>
   *   Content-Type: text/html; charset=utf-8
   * </code>
   */
  const RESPONSE_CONTENT_TYPE
    = 'Content-Type';

  /**
   * The date and time that the message was sent<br/>
   * Exemple :
   * <code>
   *   Date: Tue, 15 Nov 1994 08:12:31 GMT
   * </code>
   */
  const RESPONSE_DATE
    = 'Date';

  /**
   * An identifier for a specific version of a resource, often a Message Digest,
   * see ETag<br/>
   * Exemple :
   * <code>
   *   ETag: "737060cd8c284d8af7ad3082f209582d"
   * </code>
   */
  const RESPONSE_ETAG
    = 'ETag';

  /**
   * Gives the date/time after which the response is considered stale<br/>
   * Exemple :
   * <code>
   *   Expires: Thu, 01 Dec 1994 16:00:00 GMT
   * </code>
   */
  const RESPONSE_EXPIRES
    = 'Expires';

  /**
   * The last modified date for the requested object, in RFC 2822 format<br/>
   * Exemple :
   * <code>
   *   Last-Modified: Tue, 15 Nov 1994 12:45:26 GMT
   * </code>
   */
  const RESPONSE_LAST_MODIFIED
    = 'Last-Modified';

  /**
   * Used in redirection, or when a new resource has been created.<br/>
   * Exemple :
   * <code>
   *   Location: http://www.w3.org/pub/WWW/People.html
   * </code>
   */
  const RESPONSE_LOCATION
    = 'Location';

  /**
   * Implementation-specific headers that may have various effects anywhere
   * along the request-response chain.<br/>
   * Exemple :
   * <code>
   *   Pragma: no-cache
   * </code>
   */
  const RESPONSE_PRAGMA
  = 'Pragma';

  /**
   * Request authentication to access the proxy.<br/>
   * Exemple :
   * <code>
   *   Proxy-Authenticate: Basic
   * </code>
   */
  const RESPONSE_PROXY_AUTHENTICATE
    = 'Proxy-Authenticate';

  /**
   * Used in redirection, or when a new resource has been created. This refresh
   * redirects after 5 seconds. (This is a proprietary/non-standard header
   * extension introduced by Netscape and supported by most web browsers.)<br/>
   * Exemple :
   * <code>
   *   Refresh: 5; url=http://www.w3.org/pub/WWW/People.html
   * </code>
   */
  const RESPONSE_REFRESH
    = 'Refresh';

  /**
   * If an entity is temporarily unavailable, this instructs the client to try
   * again after a specified period of time.<br/>
   * Exemple :
   * <code>
   *   Retry-After: 120
   * </code>
   */
  const RESPONSE_RETRY_AFTER
    = 'Retry-After';

  /**
   * A name for the server<br/>
   * Exemple :
   * <code>
   *   Server: Apache/1.3.27 (Unix) (Red-Hat/Linux)
   * </code>
   */
  const RESPONSE_SERVER
    = 'Server';

  /**
   * an HTTP cookie<br/>
   * Exemple :
   * <code>
   *   Set-Cookie: UserID=JohnDoe; Max-Age=3600; Version=1
   * </code>
   */
  const RESPONSE_SET_COOKIE
    = 'Set-Cookie';

  /**
   * The Trailer general field value indicates that the given set of header
   * fields is present in the trailer of a message encoded with chunked
   * transfer-coding.<br/>
   * Exemple :
   * <code>
   *   Trailer: Max-Forwards
   * </code>
   */
  const RESPONSE_TRAILER
    = 'Trailer';

  /**
   * The form of encoding used to safely transfer the entity to the user.
   * Currently defined methods are: chunked, compress, deflate, gzip,
   * identity.<br/>
   * Exemple :
   * <code>
   *   Transfer-Encoding: chunked
   * </code>
   */
  const RESPONSE_TRANSFER_ENCODING
    = 'Transfer-Encoding';

  /**
   * Tells downstream proxies how to match future request headers to decide
   * whether the cached response can be used rather than requesting a fresh one
   * from the origin server.<br/>
   * Exemple :
   * <code>
   *   Vary: *
   * </code>
   */
  const RESPONSE_VARY
    = 'Vary';

  /**
   * Informs the client of proxies through which the response was sent.<br/>
   * Exemple :
   * <code>
   *   Via: 1.0 fred, 1.1 nowhere.com (Apache/1.1)
   * </code>
   */
  const RESPONSE_VIA
    = 'Via';

  /**
   * A general warning about possible problems with the entity body.<br/>
   * Exemple :
   * <code>
   *   Warning: 199 Miscellaneous warning
   * </code>
   */
  const RESPONSE_WARNING
    = 'Warning';

  /**
   * Indicates the authentication scheme that should be used to access the
   * requested entity.<br/>
   * Exemple :
   * <code>
   *   WWW-Authenticate: Basic
   * </code>
   */
  const RESPONSE_WWW_AUTHENTICATE
    = 'WWW-Authenticate';

  function __construct() {
 
  }

}