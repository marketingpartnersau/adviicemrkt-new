var app = (function(document, $) {

	'use strict';
	var docElem = document.documentElement,

		_userAgentInit = function() {
			docElem.setAttribute('data-useragent', navigator.userAgent);
		},
		_init = function() {
			$(document).foundation();
			_userAgentInit();
		},
		_submitJoin = function(){
			$('form').on('submit', function(evt, s){
				evt.preventDefault();
				var data = $(this).serializeArray();

				var self = $(this);

				$.post('handler.php', data)
				.success(function(result){
					if(result.hasOwnProperty('success')){
						self.parents('.form-parent').addClass('done');
					}
				});

				

			});
		};

	return {
		init: _init,
		join: _submitJoin
	};

})(document, jQuery);

(function() {

	'use strict';
	
	app.init();
	app.join();

})();