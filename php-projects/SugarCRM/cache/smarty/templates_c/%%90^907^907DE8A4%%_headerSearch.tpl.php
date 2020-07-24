<?php /* Smarty version 2.6.11, created on 2012-12-06 17:25:41
         compiled from themes/Sugar5/tpls/_headerSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'themes/Sugar5/tpls/_headerSearch.tpl', 45, false),)), $this); ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
<div id="search">
    <form name='UnifiedSearch' action='index.php' onsubmit='return SUGAR.unifiedSearchAdvanced.checkUsaAdvanced()'>
        <input type="hidden" name="action" value="UnifiedSearch">
        <input type="hidden" name="module" value="Home">
        <input type="hidden" name="search_form" value="false">
        <input type="hidden" name="advanced" value="false">
        <?php echo smarty_function_sugar_getimage(array('name' => 'searchMore','ext' => ".gif",'alt' => $this->_tpl_vars['APP']['LBL_SEARCH'],'other_attributes' => 'border="0" id="unified_search_advanced_img" '), $this);?>
&nbsp;
        <input type="text" name="query_string" id="query_string" size="20" value="<?php echo $this->_tpl_vars['SEARCH']; ?>
">&nbsp;
        <input type="submit" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
">
    </form><br />
    <div id="unified_search_advanced_div"> </div>
</div>
<div id="sitemapLink">
    <span id="sitemapLinkSpan">
        <?php echo $this->_tpl_vars['APP']['LBL_SITEMAP']; ?>

        <?php echo smarty_function_sugar_getimage(array('name' => 'MoreDetail','alt' => $this->_tpl_vars['app_strings']['LBL_MOREDETAIL'],'ext' => ".png",'other_attributes' => ''), $this);?>

    </span>
</div>
<span id='sm_holder'></span>
<?php endif; ?>