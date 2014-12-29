<?php
if ( !defined( 'MEDIAWIKI' ) ) die();

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'DismissableSiteNotice',
	'author' => 'Brion Vibber',
	'descriptionmsg' => 'sitenotice-desc',
	'url' => 'https://www.mediawiki.org/wiki/Extension:DismissableSiteNotice',
);

$wgExtensionMessagesFiles['DismissableSiteNotice'] = __DIR__ . '/DismissableSiteNotice.i18n.php';

function wfDismissableSiteNotice( &$notice ) {
	global $wgMajorSiteNoticeID, $wgUser, $wgContLang, $wgDismissableSiteNoticeForAnons, $wgExtensionAssetsPath;

	if ( !$notice ) {
		return true;
	}

	$floatSide = $wgContLang->alignEnd();
	$oppositeFloatSide = $wgContLang->alignStart();
	$encNotice = Xml::escapeJsString($notice);
	$encClose = Xml::escapeJsString( wfMessage( 'sitenotice_close' )->text() );
	$id = intval( $wgMajorSiteNoticeID ) . "." . intval( wfMessage( 'sitenotice_id' )->inContentLanguage()->text() );

	// No dismissal for anons?
	if ( !$wgDismissableSiteNoticeForAnons && $wgUser->isAnon() ) {
		$notice = <<<HTML
<script type="text/javascript">
/* <![CDATA[ */
document.writeln("$encNotice");
/* ]]> */
</script>
HTML;
		return true;
	}

	$notice = <<<HTML
<script type="text/javascript">
/* <![CDATA[ */
var cookieName = "dismissSiteNotice=";
var cookiePos = document.cookie.indexOf(cookieName);
var floatSide = "$floatSide";
var oppositeFloatSide = "$oppositeFloatSide";
var siteNoticeID = "$id";
var siteNoticeValue = "$encNotice";
var cookieValue = "";
var msgClose = "$encClose";
var closeBtnImg = mw.config.get( 'wgExtensionAssetsPath' ) + '/DismissableSiteNotice/closewindow.png';

if (cookiePos > -1) {
	cookiePos = cookiePos + cookieName.length;
	var endPos = document.cookie.indexOf(";", cookiePos);
	if (endPos > -1) {
		cookieValue = document.cookie.substring(cookiePos, endPos);
	} else {
		cookieValue = document.cookie.substring(cookiePos);
	}
}
if (cookieValue != siteNoticeID) {
	function dismissNotice() {
		var date = new Date();
		date.setTime(date.getTime() + 30*86400*1000);
		document.cookie = cookieName + siteNoticeID + "; expires="+date.toGMTString() + "; path=/";
		var element = document.getElementById('mw-dismissable-notice');
		element.parentNode.removeChild(element);
	}
	document.writeln('<div id="mw-dismissable-notice">'
			+ '<div style="float: ' + floatSide + '; margin: 0 10px;"><a href="javascript:dismissNotice();">'
			+ '<img src="' + closeBtnImg + '" alt="' + msgClose + '" title="' + msgClose + '"></a></div>'
			+ siteNoticeValue
		+ '</div>'
	);
}
/* ]]> */
</script>
HTML;
	// Compact the string a bit
	/*
	$notice = strtr( $notice, array(
		"\r\n" => '',
		"\n" => '',
		"\t" => '',
		'cookieName' => 'n',
		'cookiePos' => 'p',
		'siteNoticeID' => 'i',
		'siteNoticeValue' => 'sv',
		'cookieValue' => 'cv',
		'msgClose' => 'c',
		'endPos' => 'e',
	));*/
	return true;
}

$wgHooks['SiteNoticeAfter'][] = 'wfDismissableSiteNotice';

$wgMajorSiteNoticeID = 1;
