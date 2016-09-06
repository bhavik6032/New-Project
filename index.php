<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

//$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/font-awesome.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/style.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/responsive.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/slicknav.css');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<?php
##DK
$app = JFactory::getApplication();
$menu = $app->getMenu();
if ($menu->getActive() == $menu->getDefault()) {
//Home page
    $body_class="home-only ";
    $inner=0;
}
else
{
//Inner Page
    $body_class="inner-page ";
    $inner=1;
}
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();
$pageclass = '';

if (is_object($menu)) { $pageclass = $menu->params->get('pageclass_sfx'); }
?>

<?php
//Fetch the doc
$doc = JFactory::getDocument();
$menu = $app->getMenu();
//Fetch active menu item
$active = $menu->getActive();
//Fetch menu item params
$menu_params = $active->params;
if($menu_params){
    // Is the page heading set? If not lets get menu title.
    if ($menu_params->get('page_heading') != '') {
    $page_title_c = $menu_params->get('page_heading');
    } else {
    $page_title_c = $active->title;
    }
}
?>
<?php if ($this->countModules('left and right')) : ?>
<?php $custom_class= "both"; ?>
<?php elseif ($this->countModules('left')) : ?>
<?php $custom_class= "left"; ?>
<?php elseif ($this->countModules('right')) : ?>
<?php $custom_class= "right"; ?>
<?php else : ?>
<?php $custom_class="full"; ?>
<?php endif; ?>
<body class="<?php echo $body_class.$pageclass; ?>">
<!-- header ================================================== -->
<?php if ($this->countModules('logo or main-menu or top-call or top-enquiry or top-social')) : ?>
<header>
 <div class="header-wrapper">
 
    <?php if ($this->countModules('logo')) : ?>
    <div class="logo"> <a href="<?php echo JURI::base(); ?>">
      <jdoc:include type="modules" name="logo" style="xhtml"/>
      </a> </div>
    <?php endif; ?>
    
    <?php if ($this->countModules('main-menu')) : ?>
    <div class="navigation">
     <jdoc:include type="modules" name="main-menu" style="xhtml"/>               
    </div>
    <?php endif;  ?>
    
     <?php if ($this->countModules('top-call or top-enquiry or top-social')) : ?>
    <div class="header-right">
    
     <?php if ($this->countModules('top-call')) : ?>
       <div class="call-now">
          <jdoc:include type="modules" name="top-call" style="xhtml"/>
       </div>
       <?php endif; ?>
       
       <?php if ($this->countModules('top-enquiry')) : ?>
       <div class="enquery">
        <jdoc:include type="modules" name="top-enquiry" style="xhtml"/>
       </div>
       <?php endif;  ?>
       
       <?php if ($this->countModules('top-social')) : ?>
       <div class="social">
       <jdoc:include type="modules" name="top-social" style="xhtml"/>
       </div>
       <?php endif; ?>
       
    </div>
    <?php endif; ?>
 </div>
</header>
<?php endif; ?>
<!-- header end-->

<?php if ($this->countModules('slideshow')) : ?>
<!-- slider-->
<div class="slider">
<jdoc:include type="modules" name="slideshow" style="xhtml"/>
<div class="slider-text">
          <?php if ($this->countModules('slider-right')) : ?>
           <div class="chamber-logo">
          <jdoc:include type="modules" name="slider-right" style="xhtml"/>
            </div>
            <?php endif; ?>
            
            <?php if ($this->countModules('slider-button')) : ?>
            <div class="find-button">
            <jdoc:include type="modules" name="slider-button" style="xhtml"/> 
            </div>
            <?php endif; ?>
            
         </div>
</div>
<!-- slider end -->
<?php endif; ?>


<!-- banner ----->
<?php if ($this->countModules('inner-banner')) : ?>
<div class="banner">
 <jdoc:include type="modules" name="inner-banner" style="xhtml"/>
 <div class="container">
<div class="banner-text">
<h3><?php echo $page_title_c; ?></h3>
</div>
</div>
</div>
<?php endif; ?>
<!-- end banner   -->
<?php if ($this->countModules('breadcrumbs')) : ?>
<div class="breadcrumb">
<div class="container">
<jdoc:include type="modules" name="breadcrumbs" style="xhtml"/>
</div>
</div>
<?php endif; ?>

 <?php if ($this->countModules('right or left') or JRequest::getVar('view')!=='featured') : ?>
<div class="content-box">
         <div class="container">
         
          <?php if ($this->countModules('left')) : ?>
            <div class="left-side">
               <div class="left-col-s">
              <jdoc:include type="modules" name="left" style="left"/>
               </div>
            </div>
            <?php endif; ?>
         
         
            <?php if (JRequest::getVar('view')!=='featured') : ?>
            <div class="content-side <?php echo $custom_class; ?>">          
            <?php if (count(JFactory::getApplication()->getMessageQueue())) : ?>
            <jdoc:include type="message" />
            <?php endif; ?>
            <jdoc:include type="component" />
            </div>
            <?php endif; ?>
            
            <?php if ($this->countModules('right')) : ?>
            <div class="right-side">
               <div class="right-col-s">
              <jdoc:include type="modules" name="right" style="right"/>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
<?php endif; ?>

