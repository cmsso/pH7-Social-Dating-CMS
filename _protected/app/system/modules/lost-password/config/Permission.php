<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Lost Password / Config
 */
namespace PH7;
defined('PH7') or die('Restricted access');

use PH7\Framework\Url\Header, PH7\Framework\Mvc\Router\Uri;

class Permission extends PermissionCore
{

    public function __construct()
    {
        parent::__construct();

        if (PH7_DEMOMODE)
        {     // Don't allow this module if demo mode is on
            Header::redirect($this->registry->site_url, t('Not available on Demo Mode'), 'error');
        }

        if ((UserCore::auth() || AffiliateCore::auth() || AdminCore::auth()) && ($this->registry->action == 'forgot' || $this->registry->action == 'reset'))
        {
            Header::redirect(Uri::get('lost-password', 'main', 'account'), $this->alreadyConnectedMsg(), 'error');
        }
    }

}
