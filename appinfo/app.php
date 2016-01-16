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
?>
<?php
namespace OCA\OCIPv6\AppInfo;

//load the required files

\OCP\Util::addscript('ocipv6', 'ocipv6');

\OCP\Backgroundjob::addRegularTask('\OCA\ocipv6\Cron\dyndns', 'update');

\OCP\App::registerAdmin('ocipv6', 'settings/ipv6');
\OCP\App::registerAdmin('ocipv6', 'settings/upnp');
\OCP\App::registerAdmin('ocipv6', 'settings/dynv6');

use \OCP\AppFramework\App;

use \OCA\OCIPv6\Service\AuthorService;

class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('ocipv6', $urlParams);

        $container = $this->getContainer();

        /**
         * Controllers
         */
        $container->registerService('AuthorService', function($c) {
            return new AuthorService(
                $c->query('Config'),
                $c->query('OCIPv6')
            );
        });

        $container->registerService('Config', function($c) {
            return $c->query('ServerContainer')->getConfig();
        });
    }
}

?>