<!-- legal service section ================================================== -->
 <?php if ($this->countModules('slider-bottom-1 or slider-bottom-2 or enquiry-box or call-box')) : ?>
<div class="legal-service">
 
 <?php if ($this->countModules('slider-bottom-1')) : ?>
 <jdoc:include type="modules" name="slider-bottom-1" style="xhtml"/>
 <?php endif; ?>
 
 <?php if ($this->countModules('slider-bottom-2 or enquiry-box or call-box')) : ?>
 <div class="mark-kelly">
  <?php if ($this->countModules('slider-bottom-2')) : ?>
  <jdoc:include type="modules" name="slider-bottom-2" style="xhtml"/>
   <?php endif; ?>
    
    <?php if ($this->countModules('enquiry-box')) : ?>
    <div class="enquiry fl">
     <jdoc:include type="modules" name="enquiry-box" style="xhtml"/>
    </div>
    <?php endif; ?>
    
     <?php if ($this->countModules('call-box')) : ?>
      <div class="call-now fr">
       <jdoc:include type="modules" name="call-box" style="xhtml"/>
      </div>
      <?php endif; ?>
 </div>
 <?php endif; ?>
</div>
<?php endif; ?>
<!-- legal service section end ================================================== -->

<!-- news-section ================================================== -->
<?php if ($this->countModules('latest-news or tweets or testimonials')) : ?>
<div class="news-section">
 <?php if ($this->countModules('latest-news')) : ?>
 <div class="col-4 latest-news">
 <jdoc:include type="modules" name="latest-news" style="xhtml"/> 
 </div>
 <?php endif; ?>
 
 <?php if ($this->countModules('tweets')) : ?>
 <div class="col-4 tweets">
  <jdoc:include type="modules" name="tweets" style="xhtml"/>
 </div>
 <?php endif; ?>
 
 <?php if ($this->countModules('testimonials')) : ?>
 <div class="col-4 testimonials">
  <jdoc:include type="modules" name="testimonials" style="xhtml"/>
 </div>
 <?php endif; ?>
</div>
<?php endif; ?>
<!-- news-section end ================================================== -->

 <?php if ($this->countModules('enquiry-bottom')) : ?>
<div class="contact-form">
 <div class="container">
  <jdoc:include type="modules" name="enquiry-bottom" style="xhtml"/>           
 </div>
</div>
<?php endif; ?>

<?php if ($this->countModules('footer-top-left or footer-top-right')) : ?>
<div class="news-testimonials">
       <?php if ($this->countModules('footer-top-left')) : ?>
         <div class="col-6 fl">
            <jdoc:include type="modules" name="footer-top-left" style="xhtml"/>
         </div>
         <?php endif; ?>
          <?php if ($this->countModules('footer-top-left')) :
           $classer="fr";
		   else :
		   $classer="fl";
		   endif; 
		  ?>
          
          <?php if ($this->countModules('footer-top-right')) : ?>
         <div class="col-6 testimo <?php echo $classer; ?>">
          <jdoc:include type="modules" name="footer-top-right" style="xhtml"/>
         </div>
         <?php endif; ?>
      </div>
<?php endif; ?>

<!-- footer ================================================== -->
<?php if ($this->countModules('footer-menu or copyright or footer-address or footer-logo or footer-social')) : ?>
<footer>
 <div class="col-4 sitemap">  
 
  <?php if ($this->countModules('footer-menu')) : ?>
  <jdoc:include type="modules" name="footer-menu" style="xhtml"/>
  <?php endif; ?> 
  
  <?php if ($this->countModules('copyright')) : ?>
  <jdoc:include type="modules" name="copyright" style="xhtml"/>
  <?php endif; ?>

  <div class="back-top1 mobile-on">
 <a><img src="images/mobile-back-top.png"></a>
</div>
  </div>
 
  <?php if ($this->countModules('footer-address')) : ?>
  <div class="col-4 footer-address">
  <jdoc:include type="modules" name="footer-address" style="xhtml"/>
  </div>
  <?php endif; ?>
 
 
 <?php if ($this->countModules('footer-logo or footer-social')) : ?>
  <div class="col-4 fo-social">
  
  <?php if ($this->countModules('footer-logo')) : ?>
  <div class="footer-logo">
    <jdoc:include type="modules" name="footer-logo" style="xhtml"/>
  </div>
  <?php endif; ?>
  
  	<?php if ($this->countModules('footer-social')) : ?>
    <div class="footer-social">
    <jdoc:include type="modules" name="footer-social" style="xhtml"/>
    </div>
    <?php endif; ?>
    
 </div>
 <?php endif; ?>

  <!-- back-top ================================================== -->
<div class="back-top">
 <a><img src="images/back-top.png"></a>
</div>
</footer>
<?php endif; ?>
<?php if ($this->countModules('debug')) : ?>
<jdoc:include type="modules" name="debug" style="none" />
<?php endif; ?>
<!-- footer end ================================================== -->
<!--javascript-->
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/custom.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/slicknav.js"></script>
<script src="https://use.typekit.net/sar3iwp.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery('.navigation').slicknav({
    label: 'Menu',
    duration: 500,
    prependTo: 'body'
  });
});
</script>

</body>
</html>
