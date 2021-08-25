<?php /* Smarty version 2.6.11, created on 2012-12-06 17:30:04
         compiled from modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedScript.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedScript.tpl', 123, false),)), $this); ?>


<?php echo '
<script type="text/javascript">
if(typeof SugarFeed == \'undefined\') { // since the dashlet can be included multiple times a page, don\'t redefine these functions
	SugarFeed = function() {
	    return {
	    	/**
	    	 * Called when the textarea is blurred
	    	 */
	        pushUserFeed: function(id) {
	        	ajaxStatus.showStatus(\'';  echo $this->_tpl_vars['saving'];  echo '\'); // show that AJAX call is happening
	        	// what data to post to the dashlet
    	    	
    	    	postData = \'to_pdf=1&module=Home&action=CallMethodDashlet&method=pushUserFeed&id=\' + id ;
				YAHOO.util.Connect.setForm(document.getElementById(\'form_\' + id));
				var cObj = YAHOO.util.Connect.asyncRequest(\'POST\',\'index.php\', 
								  {success: SugarFeed.saved, failure: SugarFeed.saved, argument: id}, postData);
	        },
		    /**
	    	 * handle the response of the saveText method
	    	 */
	        saved: function(data) {
	        	SUGAR.mySugar.retrieveDashlet(data.argument);
	           	ajaxStatus.flashStatus(\'';  echo $this->_tpl_vars['done'];  echo '\');
	        }, 
	        deleteFeed: function(record, id){
				postData = \'to_pdf=1&module=Home&action=CallMethodDashlet&method=deleteUserFeed&id=\' + id + \'&record=\' +  record;
				var cObj = YAHOO.util.Connect.asyncRequest(\'POST\',\'index.php\', 
								  {success: SugarFeed.saved, failure: SugarFeed.saved, argument: id}, postData);	        
	        },
            buildReplyForm: function(record, id, elem) {
               // See if we already have a blockquote
               var myParentElem = elem.parentNode.parentNode.parentNode;
               
               var blockElem = myParentElem.getElementsByTagName(\'blockquote\')[0];
               if ( typeof(blockElem) == \'undefined\' || typeof(blockElem[0]) == \'undefined\' ) {
                  // Need to create a blockquote element
                  // With a "clear" div in front of it.
                  var divElem = document.createElement(\'div\');
                  divElem.className = \'clear\';
                  myParentElem.appendChild(divElem);
                  blockElem = document.createElement(\'blockquote\');
                  myParentElem.appendChild(blockElem);
               } else {
                 // Should only be one child blockquote element, so we\'ll just grab the first one
                 blockElem = blockElem[0];
               }

               // Move the reply form up over here
               var formElem = document.getElementById(\'SugarFeedReplyForm_\'+id);
               formElem.parentNode.removeChild(formElem);
               blockElem.appendChild(formElem);
               formElem.getElementsByTagName(\'div\')[0].style.display = \'block\';
               formElem.parentFeed.value = record;

            },
            replyToFeed: function( id ) {
	        	ajaxStatus.showStatus(\'';  echo $this->_tpl_vars['saving'];  echo '\'); // show that AJAX call is happening
	        	// what data to post to the dashlet
    	    	
                var formElem = document.getElementById(\'SugarFeedReplyForm_\' + id);
    	    	postData = \'to_pdf=1&module=Home&action=CallMethodDashlet&method=pushUserFeedReply&id=\' + id ;
				YAHOO.util.Connect.setForm(formElem);
				var cObj = YAHOO.util.Connect.asyncRequest(\'POST\',\'index.php\', 
								  {success: SugarFeed.saved, failure: SugarFeed.saved, argument: id}, postData);
               
            },
            loaded: function(id) {
            	var scrollConent;
            	scrollContent = new iScroll(\'contentScroller\' + id);
            }
	    };
	}();
}

if(SUGAR.util.isTouchScreen()) {
	document.addEventListener(\'DOMContentLoaded\', function(){SugarFeed.loaded(\'';  echo $this->_tpl_vars['idjs'];  echo '\')}, false);	
}
</script>
'; ?>

<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "include/javascript/popup_helper.js"), $this);?>
">
</script>