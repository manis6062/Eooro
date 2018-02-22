function enableCustomLink(liID) {
    if ($("#dropdown_link_to_"+liID).val() == "custom") {
        $("#custom_link_"+liID).attr('disabled', '');
        $("#custom_link_"+liID).css('background-color', '#FFFFFF');
    } else {
        $("#custom_link_"+liID).attr('disabled', 'true');
        $("#custom_link_"+liID).css('background-color', '#f0f0f0');
    }
}

function serialize() {
    var ids = $("#sortable").sortable("toArray");

    $("#SaveByAjax").val("false");
    $("#order_options").attr("value", ids);
    $("#navigation").submit();
}

function removeItem(id, checkCounter) {
    $("#"+id).remove();
    if (checkCounter) {
        updatePreview();
        disableDropdown();
        var limitItems = $("#limitItems").val();
        if ($("#sortable li").length <= limitItems) {
            $("#add_item").css("display", "");
        }
    }
}

function replaceAll(string, token, newtoken) {
    while (string.indexOf(token) != -1) {
        string = string.replace(token, newtoken);
    }
    return string;
}

function CreateNewItem(checkCounter) {
    var LiText = $("#aux_litext").val();
    LiText = replaceAll(LiText, "LI_ID", $("#aux_count_li").val());

    $("#sortable").append(LiText);
    $("#custom_link_"+$("#aux_count_li").val()).attr('disabled', '');
    var countLi = parseInt($("#aux_count_li").val());
    $("#aux_count_li").val(countLi+1);
    
    if (checkCounter) {
        disableDropdown();
        var limitItems = $("#limitItems").val();
        if ($("#sortable li").length >= limitItems) {
            $("#add_item").css("display", "none");
        }
    }
}

function updatePreview(obj) {
    var i = 0;
    var totalItems = $("#aux_count_li").val();
    $(".cover-preview-image .tab-bar span").removeClass("active");
    $('#sortable li input:text').each(function() {
        var text = $(this).attr("value");
        if (!text) {
            text = "&nbsp;";
        }
        //Apple
        if (obj && obj.value == text) {
            $("#preview_box_apple_"+i).addClass("active");
        }
        $("#preview_box_apple_"+i).css("display", "");
        $("#preview_label_apple_"+i).html(text);
        //Android
        if (obj && obj.value == text) {
            $("#preview_box_android_"+i).addClass("active");
        }
        $("#preview_box_android_"+i).css("display", "");
        $("#preview_label_android_"+i).html(text);
        i++;
    });
    if (i >= 5) {
        $("#menusamplemore").css("display", "");
    } else {
        $("#menusamplemore").css("display", "none");
    }
    if (i < totalItems) {
        for (j = i; j< totalItems; j++) {
            $("#preview_box_apple_"+j).css("display", "none");
            $("#preview_box_android_"+j).css("display", "none");
        }
    }
}

function disableDropdown() {           
    $("#sortable li select").each(function() {
        var selectId = $(this).attr("id");
        $("#" + selectId + " option").each(function() {

            var this_objOption = $(this);
            this_objOption.attr("disabled", "");

            $("#sortable li select option:selected").each(function() {

                if ($(this).val() == this_objOption.val() && selectId != $(this).parent().attr("id")) {
                    this_objOption.attr("disabled", "disabled");
                }
            });

        });

    });
}

function checkOption(id) {
    var selected = $("#dropdown_link_to_" + id + " option:selected").val();
    if (selected == "favorites" || selected == "about" || selected == "account") {
        $("#remove_item"+id).css("display", "none");
    } else {
        $("#remove_item"+id).css("display", "");
    }
}