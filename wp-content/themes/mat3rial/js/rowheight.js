$('.day[data-match-height]').each(function(){
		console.log('hi');
		var self = $(this);
		self.find('.calendar-event').height(self.height());
		$(window).on('resize', function(event) {
			var row_width = self.width();
			var panels = self.find('.calendar-event');
			// Reset height of the panels
			panels.height('');
			var h = self.height();
			panels.each(function() {
			var panel = $(this);
			if ((row_width - panel.width()) > 40) {
				panel.height(h);
			}
			});
		});
		});