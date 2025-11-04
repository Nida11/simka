/*
 * table search v2-beta
 *-------------------------------
 * @author : AMP - RSHS2015
 *
*/

$(function($){

	$.fn.tableComponent = function(setting){

		if( this.length == 0 ) return;

		var parent_selector = this;
		var placeholder = null;
		var word_count_tolerance = 1;
		var defaults = {
	     	firstArrow: "",
	    	prevArrow: "",
	      	lastArrow: "",
	      	nextArrow: "",
	      	rowsPerPage: 15,
	      	currPage: 1,
	      	optionsForRows: [5, 10, 20, 30, 40, 50, 100, 200, 500],
	      	ignoreRows: [],
	      	topNav: false
	    };
	    var pagination_status = (setting.pagination && setting.pagination==true) ? true : false;
	    if(pagination_status){
		    settings = $.extend(defaults, setting);
		    var table = $(this)[0];
			var totalPagesId = '#tablePagination_totalPages';
			var currPageId = '#tablePagination_currPage';
			var rowsPerPageId = '#tablePagination_rowsPerPage';
			var firstPageId = '#tablePagination_firstPage';
			var prevPageId = '#tablePagination_prevPage';
			var nextPageId = '#tablePagination_nextPage';
			var lastPageId = '#tablePagination_lastPage';
			var tblLocation = (defaults.topNav) ? "prev" : "next";
			var possibleTableRows = $.makeArray($('tbody tr:not(.hide)', table));
			var tableRows = $.grep(possibleTableRows, function(value, index) {
				return ($.inArray(value, defaults.ignoreRows) == -1);
			}, false)
			var numRows = tableRows.length
			var totalPages = resetTotalPages();
			var currPageNumber = (defaults.currPage > totalPages) ? 1 : defaults.currPage;
			if ($.inArray(defaults.rowsPerPage, defaults.optionsForRows) == -1){
				defaults.optionsForRows.push(defaults.rowsPerPage);
			}
	    }

		function hideOtherPages(pageNum) {
			if (pageNum == 0 || pageNum > totalPages){		
			  return;
			}
			var startIndex = (pageNum - 1) * defaults.rowsPerPage;
			var endIndex = (startIndex + defaults.rowsPerPage - 1);
			$(tableRows).show();
			for (var i = 0; i < tableRows.length; i++) {
			  if (i < startIndex || i > endIndex) {
			    $(tableRows[i]).hide()
			  }
			}
		}

		function reset_dynamic_layout(){
			possibleTableRows = $.makeArray($('tbody tr:not(.hide)', table));
			tableRows = $.grep(possibleTableRows, function(value, index) {
				return ($.inArray(value, defaults.ignoreRows) == -1);
			}, false)
			numRows = tableRows.length
			totalPages = resetTotalPages();
			currPageNumber = (defaults.currPage > totalPages) ? 1 : defaults.currPage;
			if ($.inArray(defaults.rowsPerPage, defaults.optionsForRows) == -1){
				defaults.optionsForRows.push(defaults.rowsPerPage);
			}
			resetPerPageValues();
			hideOtherPages(1);
		}

		function resetTotalPages() {
			var preTotalPages = Math.round(numRows / defaults.rowsPerPage);
			var totalPages = (preTotalPages * defaults.rowsPerPage < numRows) ? preTotalPages + 1 : preTotalPages;
			if ($(table)[tblLocation]().find(totalPagesId).length > 0)
			  $(table)[tblLocation]().find(totalPagesId).html(totalPages);
			return totalPages;
		}

		function resetCurrentPage(currPageNum) {
			if (currPageNum < 1 || currPageNum > totalPages)
			  return;
			currPageNumber = currPageNum;
			hideOtherPages(currPageNumber);
			$(table)[tblLocation]().find(currPageId).val(currPageNumber)
		}

		function resetPerPageValues() {
			var isRowsPerPageMatched = false;
			var optsPerPage = defaults.optionsForRows;
			optsPerPage.sort(function(a, b) {
			  return a - b;
			});
			var perPageDropdown = $(table)[tblLocation]().find(rowsPerPageId)[0];
			perPageDropdown.length = 0;
			for (var i = 0; i < optsPerPage.length; i++) {
			  if (optsPerPage[i] == defaults.rowsPerPage) {
			    perPageDropdown.options[i] = new Option(optsPerPage[i], optsPerPage[i], true, true);
			    isRowsPerPageMatched = true;
			  } else {
			    perPageDropdown.options[i] = new Option(optsPerPage[i], optsPerPage[i]);
			  }
			}
			if (!isRowsPerPageMatched) {
			  defaults.optionsForRows == optsPerPage[0];
			}
		}

		function createPaginationElements() {
			var htmlBuffer = [];
			htmlBuffer.push("<div id='tablePagination'>");

			  htmlBuffer.push("<div class='pagination_object_item'>");
			    htmlBuffer.push("<div id='tablePagination_paginater'>");
			    htmlBuffer.push("  ");
			    htmlBuffer.push("<a title='First Page' href='javascript:void(0);' id='tablePagination_firstPage' class='btn btn-default btn-sm'><span class='icon glyphicon glyphicon-fast-backward'></span></a>");
			    htmlBuffer.push("<a title='Previous Page' href='javascript:void(0);' id='tablePagination_prevPage' class='btn btn-default btn-sm'><span class='icon glyphicon glyphicon-backward'></span></a>");
			    htmlBuffer.push("<a title='Next Page' href='javascript:void(0);' id='tablePagination_nextPage' class='btn btn-default btn-sm'><span class='icon glyphicon glyphicon-forward'></span></a>");
			    htmlBuffer.push("<a title='Last Page' href='javascript:void(0);' id='tablePagination_lastPage' class='btn btn-default btn-sm'><span class='icon glyphicon glyphicon-fast-forward'></span></a>");
			    htmlBuffer.push("  ");
			    htmlBuffer.push("</div>");
			  htmlBuffer.push("</div>");
			  
			  htmlBuffer.push("<div class='pagination_object_item'>");
			    htmlBuffer.push("<label>Rows: </label>");
			    htmlBuffer.push(" <select id='tablePagination_rowsPerPage' class='filter_select'><option value='5'>10</option></select>");
			    htmlBuffer.push(" <input id='tablePagination_currPage' class='filter_select' type='input' value='" + currPageNumber + "' size='1'>");
			    htmlBuffer.push(" / ");
			    htmlBuffer.push(" <span id='tablePagination_totalPages'><b>" + totalPages + " </b></span> Rows");
			  htmlBuffer.push("</div>");
			htmlBuffer.push("</div>");
			return htmlBuffer.join("").toString();
		}

		if(pagination_status){
			if ($(table)[tblLocation]().find(totalPagesId).length == 0) {
				if (defaults.topNav) {
					$(this).before(createPaginationElements());
				} else {
					$(this).after(createPaginationElements());
				}
			} else {
				$(table)[tblLocation]().find(currPageId).val(currPageNumber);
			}
			resetPerPageValues();
			hideOtherPages(currPageNumber);

			$(table)[tblLocation]().find(firstPageId).bind('click', function(e) {
				resetCurrentPage(1)
			});

			$(table)[tblLocation]().find(prevPageId).bind('click', function(e) {
				resetCurrentPage(currPageNumber - 1)
			});

			$(table)[tblLocation]().find(nextPageId).bind('click', function(e) {
				resetCurrentPage(parseInt(currPageNumber) + 1)
			});

			$(table)[tblLocation]().find(lastPageId).bind('click', function(e) {
				resetCurrentPage(totalPages)
			});

			$(table)[tblLocation]().find(currPageId).bind('change', function(e) {
				resetCurrentPage(this.value)
			});

			$(table)[tblLocation]().find(rowsPerPageId).bind('change', function(e) {
				defaults.rowsPerPage = parseInt(this.value, 10);
				totalPages = resetTotalPages();
				resetCurrentPage(1)
			});
		}

		function create_input_element(element){
			string = '<div class="hidden-print input-group input-group-sm">';
		  	string += '<span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-search"></span></span>';
		  	string += '<input type="text" target="'+ element +'" class="live_search form-control" placeholder="Masukan Keyword Pencarian Anda" aria-describedby="sizing-addon3">';
		  	string += '<span class="input-group-addon"><span class="number_search">0</span></span>';
		  	string += '<span class="input-group-addon"><span class="glyphicon glyphicon-ok"></span> <a href="javascript:void();" class="excel_java" data_container="'+ element +'">Export</a></span>';
		  	string += '<span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-remove"></span> <a href="javascript:void();" class="clear_live_search" target=".live_search">Clear</span></a>';
			string += '</div>';
			string += '<br/>';
			return string;
		}

		function inisialisi(){
			var jumlah;
			var pushHtml;
			var live_search_keyword;

			class_object = $(parent_selector).attr('class');
			pushHtml = create_input_element(class_object);
			parent_selector.before(pushHtml);
			data = $(parent_selector).find('tbody tr');
			jumlah = data.length;
			$.each(data, function(key, value){
				live_search_keyword = '';
				td_child = $(value).find('td');
				td_child_item = $(td_child).find('.livesearch-item');
				$.each(td_child_item, function(key, value){
					live_search_keyword = (live_search_keyword == '') ? $(value).html() : live_search_keyword + ' ' + $(value).html();
					live_search_keyword = live_search_keyword.toLowerCase();
				});
				$(value).attr('data_live_search', live_search_keyword);
				$(value).addClass('live_search_container');
			});
		}

		$(document).delegate('.live_search', 'keyup', function(e){
			e.preventDefault();
			result = $(this).val().toLowerCase();
			induk_table = $(this).attr('target');
			texting = induk_table.split(' ');
			classing = '';
			$.each(texting, function(key, value){
				classing = classing + '.'+ value;
			});
			object_table = $(document).find('table'+classing);
			mode = $(object_table).find('tr.live_search_container');
			if( result!=='' && result.length>=word_count_tolerance){
				$(mode).addClass('hide');
				searching = $(mode).filter('[data_live_search*="'+ result +'"]').removeClass('hide');
				jumlah = searching.length;
			}else{
				jumlah = 0;
				$(mode).removeClass('hide');
			}
			$(document).find('.number_search').html(jumlah);
			if(pagination_status) reset_dynamic_layout();
			
		});
		$(document).delegate('.clear_live_search', 'click', function(e) {
			e.preventDefault();
			target = $(this).attr('target');
			$(target).val('').focus();
			$(target).keyup();
			if(pagination_status) reset_dynamic_layout();
		});
		inisialisi();
	}
});