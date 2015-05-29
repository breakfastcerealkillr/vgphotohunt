	$(document).ready(function() {
		$(".fancybox")
                
                .fancybox({
                    helpers : {
                        title: {
                            type: 'inside'
                        }
                    },
                    beforeLoad: function() {
                        var el, id = $(this.element).data('title-id');

                        if (id) {
                            el = $('#' + id);

                            if (el.length) {
                                this.title = el.html();
                            }
                        }
                    }
                });
	});