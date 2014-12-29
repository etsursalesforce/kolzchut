<?php

require_once( "$IP/extensions/WikiRights/WRMessages/WRMessages.php" );	// Kol-Zchut specific messages
require_once( "$IP/extensions/DismissableSiteNotice/DismissableSiteNotice.php" );	#allows users to hide the optional site notice.
	$wgDismissableSiteNoticeForAnons = true; # Allow the same for anonymous users
require_once( "$IP/extensions/InputBox/InputBox.php" );
require_once( "$IP/extensions/LabeledSectionTransclusion/lst.php" );			# Enable Section Transclusion
require_once( "$IP/extensions/LabeledSectionTransclusion/lsth.php" );			# Enable Section Transclusion by header
require_once( "$IP/extensions/PipeEscape/PipeEscape.php" );						# Extra parser func to escape pipes {{!:}}
require_once( "$IP/extensions/Loops/Loops.php" );								# Loop function. We use it mainly to process multiple variables in templates
require_once( "$IP/extensions/Variables/Variables.php");						# Allows storing in-page variables. Used together with Loops and makes templating easier
###require_once( "$IP/extensions/WikiRights/RemoveRedlinks/RemoveRedlinks.php" ); 			# Prevent Red Links (used for anons)
	###$wgRemoveRedLinksExemptGroups = array( 'editor', 'staff' );
require_once( "$IP/extensions/MultiBoilerplate/MultiBoilerplate.php" );			# Allows loading standard templates into edit form
	$wgMultiBoilerplateOptions = false; #Using page "MediaWiki:Multiboilerplate"
require_once("$IP/extensions/EmbedVideo/EmbedVideo.php");			# Video embedding from popular sites (e.g. YouTube)
require_once("$IP/extensions/Widgets/Widgets.php");
	$wgGroupPermissions['sysop']['editwidgets'] = true;
require_once( "$IP/extensions/WikiRights/WRLanguageLinks/WRLanguageLinks.php" );
	 $wgWRLanguageLinksListType = 'flat';


require_once( "$IP/extensions/WikiRights/AltLangRelLinks/AltLangRelLinks.php" ); # link rel="alternate" for language links
require_once "$IP/extensions/ImageMap/ImageMap.php";
require_once("$IP/extensions/AutoCreateCategoryPages/AutoCreateCategoryPages.php");
    $wgAutoCreateCategoryText = '{{דף קטגוריה | מוסתרת = לא|}}';

require_once( "$IP/extensions/PageNotice/PageNotice.php" );

/* Special Pages */
require_once( "$IP/extensions/ReplaceText/ReplaceText.php" ); 					# Enable Text Search & Replace (special page)
require_once( "$IP/extensions/UserMerge/UserMerge.php" );						# Allows merging and deleting users
//require_once("$IP/extensions/Renameuser/Renameuser.php");
require_once( "$IP/extensions/ExpandTemplates/ExpandTemplates.php" );


# Settings for extensions included by role
	$wgCategoryTreeMaxChildren = 500;
	$wgGroupPermissions['sysop']['interwiki'] = true; # Allow sysops to edit the interwiki table

require_once("$IP/skins/helena/helena.php");
	//Hide TOC:
	$wgMaxTocLevel = 0;
	$wgDefaultUserOptions['showtoc'] = false;
	$wgHiddenPrefs[] = 'showtoc';
	$wgDefaultSkin = "helena";
	$wgWrGuidesLink = 'מדריכים וזכותונים';

require_once("$IP/extensions/CustomData/CustomData.php");       // Dependency of WRArticleType
require_once("$IP/extensions/WikiRights/WRArticleType/WRArticleType.php"); // Add article type to HTML <body> classes

require_once( "$IP/extensions/WikiRights/Promoter/Promoter.php" );
	$wgPromoterFallbackCampaign = 'כללי';

require_once( "$IP/extensions/WikiRights/WRGoogleSearch/WRGoogleSearch.php" );
	$wgWRGoogleSearchCSEID = '001927623258473268211:ifuvz_2jfgc'; #Hebrew
	#$wgWRGoogleSearchOnly = true;
	$wgWRGoogleSearchExemptGroups = array( 'editor', 'staff', 'holocaustauthority' );

require_once( "$IP/extensions/WikiRights/ShareBar/ShareBar.php" );
	$egShareBarServices['feedback']['url'] = 'https://docs.google.com/spreadsheet/embeddedform?formkey=dFpWdUhueTdmODNHZU9nd3ZubzBmR0E6MQ';
	$egShareBarServices['donate']['url'] = 'https://www.israeltoremet.org/makedonation/514463348';

require_once( "$IP/extensions/WikiRights/WRApprovedRevs/ApprovedRevs.php" );	# Approved page revisions
	$wgApprovedRevsShowOnlyToMembers = false;

require_once( "$IP/extensions/ParserFunctions/ParserFunctions.php" );
    $wgPFEnableStringFunctions = true; #Enable use of String Functions, included in ParserFunctions
