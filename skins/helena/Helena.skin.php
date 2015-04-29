<?php
/**
* Skin file for skin Helena.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
* @file
* @ingroup Skins
*/

if ( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * SkinTemplate class for Helena skin
 * @ingroup Skins
 */
class SkinHelena extends SkinTemplate {

	var $skinname = 'helena', $stylename = 'helena',
		$template = 'HelenaTemplate', $useHeadElement = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;

		parent::initPage( $out );

		$skinPath = htmlspecialchars( $wgLocalStylePath ) . '/' . $this->stylename;
		$iefixesPath = $skinPath . '/ie-fixes';

		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS file since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		$min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';
		$out->addHeadItem( 'csshover',
			'<!--[if lt IE 7]><style type="text/css">body{behavior:url("' .
			"$iefixesPath/csshover{$min}.htc\")}</style><![endif]-->"
		);

		$out->addHeadItem( 'ie-html5-media-rules',
		"<!--[if lt IE 9]>" . 
			//"<script type=\"text/javascript\" src=\"https://getfirebug.com/releases/lite/1.3/firebug-lite-beta.js\"></script>" .
			"<script type=\"text/javascript\" src=\"$iefixesPath/html5shiv/html5shiv-printshiv.js\"></script>" .
            "<script type=\"text/javascript\" src=\"$iefixesPath/selectivizr/selectivizr.min.js\"></script>" .
			"<script type=\"text/javascript\" src=\"$iefixesPath/respond/respond.min.js\"></script>" .
			//"<script type=\"text/javascript\" src=\"$iefixesPath/ie7.js/IE9.js\"></script>" .
		"<![endif]-->"
		);

		$out->addHeadItem('responsive', '<meta name="viewport" content="width=device-width, initial-scale=1.0">');
		$out->addHeadItem('ie-edge', '<meta http-equiv="X-UA-Compatible" content="IE=edge">');
		
		$out->addModules( 'skins.helena.js' );
	}

	/**
	 * Loads skin and user CSS files.
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		//parent::setupSkinUserCss( $out );
		$out->addModuleStyles( array( 'skins.helena.bootstrap', 'skins.helena.fontAwesome', 'skins.helena.bootstrapOverride', 'skins.helena' ) );	//'skins.helena',
	}
	
	public function commonPrintStylesheet() {
		return false;
	}
	
	function addToBodyAttributes( $out, &$bodyAttrs ) {
		$bodyAttrs['class'] .= ' user-logged' . ($this->loggedin ? 'in' : 'out');
	}
}

/**
 * QuickTemplate class for Helena skin
 * @ingroup Skins
 */
class HelenaTemplate extends BaseTemplate {

	/* Functions */

    /**
     * Outputs the entire contents of the (X)HTML page
     */
    public function execute() {
    	global $wgLocalStylePath;

		$skinPath = htmlspecialchars( $wgLocalStylePath ) . '/' . $this->getSkin()->stylename;
		$personal_urls = &$this->data['personal_urls'];
        // Suppress warnings to prevent notices about missing indexes in $this->data
        wfSuppressWarnings();

        $this->html( 'headelement' ); ?>
    
<!-- Body -->
<!-- Facebook --><div id="fb-root"></div>
<div id="mw-page-base" class="noprint"></div>
<div id="mw-head-base" class="noprint"></div>
	<?php if ( $this->data['showjumplinks'] ) { ?>
	<!-- jumpto -->
	<div id="jump-to-nav" class="mw-jump sr-only">
		<?php $this->msg( 'jumpto' ) ?>
		<a href="#content"><?php $this->msg( 'jumptocontent' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
		<a href="#top-search-form"><?php $this->msg( 'jumptosearch' ) ?></a>
	</div>
	<!-- /jumpto -->
	<?php } ?>
<div id="top-nav" class="navbar navbar-fixed-top navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#navbar-top-collapse"
				aria-controls="navbar-top-collapse"
		>
			<span class="sr-only"><?php $this->msg( 'kz-mobile-menu' ) ?></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
		</button>
		<button type="button" id="search-toggle" class="navbar-toggle" title="<?php $this->msg('search') ?>" data-toggle="collapse" data-target=".search-top-collapse">
          <span class="icon-search"></span>
        </button>
		<a id="p-logo" role="banner" class="navbar-brand" style="background-image: url(<?php $this->text( 'logopath' ) ?>);" href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>" <?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>></a>
	 </div>

	  <div class="collapse navbar-collapse" id="navbar-top-collapse" aria-expanded="false">
		  <ul class="nav navbar-nav">
			  <?php
			  	echo $this->makeBasicListItem( "kz-nav-home", null );
			  	echo $this->makeBasicListItem( "kz-nav-about", null );
			  	//echo '<li class="nav-divider" role="presentation"></li>';
			  	$wgWikiList = $this->getSisterSites();
			  	foreach( $wgWikiList as $key => $val) {
					echo "<li>{$val['linkElem']}</li>";
				}
			  ?>
		  </ul>
	  </div>

    <div class="collapse search-top-collapse" role="search">
    	<h3 class="sr-only"><?php $this->msg( 'kz-searchform' ) ?></h3>
		<form class="form-search" id="top-search-form" action="<?php $this->text( 'wgScript' ) ?>">
			<div class="input-group">
				<input name="search"
			   		class="form-control mw-searchInput"
			   		type="search"
					title="<?php $this->msg( 'tooltip-search' ) ?>"
					value="<?php echo $this->get( 'search', '' ) ?>"
					placeholder="<?php $this->msg( 'searchsuggest-search' ) ?>"
				>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary" title="<?php $this->msg( 'searchbutton' ) ?>"><span class="sr-only"><?php $this->msg( 'searchbutton' ) ?></span><span class="icon-search"></span></button>
				</span>  
				<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
			</div>
		</form>
	</div>
    
	<? $nav = array(
		'home',
		'about',
		//'partners',
		$this->getSkin()->getUser()->isAllowed( 'edit' ) ? 'help-editor' : 'help',
		'feedback',
		'donation',
	);
	?>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav" id="nav-links">
		<?php foreach( $nav as $key ) {
			//$icon = ( $key == 'home' ) ? 'icon-home icon-large' : '';
			echo $this->makeBasicListItem( "kz-nav-$key", null );
		} ?>
		</ul>
		
		<ul class="kz-navbar-widgets nav navbar-nav navbar-right">
			<?php $wgWikiList = $this->getSisterSites( true );
				if ( !empty( $wgWikiList ) ) { ?>
					<li id="kz-sister-sites">
						<ul>
							<?php foreach( $wgWikiList as $key => $val ) {
								echo "<li class=\"kz-sister-site-{$key}\">{$val['linkElem']}</li>";
							} ?>
						</ul>
					</li>
			<?php } ?>
		<?php
			if ( $this->getSkin()->loggedin ) {
				$gender = wfMessage( 'user-gender', $this->getSkin()->getUser() )->text();
				$limitedList = array(
					'preferences' => 'icon-cog',
					'watchlist' => 'icon-pushpin',
					'mycontris' => 'icon-trophy',
					'userpage' => 'icon-' . $gender,
					'logout' => 'icon-signout'
				);

		?>
			<li class="dropdown" id="user-dropdown-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
					<span class="icon-user icon-2x"></span>
					<!--TODO: need to truncate username here, to avoid overflow -->
					<!--<span class="user-name"><?php echo $this->getSkin()->getUser()->getName() ?></span>&nbsp;-->
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li role="presentation" class="dropdown-header"><?php echo wfMessage( 'kz-user-menu-username', $this->getSkin()->getUser()->getName() ) ?></li>
					<?php foreach( $limitedList as $item => $icon ) {
						$props = $personal_urls[$item];
						if( $props === null ) { continue; }

						if( $item === 'userpage' ) {
							$props['text'] = $this->getSkin()->msg( 'userpage' )->text();
						}
					?>
						<li><a href="<?php echo htmlspecialchars( $props['href'] ) ?>">
								<span class="icon-fixed-width <?php echo $icon ?>"></span>&nbsp;<?php echo $props['text'] ?>
							</a>
						</li>
					<?php }; ?>
				</ul>
			</li>
		<? } ?>
			
		</ul>
		<?php
			if ( !$this->getSkin()->loggedin ) {
				$login_id = $this->getSkin()->showIPinHeader() ? 'anonlogin' : 'login';
				$login = $personal_urls[$login_id];
			?>
				<a class="user-login" href="<?php echo htmlspecialchars($login['href']) ?>">
					<span class="icon-stack">
						<span class="icon-check-empty icon-stack-base"></span>
						<span class="icon-unlock-alt"></span>
					</span>
				</a>
		<?php } ?>
	</div>
	<!--/.navbar-collapse -->
  </div>
</div>
<!--/.navbar -->

<div id="bodyWrapper" class="container">
	<div id="mw-js-message" class="row" <?php $this->html( 'userlangattributes' ) ?>></div>
	<?php if ( $this->data['sitenotice'] ) { ?>
		<div id="siteNotice" class="row"><?php $this->html( 'sitenotice' ) ?></div>
	<?php } ?>

    <div class="main-columns row">
        <div id="sidebar-main"  class="sidebar-nav col-md-2 col-sm-3 hidden-xs hidden-print" role="complementary">
			<ul class="nav">
				<?php wfRunHooks( 'SkinHelenaSidebar::Start', array( &$this ) ); ?>
				<li class="nav-block well" id="sidebar-search">
					<h3 class="sr-only"><?php $this->msg( 'kz-searchform' ) ?></h3>
					<p class="blurb hidden-xs"><?php $this->msg( 'kz-sidebar-blurb' ) ?></p>
					<form class="form-search" id="main-search-form" action="<?php $this->text( 'wgScript' ) ?>">
					  <div class="input-group">
						  <input name="search" id="searchInput"
							 class="form-control mw-searchInput" type="search"
							 title="<?php $this->msg( 'tooltip-search' ) ?>"
							 value="<?php echo $this->get( 'search', '' ) ?>"
							 placeholder="<?php $this->msg( 'searchsuggest-search' ) ?>"
						  >
						  <span class="input-group-btn">
							<button type="submit" class="btn btn-primary" title="<?php $this->msg( 'searchbutton' ) ?>"><span class="icon-search"></span></button>
						  </span>
					  </div>
					  <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
					</form>
				</li>
				<li id="sidebar-buttons" class="nav-block sidebar-no-well hidden-xs">
					<button id="portals-list-btn" class="btn col-sm-12"
							title="<?php echo $this->getMsg( 'kz-sidebar-portals-list-tt' )->inContentLanguage()->text(); ?>" role="button"
							data-toggle="modal"  data-target="#portals-list-wrapper">
								<span class="img-icon pull-left"></span>
								<span><?php echo $this->getMsg( 'kz-sidebar-portals-list' )->inContentLanguage()->text(); ?></span>
					</button>

                    <button id="cat-search-btn" class="btn col-sm-12" role="button" data-toggle="modal" data-target="#solr-search-wrapper">
                        <span class="img-icon pull-left"></span>
                        <span>מחשבון זכויות</span>
                    </button>

					<?php
						global $wgWrGuidesLink;
						if( !empty( $wgWrGuidesLink ) ) {
							$guidesUrl = $this->getSkin()->makeInternalOrExternalUrl( $wgWrGuidesLink );
						?>
							<a class="wr-sidebar-btn-guides sidebar-btn" role="button" href="<?php echo $guidesUrl; ?>">
								<button class="btn col-sm-12">
									<span class="img-icon pull-left"></span>
									<span class="btn-text"><?php $this->msg( 'kz-sidebar-btn-guides' ) ?></span>
								</button>
							</a>
					<?php } ?>

                    <?php
                        $extraButtons = '';
                        wfRunHooks( 'SkinHelenaSidebar::Buttons', array( &$this, &$extraButtons ) );
                        echo $extraButtons;
                    ?>
				</li>

				<?php wfRunHooks( 'SkinHelenaSidebar::End', array( &$this ) ); ?>

			</ul>
		</div>

        <!--/sidebar-->
        <article id="content" class="mw-body col-md-10 col-sm-9 col-xs-12" role="main">
			<header>
				<?php if( $this->getSkin()->getUser()->isLoggedIn() ) {
					$toolbox = $this->getToolbox();
					if( $toolbox !== null ) { ?>
						<div class="dropdown hidden-print hidden-xs" id="article-actions-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="icon-asterisk icon-2x"></span><span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<!--<li role="presentation" class="dropdown-header"></li>-->
								<?php echo $toolbox ?>
							</ul>
						</div>
					<?php } else { ?>
						<span class="dropdown hidden-print" id="article-actions-menu">
							<a class="dropdown-toggle" title="<?php $this->msg( 'article-actions-menu-empty' ) ?>">
							<span class="icon-asterisk icon-2x icon-muted"></span></a>
						</span>
					<?php } ?>
					
				<?php } ?>
				<?php if( $this->data['isarticle'] ) { ?>
					<div class="fb-like hidden-xs" data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="false"></div>
				<?php } ?>
	
				<h1 id="firstHeading" class="firstHeading" lang="<?php
					$this->data['pageLanguage'] = $this->getSkin()->getTitle()->getPageViewLanguage()->getCode();
					$this->html( 'pageLanguage' );
				?>">
					<span dir="auto"><?php $this->html( 'title' ) ?></span>
				</h1>
			</header>
			<section id="bodyContent">
				<div id="contentSub"<?php $this->html( 'userlangattributes' ) ?>><?php $this->html( 'subtitle' ) ?></div>
				<?php if ( $this->data['undelete'] ) { ?>
				<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
				<?php } ?>
				<?php if( $this->data['newtalk'] ) { ?>
				<div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
				<?php } ?>
				
				<?php $this->html( 'bodycontent' ) ?>
			</section>
            <div class="clearfix"></div>
			<?php if ( $this->data['dataAfterContent'] ) { ?>
			<?php $this->html( 'dataAfterContent' ); ?>
			<?php } ?>
			<?php $this->html( 'debughtml' ); ?>
        </article>
    </div>
    <!--/row-->
    <?php if ( class_exists('ExtShareBar' ) && $this->data['isarticle'] ) { ?>
        <section id="bottom-sharebar" class="col-md-offset-2 hidden-xs hidden-print noprint">
            <?php echo ExtShareBar::makeShareBar( $this->getSkin()->getTitle() ); ?>
        </section>
    <?php } ?>
    <section id="article-info" class="col-md-offset-2">
		<div class="printfooter visible-print">
			<?php echo $this->getPageURL(); ?>
		</div>
		<?php if( $this->data['isarticle'] ) { ?>
			<div class="last-modified"><?php echo $this->makeLastModHistoryLink(); ?></div>
		<?php } ?>
        <?php if ( $this->data['catlinks'] ) { ?>
            <?php $this->html( 'catlinks' ); ?>
        <?php } ?>
    </section>
    <?php 
    	$msgObj = $this->getMsg( 'helena-disclaimers' )->inContentLanguage();
    	if( $msgObj->exists() ) { ?>
			<section id="disclaimers" class="col-md-12 hidden-print">
				<?php echo $msgObj->parse(); ?>
			</section>
		<?php }
	?>
</div>


<?php
	$footerLinks = array(
		'about' => array(
			'about',
			//'transparency',
			//'news',
			'policy',
			'faq',
			//'privacy',
			//'legal',
            'donation',
            'feedback'

        ),
        'portals' => array(
        ),
		'communication' => array(
			'contact',
			'facebook',
		),
	)

?>

<footer class="footer hidden-print">
	<div class="container">
	<?php $skin = $this->getSkin();
		foreach( $footerLinks as $section => $sectionItem ) { ?>
		<div class="footer-column col-sm-3 col-xs-6<?php echo $section === 'portals' ? ' hidden-xs' : '' ?>" id="footer-section-<?php echo $section ?>">
			<div class="footer-column-heading"><?php echo $this->getMsg( 'kz-footer-section-' . $section )->inContentLanguage()->text() ?></div>
			<div class="footer-column-body">
				<ul class="list-unstyled">
                <?php if ( in_array( $section, array( 'about', 'communication' ) ) ) {
					foreach( $sectionItem as $key ) {
						echo $this->makeBasicListItem( "kz-footer-$key" );
					}
                }
				?>
                    <?php if ( $section === 'communication' ) { ?>
                        <li class="kz-footer-newsletter hidden-xs"><?php $this->getMsg( 'kz-footer-newsletter' )->inContentLanguage()->text() ?>
                            <?php echo $this->makeNewsletterForm(); ?>
                        </li>
                    <?php }
                    if ( $section === 'portals' ) {
                        $msg = $this->getMsg( 'kz-footer-portals-list' )->inContentLanguage()->parse();
                        $list = explode( ';', $msg );
                        foreach( $list as $listItem) {
                            echo "<li>$listItem</li>";
                        }

                        echo '<li><a href="#" data-toggle="modal" data-target="#portals-list-wrapper">'
							. $this->getMsg( 'kz-footer-portals-menu' )->inContentLanguage()->text() . '</a></li>';
                    }
                    ?>
				</ul>
			</div>
		</div>
	<?php } ?>
		<div id="footer-section-licensing" class="footer-column col-sm-3 hidden-xs">
			<div class="footer-column-heading"><?php echo $this->getMsg( 'kz-footer-section-licensing' )->inContentLanguage()->text() ?></div>
			<div class="footer-column-body">
				<div class="license-info">
					<p><?php echo $this->getMsg( 'kz-footer-contentlicense' )->inContentLanguage()->text() ?></p>
				</div>
				<div id="copyright">
					<p><?php echo $this->getMsg( 'kz-footer-copyright' )->inContentLanguage()->text(); ?></p>
				</div>
				<div id="footer-icons">
					<!-- @todo: links, alt text -->
					<ul class="list-inline">
						<li>
							<a href="http://www.w3.org/WAI/WCAG2A-Conformance">
								<!-- @todo i18n -->
								<img alt="Accessibility badge - Level A Conformance to Web Content Accessibility Guidelines 2.0" class="img-responsive" src="<?php echo $skinPath ?>/images/powered-by/wai-A-greygreen.png">
							</a>
						</li>
						<li>
							<a href="//www.mediawiki.org/">
								<!-- @todo i18n -->
								<img alt="Powered by MediaWiki" class="img-responsive" src="<?php echo $skinPath ?>/images/powered-by/poweredby_mediawiki_small.png">
							</a>
						</li>
						<li>
							<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/il/">
								<!-- @todo i18n -->
								<img alt="Content licensed under Creative Commons BY-NC-SA 2.5 IL" class="img-responsive" src="<?php echo $skinPath ?>/images/powered-by/cc-by-nc-sa_greygreen.png">
							</a>
						</li>
					</ul>
				</div>	
			</div>
		</div><!--/column-->
	</div><!--/container-->
</footer>


        <div class="modal modal-long" id="solr-search-wrapper" tabindex="-1" role="dialog" aria-labelledby="solr-search-dialog-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only"></span>
                        </button>
                        <h4 class="modal-title">
                            <span class="sr-only" id="solr-search-dialog-label"></span>
                            <span aria-hidden="true">
                                מחשבון זכויות
                                -
                                חיפוש לפי קטגוריות
                            </span>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p class="intro" aria-hidden="true"></p>
                        <div id="solr-search" class="body-content clearfix">

                                <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
                                <script src="/solr-filter/mustache.js"></script>
                                <script src="/solr-filter/solr-filter.js"></script>

                                <link href="https://code.jquery.com/ui/1.9.2/themes/cupertino/jquery-ui.css" rel="stylesheet" type="text/css"/>
                                <link href="/solr-filter/solr-filter.css" rel="stylesheet" type="text/css"/>

                                <?php
                                $curr_category = $this->getSkin()->getTitle()->getText();
                                global $IP;
                                include($IP.'/solr-filter/filter.php');
                                ?>


                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <?php
    $this->showOldEditorToolbar( $skin );
    echo $this->getPortalsList();
    $this->printTrail();
?>

	<!-- /Facebook -->
		<script>
			/*
			window.fbAsyncInit = function() {
				FB.init({
					appId: '<?php global $egFacebookAppId; echo $egFacebookAppId; ?>',
					status: false,
					xfbml: true
				});
			};
			*/
			$(document).ready( function() {
				if( $( window ).width() >= 768 ) {
					(function(d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;
						js = d.createElement(s); js.id = id;
						js.src = "//connect.facebook.net/he_IL/all.js#xfbml=1&appId=<?php global $egFacebookAppId; echo $egFacebookAppId; ?>";
						fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
				}
			});
		</script>
	<!-- /Facebook -->
</body>
</html><?php
                wfRestoreWarnings();
        }

        function getPortalsList() {
        	$titleObj = Title::newFromText( $this->getMsg( 'kz-portals-list-page' )->text() );
        	if ( $titleObj == null || !$titleObj->exists() ) {
        		return '';
        	}
        	$articleObj = Article::newFromId( $titleObj->getArticleId() );
        	$contentObj = $articleObj->getPage()->getContent();
        	$text = $contentObj->getParserOutput( $this->getSkin()->getTitle() )->getText();

			$msgTitle = $this->getMsg( 'kz-portals-menu-title' )->inContentLanguage()->text();
			$msgSubtitle = $this->getMsg( 'kz-portals-menu-subtitle' )->inContentLanguage()->text();
			$msgBtnClose = $this->getMsg( 'kz-portals-menu-btn-close' )->text();

			$msgModalLabel = $this->getMsg( 'kz-sidebar-portals-list-tt' )->inContentLanguage()->text();

        	$list = <<<LIST
<div class="modal modal-long" id="portals-list-wrapper" tabindex="-1" role="dialog" aria-labelledby="portals-list-dialog-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
        	<span aria-hidden="true">&times;</span>
        	<span class="sr-only">{$msgBtnClose}</span>
        </button>
        <h4 class="modal-title">
        	<span class="sr-only" id="portals-list-dialog-label">{$msgModalLabel}</span>
			<span aria-hidden="true">{$msgTitle}</span>
		</h4>
      </div>
      <div class="modal-body">
        <p class="intro" aria-hidden="true">{$msgSubtitle}</p>
        <div class="body-content">{$text}</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{$msgBtnClose}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
LIST;

			return $list;
        }


        function makeBasicListItem( $key, $icon = '' ) {
        	$link = $this->makeBasicLink( $key, $icon );
        	$listItem = '<li class="' . $key . '">' . $link . '</li>';

        	return $listItem;
        }

		function makeBasicLink( $key, $icon = '' ) {
			$urlMsgObj = $this->getMsg( "$key-page" );
			$urlMsgText = $urlMsgObj->isDisabled() ? null : trim( $urlMsgObj->inContentLanguage()->text() );
			$url = $urlMsgText === '#'
				? '#'
				: $this->getSkin()->makeInternalOrExternalUrl( $urlMsgText );
			$text = $this->getMsg( $key )->inContentLanguage()->text();
            $descMsgObj = $this->getMsg( "$key-desc" )->inContentLanguage();

        	$a = '<a href="' . $url . '"';
            $a .= !$descMsgObj->isDisabled() ? ' title="' . $descMsgObj->text() . '"' : '';
            $a .= '>';
        	if ( $icon != '' ) {
        		$a .= '<span class="' . $icon .'"></span> ';
        	};
        	$a .= $text . '</a>';
        	return $a;
        }

        function makeLastModHistoryLink() {
        	$lastmodwithlink = '';
        	$historyLink = $this->data['content_navigation']['views']['history'];
			$lastMod = $this->data['lastmod']  ?: $this->lastModified();

			if( !empty( $historyLink ) ) {
				$historyLink = ' <a href="' . htmlspecialchars( $historyLink['href'] ) .'" class="hidden-print">' .
					htmlspecialchars( $this->getMsg( 'kz-history' )->text() ) . '</a>';

				$lastmodwithlink = $lastMod . $historyLink;
			};

			return $lastmodwithlink;

		}

        function makeNewsletterForm() {
            $fieldNames = array(
                'name', 'email', 'type', 'type-public', 'type-public-title',
                'type-pros', 'type-pros-title', 'submit'
            );

            $fields = array();
            foreach( $fieldNames as $fieldName ) {
                $fields[$fieldName] = $this->getMsg( 'kz-newsletter-f-' . $fieldName )->inContentLanguage()->escaped();
            }

            $newsletterForm = <<<NLFORM
    <form role="form" id="kz-newsletter" class="form-horizontal col-md-12" method="post" target="_blank"
                        action="http://kolzchut.us6.list-manage1.com/subscribe/post?u=2fa0d96799c87ec50bb4d8a6d&id=f1b888cca2">
		<!--
		<div class="form-group">
			<label for="nl-name" class="sr-only">{$fields['name']}</label>
    		<input id="nl-name" type="text" placeholder="{$fields['name']}" class="form-control">
    	</div>
    	-->
		<div class="form-group">
			<label for="nl-email" class="sr-only">{$fields['email']}</label>
			<input id="nl-email" name="EMAIL" type="email" placeholder="{$fields['email']}" class="form-control" required="">
		</div>
		<div class="form-group">
			<fieldset>
				<legend class="sr-only">Type of newsletter:</legend><!-- @todo i18n -->
				<span class="checkbox-inline-label">{$fields['type']}:</span>&nbsp;
				<div class="checkbox-inline">
					<label title="{$fields['type-public-title']}">
						<input type="checkbox" name="group[9113][1]" checked="checked" value="1" >{$fields['type-public']}
					</label>
				</div>
				<div class="checkbox-inline">
					<label title="{$fields['type-pros-title']}">
						<input type="checkbox" name="group[9113][2]" value="2" >{$fields['type-pros']}
					</label>
				</div>
			</fieldset>
			<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

			<div style="position: absolute; top: -5000px; visibility:hidden;">
				<label for="b_2fa0d96799c87ec50bb4d8a6d_f1b888cca2">אין למלא את השדה הבא, שנועד למניעת ספאם בלבד</label>
				<input type="text" id="b_2fa0d96799c87ec50bb4d8a6d_f1b888cca2" name="b_2fa0d96799c87ec50bb4d8a6d_f1b888cca2" value="">
			</div>
			<button class="btn" type="submit" name="subscribe">{$fields['submit']}</button>
		</div>
    </form>
NLFORM;
            return $newsletterForm;
        }

		/**
		 * Variation on printSource() from Skin.php,
		 * but gets short url, without weird encoding, not permalink/canonical url
		 *
		 * @return string HTML text with an URL
		 */
		function getPageURL() {
			$url = htmlspecialchars( wfExpandIRI( $this->getSkin()->getTitle()->getFullURL() ) );
			return wfMessage( 'retrievedfrom', '<a dir="ltr" href="' . $url . '">' . $url . '</a>' )->inContentLanguage()->text();
		}

		function getSisterSites( $self = false ) {
			global $wgWikiList, $wgLanguageCode;
			$outputList = array();
			if ( isset( $wgWikiList ) && is_array( $wgWikiList ) ) {
				foreach ($wgWikiList as $key => $val) {
					if( $self === false && $key == $wgLanguageCode ) { continue; };
					$outputList[$key]['href'] = $val['wgArticlePath'];
					$outputList[$key]['text'] = $val['wgShortSitename'];
					$outputList[$key]['linkElem'] = '<a href="' . $val['wgArticlePath'] . '">' . $val['wgShortSitename'] . '</a>';
				}
			}

			return $outputList;
		}

		function getEditorToolbarItems() {
			$listItems = '';
			$nav = $this->data['content_navigation'];

			foreach ( $nav['views'] as $key => $link ) {
				$listItems .= '<li ' . $link['attributes'] . '><a href="' . htmlspecialchars( $link['href'] ) . '" ' . $link['key'] . '>';
				// $link['text'] can be undefined - bug 27764
				if ( array_key_exists( 'text', $link ) ) {
					 $listItems .= array_key_exists( 'img', $link ) ?  '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
				}
				$listItems .= '</a></li>' . "\n";
			}

			foreach( $nav['actions'] as $link ) {
				$listItems .= '<li ' . $link['attributes'] . '><a href="' . htmlspecialchars( $link['href'] ) . '" ' . $link['key'] . '>' . htmlspecialchars( $link['text'] ) . '</a></li>';
			}
			/*
			$special = 'upload';
			if( $this->data['nav_urls'][$special] ) {
				$listItems .= '<li id="t-' . $special . '">'$link['attributes'] . '><span><a href="' . htmlspecialchars( $link['href'] ) . '" ' . $link['key'] . '>';
				<li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars( $this->data['nav_urls'][$special]['href'] ) ?>"<?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 't-' . $special ) ) ?>><?php $this->msg( $special ) ?></a></li>
			}
			$item = $this->data['personal_urls']['help'];
			<li><a href="<?php echo htmlspecialchars($item['href']) ?>"<?php if(!empty($item['class'])): ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php endif; ?>><?php echo htmlspecialchars($item['text']) ?></a></li>
=			if( isset( $editorToolBarLastMod ) ) {
				$item = $editorToolBarLastMod;
				<li id="wr-last-update"><a href="<?php echo htmlspecialchars($item['href']) ?>"<?php if(!empty($item['class'])): ?> class="<?php echo htmlspecialchars($item['class']) ?>"<?php endif; ?>><?php echo htmlspecialchars($item['text']) ?></a></li>
			}*/

			return $listItems;

		}

    function showOldEditorToolbar( Skin $skin ) {
        if( $skin->getUser()->isLoggedIn() && $skin->getUser()->isAllowed( 'edit' ) ) {
            $nav = $this->data['content_navigation'];

            if( !empty( $nav['views']['history'] ) ) {
                /* WR: Change the text for "history" on the Editor Toolbar */
                $nav['views']['history']['text'] = $this->lastModified();
            };

            $toolbarItems = array_merge( $nav['views'], $nav['actions']  );

            // Move history to last
            $v = $toolbarItems['history'];
            unset( $toolbarItems['history'] );
            $toolbarItems['history'] = $v;

            $toolbarItems['help'] = $this->makeEditorHelpLink();
            if( isset( $this->data['nav_urls']['upload'] ) ) {
                $toolbarItems['upload'] = array(
                    'href' => $this->data['nav_urls']['upload']['href'],
                    'text' => $this->getMsg( 'upload' )->text(),
                );
            }

            //

            ?>
                <div id="editorToolbar" class="noprint hidden-print hidden-xs" role="navigation">
                    <ul class="list-inline">
                        <?php foreach ( $toolbarItems as $key => $link ) {
                            if( in_array( $key, array( 'watch', 'unwatch' ) ) ) { continue; } /* WR: do not show history & watch on Editor Toolbar */ ?>
                            <li class="tb-<?php echo $key ?>"<?php echo $link['attributes'] ?>>
								<span><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
								// $link['text'] can be undefined - bug 27764
								if ( array_key_exists( 'text', $link ) ) {
									echo array_key_exists( 'img', $link ) ?  '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
								}
								?></a></span>
							</li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }
        }

    /**
     * Get the timestamp of the latest revision, formatted in user language
     * WikiRights hack: completely copied over from Skin.php
     * Only change: "$this" to "$skin"
     *
     * @return String
     */
    protected function lastModified() {
        $skin = $this->getSkin();
        $timestamp = $skin->getOutput()->getRevisionTimestamp();

        # No cached timestamp, load it from the database
        if ( $timestamp === null ) {
            $timestamp = Revision::getTimestampFromId( $skin->getTitle(), $skin->getRevisionId() );
        }

        if ( $timestamp ) {
            $d = $skin->getLanguage()->userDate( $timestamp, $skin->getUser() );
            $t = $skin->getLanguage()->userTime( $timestamp, $skin->getUser() );
            $s = ' ' . $skin->msg( 'lastmodifiedat', $d, $t )->text();
        } else {
            $s = '';
        }

        if ( wfGetLB()->getLaggedSlaveMode() ) {
            $s .= ' <strong>' . $skin->msg( 'laggedslavemode' )->text() . '</strong>';
        }

        return $s;
    }

    function makeEditorHelpLink() {
        //WR: Help page link in personal-urls.
        $currentPageUrl = $this->getSkin()->getTitle()->getLocalURL();
        $helpPage = $this->getSkin()->makeKnownUrlDetails ( $this->getMsg( 'kz-help-editor-page' )->inContentLanguage()->text() );

        $helpPageLink = array(
            'text' => $this->getMsg( 'kz-help-editor' )->text(),
            'href' => $helpPage['href'],
            'class' => $helpPage['exists'] ? false : 'new',
            'active' => ( $helpPage['href'] == $currentPageUrl )
        );

        return $helpPageLink;
    }

	function getToolbox() {
		$generalTools = array( 'whatlinkshere' => '', 'recentchangeslinked' => '', 'info' => '', 'print' => '' );
		$userTools = array( 'contributions' => '', 'log' => '', 'blockip' => '', 'emailuser' => '', 'userrights' => '' );
		$watchTools = array( 'watch' => '', 'unwatch' => '');

		$toolbox = parent::getToolbox();
		//@todo: use icon-eye-opn & icon-eye-close for watch/unwatch

		$tools['watch'] = array_intersect_key( $this->data['content_navigation']['actions'], $watchTools );
		$tools['general'] = array_intersect_key( $toolbox, $generalTools );
		$tools['user'] = array_intersect_key( $toolbox, $userTools );

		foreach( $tools as $section => $items ) {
			if ( !is_array( $items ) || empty( $items ) ) {
				unset( $tools[$section]);
			}
		}

		$out = '';

		end( $tools ); $lastKey = key( $tools );

		foreach( $tools as $section => $items ) {
			if ( $section === 'user' ) {
				$out .= '<li role="presentation" class="dropdown-header">' . $this->getMsg( 'kz-toolbox-section-user' )->text() . '</li>';
			}
			foreach ( $items as $key => $val ) {
				$out .= $this->makeListItem( $key, $val );
			}

			if( $section !== $lastKey ) {
				$out .= '<li role="presentation" class="divider"></li>';
			}

		}
		wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this, true ) );
		return $out;
	}
}
