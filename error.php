<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016-2018 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Application;
use Joomla\CMS\Router\Route;
#use Joomla\CMS\Document;
#use Joomla\CMS\Environment;


$apps = Factory::getApplication();
$docs = Factory::getDocument();
$users = Factory::getUser();
$langs = Factory::getLanguage();

$this->language  = $docs->language;
$this->direction = $docs->direction;


$params = $apps->getTemplate(true)->params;
$sitename = htmlspecialchars($apps->get('sitename'), ENT_QUOTES, 'UTF-8');
//$params = $apps->getTemplate(true)->params;

$docs->setHtml5(true);



		HTMLHelper::_('stylesheet', 'templates/'.$this->template.'/assets/coopceptor.min.css', ['version' => 'auto', 'relative' => true]);
		HTMLHelper::_('script', 'templates/'.$this->template.'/assets/coopceptor.min.js', ['version' => 'auto', 'relative' => true]);


?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
	<meta charset="utf-8" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	
</head>
<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $logo; ?></h5>
      <nav class="my-2 my-md-0 mr-md-3">
       <?php echo $this->getBuffer('modules', 'menu', array('style' => 'none')); ?>
      </nav>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4"><?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
      
	  <p class="lead"><strong><?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
		<p class="lead"><?php echo Text::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
    </div>

    <div class="container">
      <div class="card-deck mb-6 text-center">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
<ul>
	<li><?php echo Text::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
	<li><?php echo Text::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
	<li><?php echo Text::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
	<li><?php echo Text::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
</ul>
          </div>
        </div>
        <div class="card mb-6 shadow-sm">
<?php if (JModuleHelper::getModule('mod_search')) : ?>
	<p><strong><?php echo Text::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
	<p><?php echo Text::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
	<?php $module = JModuleHelper::getModule('mod_search'); ?>
	<?php echo JModuleHelper::renderModule($module); ?>
<?php endif; ?>
<p><?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="far fa-home" aria-hidden="true"></span> <?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
        </div>
		
		<div class="col col-12">

<hr />
<p><?php echo Text::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
<blockquote>
	<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
	<?php if ($this->debug) : ?>
		<br/><?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->error->getLine(); ?>
	<?php endif; ?>
</blockquote>
<?php if ($this->debug) : ?>
	<div>
		<?php echo $this->renderBacktrace(); ?>
		<?php // Check if there are more Exceptions and render their data as well ?>
		<?php if ($this->error->getPrevious()) : ?>
			<?php $loop = true; ?>
			<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
			<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
			<?php $this->setError($this->_error->getPrevious()); ?>
			<?php while ($loop === true) : ?>
				<p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
				<p>
					<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
					<br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->_error->getLine(); ?>
				</p>
				<?php echo $this->renderBacktrace(); ?>
				<?php $loop = $this->setError($this->_error->getPrevious()); ?>
			<?php endwhile; ?>
			<?php // Reset the main error object to the base error ?>
			<?php $this->setError($this->error); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
		</div>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="assets/logo.png" alt="Joomla" />
            <small class="d-block mb-3 text-muted">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></small> - Coopceptor by <a href="https://alexonbalangue.me">Alexon Balangue</a>
          </div>
          <div class="col-6 col-md">
            <?php echo $this->getBuffer('modules', 'footer1', array('style' => 'none')); ?>
          </div>
          <div class="col-6 col-md">
            <?php echo $this->getBuffer('modules', 'footer2', array('style' => 'none')); ?>
          </div>
          <div class="col-6 col-md">
            <?php echo $this->getBuffer('modules', 'footer3', array('style' => 'none')); ?>
          </div>
        </div>
      </footer>
    </div>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/coopceptor.min.js"></script> 
	<?php echo $docs->getBuffer('modules', 'referencer', array('style' => 'none')); ?>
	<?php echo $docs->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
