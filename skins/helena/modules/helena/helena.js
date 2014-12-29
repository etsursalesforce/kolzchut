/*
$( document ).scroll( function () {
	var pageScroll = parseInt( $( document ).scrollTop() );
	var wrapperHeight = $("#sidebar-main").height();

	if( pageScroll > wrapperHeight ) {
		$("#sidebar-main").css({'position':'fixed'});
	};
});
*/

/* global mediaWiki */

/* jshint jquery:true */
/* global mediaWiki */
( function ( mw, $ ) {
	"use strict";

	mw.helena = {
		pageType: null,

		getPageType: function() {
			if( mw.helena.pageType !== null ) { return mw.helena.pageType; }

			var bodyClasses = $( 'body').attr( 'class' );
			var type = bodyClasses.match( /article-type-(\w*)/)[1];

			mw.helena.pageType = type;
			return type;
		},

		isMobile: function() {
			return $(window).width() < 960;
		}

	};

}( mediaWiki, jQuery ) );


$(document).ready(function() {
    /* global mw */
    "use strict";

	detectIOS();

    hideLabledSectionTransclusionFakeHeading();
    showPerGroupRestrictedContent();

	$('[rel="popover"]').popover({
		html: true,
		//just for portals-list - container: '#content',
		animation: false,
		content: function() {
			var target = $(this).attr( 'data-target' );
			if( target ) {
				return $( target ).html();
            }
            return 'error';
		}
	});
});

function detectIOS() {
	"use strict";
	// Now safe to use the PhoneGap API
	if (navigator.userAgent.match(/(iPod|iPhone|iPad)/i)) {
		$(document.body).addClass('iOS-device');
	}
}

function equalizeSummaryRow() {
    "use strict";
    var $elements;
    if( !mw.helena.isMobile() || $( '.article-forms').length === 0 ) {
        $elements = $( '.intro-box' );
    } else {
        $elements = $( '.article-see-also > .intro-box, .article-forms > .intro-box');
    }

	$elements.css( 'height', '' );
    $elements.equalizeCols();
}

function equalizePortalBoxes( $portalBoxes ) {
    "use strict";
    if( $( window ).width() >= 768 ) {
        mw.loader.using( 'jquery.equalizeCols', function() {
            var rowNum = 0;
            while( rowNum < $portalBoxes.length / 3 ) {
                var $row = $portalBoxes.slice( rowNum*3, (rowNum+1)*3 );
                $row.find('.portal-box-header').equalizeCols()
                    .find( 'h2').css({
                        'position': 'absolute',
                        'bottom': 0
                    });
                $row.find('.portal-box-inner').equalizeCols();
                rowNum++;
            }
        });
    } else {
		$( '.portal-box-inner, .portal-box-header' ).css( 'height', '' );
	}
}

function equalizeMainPageBoxes() {
	"use strict";
	var $elementGroups = [];

	$elementGroups.push( $( '.mainpage-portals-box-inner' ) );
	$elementGroups.push( $( '.mainpage-promotion-box' ).find( '.inner') );
	//$elementGroups.portalBoxes = $( '.mainpage-portals-box-inner' );
	//$elementGroups.promotions = $( '.mainpage-promotion-box' ).find( '.inner');

	$.each( $elementGroups, function( $index, $group ) {
		if( $( window ).width() >= 768 ) {
			$group.equalizeCols();
		} else {
			$group.css( 'height', '' );
		}
	});
/*
	$( '.main-link, .more-portals-link').css({
		'position': 'absolute',
		'bottom': 0
	});
	*/

}


function hideLabledSectionTransclusionFakeHeading() {
    "use strict";
    $( '#endarticle.mw-headline').parent().css('display', 'none');
}

function showPerGroupRestrictedContent() {
    "use strict";
    var wgUserGroups = mw.config.get( 'wgUserGroups' );

	// Content for anon/non-editor users
	if( $.inArray( 'editor', wgUserGroups ) === -1 ) {
		$( '.non-editor-content' ).css( 'display', 'block' );
	}

    $.each( wgUserGroups, function( index, value) {
        if ( value !== '*' ) {  //Ignore the '*' (everybody) group
            $( '.' + value + '-only-content').css( 'display', 'block' );
        }
    });
}


( function ( mw, $ ) {
    "use strict";
	if( mw.config.get( 'wgIsMainPage') === true ) {
		var $searchBtn = $('#bodySearchInputJumbo');
		if ($searchBtn.length !== -1) {
			var placeholderMsgName = 'kz-mainpage-search-placeholder';
			placeholderMsgName += ( $(window).width() >= 768 ) ? '-long' : '';
			var searchPlaceholder = mw.message(placeholderMsgName).text();
			$searchBtn.attr('placeholder', searchPlaceholder);
		}
	}

	equalizeSummaryRow();
	$( window ).resize( equalizeSummaryRow );

	var $portalBoxes = $( '.portal-box' );
    if( $portalBoxes.length !== 0 ) {
		equalizePortalBoxes( $portalBoxes );
        $( window ).resize( $.proxy( equalizePortalBoxes, null, $portalBoxes ) );
    }

	if( mw.config.get( 'wgIsMainPage') === true ) {
		equalizeMainPageBoxes();
		$( window ).resize( equalizeMainPageBoxes );
	}

    $( ".search-top-collapse").on( 'shown.bs.collapse', function() {
        $( this ).find( 'input[name=search]' ).focus();
    });
}( mediaWiki, jQuery ) );

( function ( mw, $ ) {
	"use strict";

	var navbarHeight = $(".navbar-fixed-top").height();

	var jumpLinksWithFixedHeader = function() {
		var target = window.location.hash;
		if( target !== '' && target !== '#' ){
			target = target.replace(/([ {}\|`\^@\?%;&,.+*~':"!^$[\]()=>|\/])/g,'\\$1');
			if ( $(target).length > 0 ) {
				var gotoY = Math.round($(target).offset().top - navbarHeight - 10);
				//mw.log( 'currently: ' + $(window).scrollTop() + ', go to: ' + gotoY );
				window.scrollTo(0, gotoY);
			}
		}

		/*
		window.scrollBy(0, -navbarHeight - 10 );
		*/
	};

	jumpLinksWithFixedHeader();

	$(window).on('hashchange', function () {
		window.setTimeout( jumpLinksWithFixedHeader, 10 );
	});

}( mediaWiki, jQuery ) );
