# Helena skin

## About ##
The Helena skin for MediaWiki is the next-generation design for Kol-Zchut.<br />
Helena is based on Twitter Bootstrap, to create a responsive website suited to mobile as well as desktop.

## Credits ##
Coded by Dror S. ("ffs") for Kol-Zchut Ltd.,
designed by Moshe Liberman Design Studio.

## Information ##

### Settings
- $wgWikiList - array for describing wikis in family. The key is the internal name / interwiki code.
- $wgWrGuidesLink - page/url to use for the "Guides" sidebar button

### Hooks
- SkinHelenaSidebar::Start - just as sidebar content starts (inside a \<UL\>)
- SkinHelenaSidebar::Buttons( &$template, &$buttons ) - additional buttons to add on sidebar
- SkinHelenaSidebar::End - just as sidebar content ends (before the \</UL\>)
