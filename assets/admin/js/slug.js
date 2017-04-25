(function($) {

    jQuery.fn.slug = function(options) {	
	
		var settings = {
			slug: 'slug'		
		};
		
		if(options) {
			jQuery.extend(settings, options);
		}
		
		$this = jQuery(this);
		
		var slugfy = function() {
			
			str = $this.val();
			str = str.replace(/^\s+|\s+$/g, ''); 
			str = str.toLowerCase();	  
			
			var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/-,:;_";
			var to   = "aaaaaeeeeeiiiiooooouuuunc_______";
			
			for (var i=0, l=from.length ; i<l ; i++) {
			  str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
			}
		  
			str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '_').replace(/-+/g, '_');
		  
			jQuery('#' + settings.slug).val(str);
		};
			
		jQuery(this).keyup(slugfy);
		jQuery(this).keydown(slugfy);
		jQuery(this).focus(slugfy);
		jQuery(this).blur(slugfy);
		jQuery(this).click(slugfy);
			
		return $this;
	};

})(jQuery);
