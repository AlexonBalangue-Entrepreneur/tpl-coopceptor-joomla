<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016-2018 AlexonBalangue.me. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$users            = JFactory::getUser();
$browser = JBrowser::getInstance();
$this->language  = $docs->language;
$this->direction = $docs->direction;

$this->setHtml5(true);


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
</head>
<body>
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
