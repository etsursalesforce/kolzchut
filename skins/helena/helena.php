<?php
/**
 * Helena skin
 * Next-generation design for Kol-Zchut
 * Graphics design by Moshe Liberman Design Studio
 *
 * @todo everything!
 * @file
 * @ingroup Skins
 * @author Dror Snir (Kol-Zchut Ltd., CIC)
 * @license License not yet decided!
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}


$GLOBALS['wgExtensionCredits']['skin'][] = array(
        'path' => __FILE__,
        'name' => 'Helena',
        //'url' => "...",
        'author' => '[http://www.kolzchut.org.il/he/User:דרור_שניר Dror Snir] for [http://www.kolzchut.org.il Kol-Zchut]',
        'descriptionmsg' => 'helena-desc',
);

$GLOBALS['wgValidSkinNames']['helena'] = 'Helena';
$GLOBALS['wgAutoloadClasses']['SkinHelena'] = __DIR__ . '/Helena.skin.php';
$GLOBALS['wgExtensionMessagesFiles']['SkinHelena'] = __DIR__ . '/Helena.skin.i18n.php';


/* Sensible defaults, in case these aren't set */
/*
global $wgStyleDirectory, $wgStylePath, $wgScriptPath;
if ( !isset( $wgStyleDirectory ) || $wgStyleDirectory === false ) {
	$wgStyleDirectory = "$IP/skins";
}
if ( !isset( $wgStylePath ) || $wgStylePath === false ) {
    $wgStylePath = "$wgScriptPath/skins";
}
*/

global $wgResourceModules;
$egHelenaResource = array(
	'remoteBasePath' => $GLOBALS['wgStylePath'] . '/helena/modules',
	'localBasePath' => __DIR__ . '/modules',
);

$wgResourceModules['skins.helena.js'] = $egHelenaResource + array(
	'scripts' => array( 'helena/helena.js' ),
	'dependencies' => array( 'skins.helena.bootstrap.js',
		'jquery.equalizeCols',
		//'skins.helena.jquery.textResize'
	),
	'messages' => array(
		'kz-mainpage-search-placeholder',
		'kz-mainpage-search-placeholder-long',
	)
);

$wgResourceModules['skins.helena.bootstrap'] = $egHelenaResource + array(
	'styles' => array(
		'bootstrap/css/bootstrap.no-icons.css' => array( 'media' => 'all' ),
	),
);
/* Do not change this name! for some reason, RL does alphabetic sorting,
 * so this makes sure it comes after bootstrap
 */
$wgResourceModules['skins.helena.bootstrapOverride'] = $egHelenaResource + array(
	'styles' => array(
		'helena/helena.less',
		'helena/print.css' => array( 'media' => 'print' )
	),
);

$wgResourceModules['skins.helena'] = array(
	'styles' => array(
		//'common/commonElements.css' => array( 'media' => 'screen' ),
		'common/commonContent.css' => array( 'media' => 'screen' ),
		'common/commonInterface.css' => array( 'media' => 'screen' ),
	),
	'remoteBasePath' => $wgStylePath,
	'localBasePath' => $wgStyleDirectory,
);

$wgResourceModules['skins.helena.bootstrap.js'] = $egHelenaResource + array(
	'scripts' => array(
		'bootstrap/js/bootstrap.js',	
	),
);

$wgResourceModules['skins.helena.fontAwesome'] = $egHelenaResource + array(
	'styles' => array(
		'fontAwesome/css/font-awesome.css' => array( 'media' => 'all' ),
	),
	'position' => 'top',
);

$wgResourceModules['jquery.equalizeCols'] = $egHelenaResource + array(
	'scripts' => 'jquery/equalizeCols.js',
	'position' => 'top',
);

/*
$wgResourceModules['skins.helena.jquery.textResize'] = $egHelenaResource + array(
	'scripts' => 'jquery/textResize.js',
	'styles' => 'jquery/textResize.less',
	'position' => 'top',
);
*/


# Default options to customize skin
$egHelenaEnableFacebook = true;
