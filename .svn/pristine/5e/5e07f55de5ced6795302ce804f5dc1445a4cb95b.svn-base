function showAdvancedSearch(item_type, template_id, load_cat, category_id) {
	
	var aux_data = "category_id="+category_id+"&fnct=categories&type="+item_type;
	
	if (load_cat){
		/*
		 * Load dropdown using ajax
		 */
		if (template_id > 0) {
			aux_data += "&template_id="+template_id;
		}

		$.ajax({
		  url: DEFAULT_URL+"/advancedsearch_categories.php",
		  context: document.body,
		  data: aux_data,
		  success: function(html){
			$("#advanced_search_category_dropdown").html(html);
            if ($().selectpicker) {
                $('.selectpicker .select').selectpicker();
            }
		  }
		});	
	}

	if (document.getElementById("locations_default_where")) {
		if (document.getElementById("locations_default_where").value) {
			if (document.getElementById("locations_default_where_replace").value == "yes") {
                $("#where, #where_resp").attr("value", $("#locations_default_where").val());
            }
        }
	}
    
    document.getElementById("advanced-search-button").onclick = function() {
		closeAdvancedSearch(item_type, template_id, category_id);
	}
    
	$('#advanced-search').slideDown('slow');
	$('#advanced-search-label').hide();
	$('#advanced-search-label-close').show();
}

function closeAdvancedSearch(item_type, template_id, category_id) {
	
    $('#advanced-search').slideUp('slow', function() {
        document.getElementById("advanced-search-button").onclick = function() {
            showAdvancedSearch(item_type, template_id, false, category_id);
        }
    });
	$('#advanced-search-label').show();
	$('#advanced-search-label-close').hide();
    
}

function clearAdvancedOptions() {
    $('#divAdvSearchFields input:radio').each(function() {
       this.checked = false;
    });
    $('.list-home li').each(function() {
       $(this).find("label").removeClass("active");
    });
}

function checkRadio(obj) {
    $('.list-home li').each(function() {
       $(this).find("label").removeClass("active");
    });
    obj.find("label").addClass("active");
}