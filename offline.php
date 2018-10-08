<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016-2018 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$twofactormethods = JAuthenticationHelper::getTwoFactorMethods();
$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$users            = JFactory::getUser();

$this->language  = $docs->language;
$this->direction = $docs->direction;
$this->setHtml5(true);

$this->_script = $this->_scripts = array();	
$fullWidth = 1;

$sitename = htmlspecialchars($apps->get('sitename'), ENT_QUOTES, 'UTF-8');

if ($params->get('logoFile')){
	$logo = '<img src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '" />';
} else {
	$logo = $sitename;
}
/*
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
*/

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
[head]
	<jdoc:include type="head" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/coopceptor.min.css" rel="stylesheet" />
	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
[/head]
[begins tags="body" mdatatype="http://schema.org/WebPage" /]


    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $sitename; ?></h5>

    </div>
<jdoc:include type="message" />
    <div class="container">
      <div class="card-deck mb-6 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">

				<?php if ($apps->get('display_offline_message', 1) == 1 && str_replace(' ', '', $apps->get('offline_message')) !== '') : ?>
					<p><?php echo $apps->get('offline_message'); ?></p>
				<?php elseif ($apps->get('display_offline_message', 1) == 2) : ?>
					<p><?php echo JText::_('JOFFLINE_MESSAGE'); ?></p>
				<?php endif; ?>		  
          </div>
        </div>
		
        <div class="card mb-6 shadow-sm">

				<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
					<fieldset>
						<label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
						<input name="username" id="username" type="text" title="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" />

						<label for="password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
						<input type="password" name="password" id="password" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" />

						<?php if (count($twofactormethods) > 1) : ?>
						<label for="secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
						<input type="text" name="secretkey" id="secretkey" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" />
						<?php endif; ?>

						<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGIN'); ?>" />

						<input type="hidden" name="option" value="com_users" />
						<input type="hidden" name="task" value="user.login" />
						<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
						<?php echo JHtml::_('form.token'); ?>
					</fieldset>
				</form>
        </div>
		
		
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="assets/logo.png" alt="Joomla" />
            <small class="d-block mb-3 text-muted">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></small> - Coopceptor by <a href="https://alexonbalangue.me">Alexon Balangue</a>
          </div>
        </div>
      </footer>
    </div>
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> 
		<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/coopceptor.min.js"></script> 

	[ends tags="body" /]  
</html>
