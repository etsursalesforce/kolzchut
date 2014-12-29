<?php
if (!defined('MEDIAWIKI')) die();
/**
 * An extension that adds Kol-Zchut specific messsages. Originally based on [[Extension:WikimediaMessages]]
 *
 * @file
 * @ingroup Extensions
 *
 * @copyright Copyright © 2012, Dror Snir (Kol-Zchut Ltd.)
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

$wgExtensionCredits['other'][] = array(
	'path'           => __FILE__,
	'name'           => 'WRMessages',
	'author'         => 'Dror Snir ([http://www.kolzchut.org.il Kol-Zchut])',
	'version'        => '0.1',
	'url'            => 'http://www.kolzchut.org.il/he/Project:Extensions/WRMessages',
	'descriptionmsg' => 'wrmessages-desc',
);

// i18nd
$wgExtensionMessagesFiles['WRMessages'] = __DIR__ . '/WRMessages.i18n.php';
$wgExtensionMessagesFiles['WRMessagesNamespaces'] = __DIR__ . '/WRMessages.namespaces.php';
$wgExtensionMessagesFiles['WRMessagesAliases'] = __DIR__ . '/WRMessages.alias.php';

// Autoloading
$wgAutoloadClasses['WRMessagesHooks'] = __DIR__ . '/WRMessages.hooks.php';


// Hooks
$wgHooks['CanonicalNamespaces'][] = 'WRMessagesHooks::onCanonicalNamespaces';

// Namespaces
define('NS_WR_COMPANY', 110);		#DS: 16/5/2010 additional namespace to host the company's site
define('NS_WR_COMPANY_TALK', 111);
define('NS_WR_COMMUNITY', 112); 		#DS: 30/5/2010 additional namespace host knowledge communities
define('NS_WR_COMMUNITY_TALK', 113); 
define('NS_WR_PORTAL', 114);		#DS: 31/1/2011 additional namespace to host portals data (but not the portals themselves at this point). 30/5/2011 not currently used
define('NS_WR_PORTAL_TALK', 115);
define('NS_WR_DRAFTS', 116);		#DS: 12/5/2011 additional namespace to host draft articles
define('NS_WR_DRAFTS_TALK', 117);
define('NS_WR_LIMBO', 118);		#DS: 26/9/2011 additional namespace to host on-hold articles
define('NS_WR_LIMBO_TALK', 119);
define('NS_WR_PRACTICE', 120);		#DS: 1/12/2011 additional namespace: a huge sandbox
define('NS_WR_PRACTICE_TALK', 121);
define('NS_WR_DATA', 122);			#DS: 7/3/2012 additional namespace: for holding small data like "tax reduction point"
define('NS_WR_DATA_TALK', 123);


	
#DS: 28/12/2009 Enable subpages on most namespaces
$wgNamespacesWithSubpages[NS_WR_COMPANY] = true;
$wgNamespacesWithSubpages[NS_WR_COMMUNITY] = true; 
$wgNamespacesWithSubpages[NS_WR_PORTAL] = true;
$wgNamespacesWithSubpages[NS_WR_DRAFTS] = true;
$wgNamespacesWithSubpages[NS_WR_LIMBO] = true;
$wgNamespacesWithSubpages[NS_WR_PRACTICE] = true;
$wgNamespacesWithSubpages[NS_WR_DATA] = true;

$wgNamespacesWithSubpages[NS_MAIN] = true;
$wgNamespacesWithSubpages[NS_HELP] = true;
$wgNamespacesWithSubpages[NS_TEMPLATE] = true;
$wgNamespacesWithSubpages[NS_PROJECT] = true;


# Enable edit protection for some sensitive namespaces
$wgNamespaceProtection[NS_PROJECT] = array( 'editproject' ); 		# Only allow staff to edit project ("WikiRights") namespace
$wgNamespaceProtection[NS_WR_COMPANY] = array( 'editproject' );	# If allowed to edit the projet NS, allowed to edit this too
$wgNamespaceProtection[NS_TEMPLATE] = array( 'editproject' ); 		# If allowed to edit the projet NS, allowed to edit this too

# Extra security for non-public-oriented namespaces, using Extension:Lockdown (only works when it's present)
	//$wgNamespacePermissionLockdown[NS_WR_DRAFTS]['*'] = array('editor', 'staff');
	//$wgNonincludableNamespaces[] = NS_WR_DRAFTS;
	//$wgNamespacePermissionLockdown[NS_WR_LIMBO]['*'] = array('editor', 'staff');
	$wgNonincludableNamespaces[] = NS_WR_LIMBO;	
	$wgNamespacePermissionLockdown[NS_WR_PRACTICE]['*'] = array('editor', 'staff');
	$wgNonincludableNamespaces[] = NS_WR_PRACTICE;	

# Extra security for potentially private information, using Extension:Lockdown
    $wgSpecialPageLockdown['Listusers'] = array( 'staff');
    $wgSpecialPageLockdown['Activeusers'] = array( 'editor', 'staff' );
    $wgSpecialPageLockdown['BlockList'] = array( 'editor', 'staff' );
    $wgSpecialPageLockdown['Log'] = array( 'editor', 'staff' );
    $wgSpecialPageLockdown['LinkSearch'] = array( 'editor', 'staff' );
    $wgSpecialPageLockdown['Export'] = array( 'editor', 'staff' );


# Disable search engines indexing
$wgNamespaceRobotPolicies[NS_MAIN] 		= 'index,follow';
$wgNamespaceRobotPolicies[NS_PROJECT] 		= 'index,follow';
$wgNamespaceRobotPolicies[NS_WR_COMPANY] 		= 'index,follow';
$wgNamespaceRobotPolicies[NS_WR_COMMUNITY] 	= 'index,follow';
