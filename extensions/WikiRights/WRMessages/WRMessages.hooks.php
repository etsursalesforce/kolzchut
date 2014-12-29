<?php

class WRMessagesHooks {
	/**
	* For extensions adding their own namespaces or altering the defaults.
	* @see https://www.mediawiki.org/wiki/Manual:Hooks/CanonicalNamespaces
	*
	* @param array $list
	*
	* @return true
	*/
	public static function onCanonicalNamespaces( array &$list ) {
		$list[NS_WR_COMPANY] = 'אודות'; 
		$list[NS_WR_COMPANY_TALK] = 'שיחת_אודות';
		$list[NS_WR_COMMUNITY] = 'קהילת_ידע';
		$list[NS_WR_COMMUNITY_TALK] = 'שיחת_קהילת_ידע';
		$list[NS_WR_PORTAL] = 'פורטל';
		$list[NS_WR_PORTAL_TALK] = 'שיחת_פורטל';
		$list[NS_WR_DRAFTS] = 'חדש';
		$list[NS_WR_DRAFTS_TALK] = 'שיחת_חדש';
		$list[NS_WR_LIMBO] = 'הקפאה';
		$list[NS_WR_LIMBO_TALK] = 'שיחת_הקפאה';
		$list[NS_WR_PRACTICE] = 'תרגול';
		$list[NS_WR_PRACTICE_TALK] = 'שיחת_תרגול';
		$list[NS_WR_DATA] = 'נתון';
		$list[NS_WR_DATA_TALK] = 'שיחת_נתון';
		
		return true;
	}
}
