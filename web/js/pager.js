$(function() {
	var Pager = {};
	Pager.start = function() {
	    this.paragraphsPerPage = 3;
	    this.currentPage = 1;
	    this.pagingControlsContainer = '#pagingControls';
	    this.pagingContainerPath = '#listing-content';

	    this.numPages = function() {
	        var numPages = 0;
	        if (this.paragraphs != null && this.paragraphsPerPage != null) {
	            numPages = Math.ceil(this.paragraphs.length / this.paragraphsPerPage);
	        }

	        return numPages;
	    };

	    this.showPage = function(page) {
	        this.currentPage = page;
	        var html = '';

	        this.paragraphs.slice((page-1) * this.paragraphsPerPage,
	            ((page-1)*this.paragraphsPerPage) + this.paragraphsPerPage).each(function() {
	            html += '<div>' + $(this).html() + '</div>';
	        });

	        $(this.pagingContainerPath).html(html);

	        renderControls(this.pagingControlsContainer, this.currentPage, this.numPages());
	    }

	    var renderControls = function(container, currentPage, numPages) {
	        var pagingControls = '<ul class="pageList">',
	        	classCurrent;
	        for (var i = 1; i <= numPages; i++) {
                classCurrent = (currentPage === i)? 'class="current"' : '';
                pagingControls += '<li><a href="javascript:void(0)" '+ classCurrent +' data-page="'+ i +'">' + i + '</a></li>';
	        }

	        pagingControls += '</ul>';

	        $(container).html(pagingControls);
	    }

	    this.bindEvents = function() {
	    	var that = this;
	    	$(this.pagingControlsContainer).on('click', '.pageList li a', function(e) {
	    		var page = $(e.currentTarget).data('page');
	    		that.showPage(page);
	    	});
	    }
	}
	//See more at: http://www.script-tutorials.com/how-to-create-easy-pagination-with-jquery/#sthash.R3YTtIer.dpuf

	// Initialize pager
	var pager = new Pager.start();
    pager.paragraphsPerPage = 10; // set amount elements per page
    pager.pagingContainer = $('.row'); // set of main container
    pager.paragraphs = $('div.listing-item', pager.pagingContainer); // set of required containers
    pager.bindEvents();
    pager.showPage(1);
});
