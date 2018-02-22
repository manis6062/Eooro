<div class="thumbnail custhumbnail detailpage-widget">
    <div class="row-fluid well-steps">
        <div class="col-sm-12">
            <div class="iframeWrapperDetailPage">
            <iframe src="<?=$widget_uri_full?>" scrolling="no" class="detailpage-iframe" style="border:0px;width:250px;height:185px;"></iframe>
              <div class="widthHeight">
                    <strong>250px x 185px</strong>
              </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="reputationWrapper">
            <p data-toggle="modal" data-target="#myModal">
                <span class="repuEvery">Reputation is Everything</span></br>
                <span class="clickHere">Click Here</span> to get html code for above review box and put it on your website</br>
                <span class="helpFree">Help drive your customers to this page…for FREE</span>
            </p>
            </div>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content detailpage-modal">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Widget Code for <?=ucwords(htmlspecialchars($listing->title))?></h4>
                        </div>
                        <div class="modal-body">
                            <textarea class="widget-code-text" readonly style="width: 550px; height: 175px;"><div class='eooro-widget' data-business="<?=$listing->friendly_url?>"><script>d=document.getElementsByClassName("eooro-widget"),l=d[0].dataset.business;f=document.createElement("iframe"),f.setAttribute("src","<?=$widget_uri_small?>"+l),f.setAttribute("scrolling","no"),f.setAttribute("style","float:left;border:0px;width:250px;height:486px;"),d[0].appendChild(f);</script></div></textarea>
                        </div>
                        <div class="modal-footer detailpage-modal">
                            <button type="button" class="btn btn-default" onclick="$('.widget-code-text').select();">Select All</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>