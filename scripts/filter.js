function filter_openCateg(prefix, category, category_id, module) {
    if ($("#"+module+"_opencategorytree_id_"+category_id)) {
        filter_loadCategory(prefix, category, category_id, module);
    }
}

function filter_loadCategory(prefix, category, category_id, module) {
   
    var getInfo = [];
    $('#postCats input:hidden').each(function(index) {
        getInfo[index] = [$(this).attr('name'),$(this).attr('value')];
    });
    
    var parameters = {
        "arrayGet[]"    :   getInfo,
        "prefix"        :   prefix,
        "category"      :   category,
        "category_id"   :   category_id,
        "filter_item"   :   module,
        "actual_module" :   ACTUAL_MODULE_FOLDER
    };
    
    $("#"+prefix+"categorytree_id_"+category_id).css("display", "");
    $("#"+prefix+"categorytree_id_"+category_id).html("<li class=\"loading\" ><span id=\"loadingDots\" style=\"cursor: default;\">"+showText(LANG_JS_LOADING)+"</span></li>");

    $.post(DEFAULT_URL + "/loadcategoryfilter.php", parameters, function (ret) {
        if (category_id > 0) {
            $("#"+prefix+"opencategorytree_id_"+category_id).css("display", "none");
            $("#"+prefix+"closecategorytree_id_"+category_id).css("display", "");
        }
        $("#"+prefix+"categorytree_id_"+category_id).html(ret);
        $("#"+prefix+"categorytree_id_"+category_id).slideDown("slow");
    });
    
}

function filter_closeCategory(prefix, category_id) {
	if (category_id > 0) {
        $("#"+prefix+"closecategorytree_id_"+category_id).css("display", "none");
        $("#"+prefix+"opencategorytree_id_"+category_id).css("display", "");
    }

    $("#"+prefix+"categorytree_id_"+category_id).slideUp("slow", function() {
        $("#"+prefix+"categorytree_id_"+category_id).html("");
    });
    
}