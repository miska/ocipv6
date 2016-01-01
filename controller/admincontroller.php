<?php
/**
 * @author Michal Hrusecky <michal@hrusecky.net>
 *
 * @copyright Copyright (c) 2015, Michal Hrusecky
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\OCIPv6\Controller;
      
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\Config;
use OCP\IL10N;
use OCP\IRequest;
use \OCA\ocipv6\AppInfo\Application;
use \OCA\ocipv6\Service\AuthorService;


class AdminController extends Controller {
      private $L10N;

      public function __construct ($AppName, IRequest $Request, IL10N $L10N) {
          parent::__construct($AppName, $Request);

          $this->L10N = $L10N;
      }

      /**
       * @AdminRequired
       */
      public function GetDynv6() {
          \OCP\JSON::setContentTypeHeader ('application/json');
          $app = new Application();
          $c = $app->getContainer();
          $as = $c->query('OCA\OCIPv6\Service\AuthorService');
          $hostname = $as->getAppValue('hostname');
          $token = $as->getAppValue('token');
          return new JSONResponse(Array('token' => $token, 'hostname' => $hostname));
      }

      /**
       * @AdminRequired
       */
      public function SetDynv6($hostname, $token) {
          $app = new Application();
          $c = $app->getContainer();
          $as = $c->query('OCA\OCIPv6\Service\AuthorService');
          $as->setAppValue('hostname', $hostname);
          $as->setAppValue('token', $token);
          $as->setAppValue('last_ip', 'refresh');
          return $this->GetDynv6();
      }


      /**
       * @AdminRequired
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
       */
      public function EnableTeredo () {
          system("sudo systemctl enable miredo-client");
          system("sudo systemctl start miredo-client");

          return $this->GetTeredo();
      }

       /**
       * @AdminRequired
       */
      public function DisableTeredo () {
          system("sudo systemctl disable miredo-client");
          system("sudo systemctl stop miredo-client");

          return $this->GetTeredo();
      }
     
      /**
       * @NoAdminRequired
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
