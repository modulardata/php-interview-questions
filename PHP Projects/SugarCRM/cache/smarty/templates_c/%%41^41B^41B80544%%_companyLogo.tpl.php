<?php /* Smarty version 2.6.11, created on 2012-12-06 17:25:41
         compiled from themes/Sugar5/tpls/_companyLogo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'themes/Sugar5/tpls/_companyLogo.tpl', 41, false),)), $this); ?>
<div id="companyLogo">
    <a href="index.php?module=Home&action=index" border="0">
    <img src="<?php echo $this->_tpl_vars['COMPANY_LOGO_URL']; ?>
" width="<?php echo $this->_tpl_vars['COMPANY_LOGO_WIDTH']; ?>
" height="<?php echo $this->_tpl_vars['COMPANY_LOGO_HEIGHT']; ?>
"
        alt="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_COMPANY_LOGO'), $this);?>
" border="0"/>
    </a>
</div>