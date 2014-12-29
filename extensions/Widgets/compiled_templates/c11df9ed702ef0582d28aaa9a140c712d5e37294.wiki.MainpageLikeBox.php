<?php /* Smarty version Smarty-3.1.7, created on 2014-12-02 14:19:59
         compiled from "wiki:MainpageLikeBox" */ ?>
<?php /*%%SmartyHeaderCode:96273127554774399367f11-58096568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c11df9ed702ef0582d28aaa9a140c712d5e37294' => 
    array (
      0 => 'wiki:MainpageLikeBox',
      1 => 20141105193726,
      2 => 'wiki',
    ),
  ),
  'nocache_hash' => '96273127554774399367f11-58096568',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5477439943509',
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5477439943509')) {function content_5477439943509($_smarty_tpl) {?>
<script>
var fbWidth;
var resizeTimeout;

function attachFluidLikeBox() {
	"use strict";
	var $likeBox = $( '.fb-like-box-mainpage' );
	var $container = $likeBox.parent();	// the containing element in which the Likebox resides

	// we should only redraw if the width of the container has changed
	if ( fbWidth !== $container.width() ) {
		//$container.empty(); // we remove any previously generated markup

		fbWidth = $container.width(); // store the width for later comparison
		$likeBox.attr( 'data-width', fbWidth );
		try {
			FB.XFBML.parse( $container[0] );
		} catch ( err ) {
			// should Facebook's API crap out - wouldn't be the first time
		}
	}
}

function onResizeFluidLikeBox() {
	"use strict";
	if( resizeTimeout ){
		clearTimeout( resizeTimeout );
	}
	resizeTimeout = setTimeout( attachFluidLikeBox, 200 );    // performance: we don't want to redraw/recalculate as the user is dragging the window
}

$(window).resize( onResizeFluidLikeBox );
$(document).ready( onResizeFluidLikeBox );

</script>
<div class="fb-like-box fb-like-box-mainpage" data-href="https://www.facebook.com/<?php echo str_replace("%2F", "/", rawurlencode((($tmp = @$_smarty_tpl->tpl_vars['page']->value)===null||$tmp==='' ? 'kolzchut' : $tmp)));?>
" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
<?php }} ?>