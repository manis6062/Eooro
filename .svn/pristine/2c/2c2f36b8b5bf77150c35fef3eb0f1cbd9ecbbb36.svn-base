			</div>
			<div id="spinner" class="reviewSpinner" align="center"  style="display:none;">
			   <i class="fa fa-circle-o-notch fa-spin" style="color:#FF004F;margin-top: 50px;font-size: 70pt;"></i><br>
			   <h2 class="onlyBigScreen" style="color:#000;font-size:17px; "> Please Wait...</h2>
			</div>


			</div>
		</div>
	</div>

				</div> <!--col-sm-12-->
			</div> <!--ReviewerProfileBusinessMenu-dashboard-->
		</div> <!-- row -->                
	</div> <!-- container -->
</section>
<style type="text/css">
    @media (min-width: 1200px){
        h2.onlyBigScreen{
            margin-left:320px;
        }
    }
    @media (max-width: 1199px) and (min-width: 992px){
        h2.onlyBigScreen{
            margin-left:280px;
        }
    }
/*     @media (max-width: 991px) and (min-width: 768px){
        h2.onlyBigScreen{
            margin-left:280px;
        }
    }*/
</style>
<script>

        function highlightThis(item_id){      
            $('.b0').each(function() {
                $(this).children('a').removeClass( "active" );
            });
            $('#'+item_id).addClass('active');
        }

        function clickFunction(item, filename,id){

                highlightThis(item);
                showspinner();
                calculateScreenHideMenu();
                if(id == undefined){
                    $('#body').load(filename+'.php', function() {
                        hidespinner();
                    });
                } else {
                    $('#body').load(filename+'.php?id='+id, function() {
                        hidespinner();
                    });
                }
        }

        function hideMenu() { 
            $('#body').css({"border-left": "0px solid #DDD"}); 
            $('#sidebar').hide();
            $('#hider').hide();
            $('#shower').show();
        }

        function showMenu(){
            $('#sidebar').show();
            $('#hider').show();
            $('#shower').hide();
            $('#body').hide();
        }

        function calculateScreenHideMenu(){
            var width = $( window ).width();
            if( width < 768){
                hideMenu();
            }
        }

        function showspinner(){
            $('#body').hide();
            $('#spinner').show();
        }

        function hidespinner(){
            $('#spinner').hide();
            $('#body').show();
        }
</script>