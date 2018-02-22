function loadToolTip(area) {
    if (area == "general") {
        
        $('#priceTip, .symbol a, .summary-price a, .list-search label, .button-call img, .button-send img, .share-social img, .summary-icons span a.map-link, #tip_rss').tooltip({
            animation: true
        });
        
        $('#tab_mapView').tooltip({
            animation: true,
            placement: 'bottom'
        })
        
    } else if (area == "detail") {
        
        $('#priceTip, .list-search label, .button-call img, .button-send img, .share-social img').tooltip({
            animation: true
        });
        
    } else if (area == "summary_ajax") {
        
        $('.summary-price a, .button-call img, .button-send img, .share-social img').tooltip({
            animation: true
        });
        
    }
}