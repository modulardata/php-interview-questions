<?php /* Smarty version 2.6.11, created on 2012-12-06 17:29:59
         compiled from themes/Sugar5/tpls/_headerShortcuts.tpl */ ?>
<?php if (count ( $this->_tpl_vars['SHORTCUT_MENU'] ) > 0): ?>
<div id="shortcuts" class="headerList">
    <b style="white-space:nowrap;"><?php echo $this->_tpl_vars['APP']['LBL_LINK_ACTIONS']; ?>
:&nbsp;&nbsp;</b>
    <span>
    <?php $_from = $this->_tpl_vars['SHORTCUT_MENU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <span style="white-space:nowrap;">
        <?php if ($this->_tpl_vars['item']['URL'] == "-"): ?>
          <a></a><span>&nbsp;</span>
        <?php else: ?>
          <a href="<?php echo $this->_tpl_vars['item']['URL']; ?>
"><?php echo $this->_tpl_vars['item']['IMAGE']; ?>
&nbsp;<span><?php echo $this->_tpl_vars['item']['LABEL']; ?>
</span></a>
        <?php endif; ?>
    </span>
    <?php endforeach; endif; unset($_from); ?>
    </span>
</div>
<?php endif; ?>