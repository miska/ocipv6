<?php
/**
 * ownCloud - IPv6
 *
 */

namespace OCA\IPv6\Controller;
      
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\Config;
use OCP\IL10N;
use OCP\IRequest;

class AdminController extends Controller {
      private $L10N;

      public function __construct ($AppName, IRequest $Request, IL10N $L10N) {
          parent::__construct($AppName, $Request);

          $this->L10N = $L10N;
      }

      /**
       * @AdminRequired
       * @NoCSRFRequired
       */
      public function GetTeredo () {
            \OCP\JSON::setContentTypeHeader ('application/json');

            exec("sudo systemctl status -n 0 miredo-client", $output, $ret);
            foreach($output as $i) {
                if(preg_match('/Active: active/', $i)) {
                     return new JSONResponse(Array('enabled' => 1));
                }
            }
            return new JSONResponse(Array('enabled' => 0));
      }

      /**
       * @AdminRequired
       * @NoCSRFRequired
       */
      public function EnableTeredo () {
          system("sudo systemctl enable miredo-client");
          system("sudo systemctl start miredo-client");

          return $this->GetTeredo();
      }

       /**
       * @AdminRequired
       * @NoCSRFRequired
       */
      public function DisableTeredo () {
          system("sudo systemctl disable miredo-client");
          system("sudo systemctl stop miredo-client");

          return $this->GetTeredo();
      }
     
      /**
       * @NoAdminRequired
       * @NoCSRFRequired
       */
      public function GetIPv6 () {
          \OCP\JSON::setContentTypeHeader ('application/json');

          # exec("ip -6 a s | sed -n 's|.*inet6\ \([23][0-9a-f:]*\)/[0-9]*\ scope\ global.*|\1|p'", $output, $ret);
          exec("ip -6 a s", $output, $ret);
          $ipv6 = [];
          foreach($output as $i) {
              if(preg_match('/inet6 ([23][0-9a-f\:]+)/', $i, $match)) {
                  $ipv6[] = $match[1];
              }
          }

          return new JSONResponse (Array ('ipv6' => $ipv6));
      }
}
