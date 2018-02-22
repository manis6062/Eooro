<?php

class PaginationCustom{

	public static function getPagination($number_of_results_per_page, $total_entries, $page_number, $url, $limit = 10, $type = null, $selector = null){

		$paginates 	  = ceil($total_entries / $number_of_results_per_page);
		$start_from   = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;

			    $this_page_no = $page_number;
			    $paginates < $limit ? $limit = $paginates : null;

			  	if( $total_entries > $number_of_results_per_page ) {
			  		
			  		if(!$type){
			  			return self::makeCode($url, $this_page_no, $page_number, $paginates);
			  		} else {
			  			$return['code'] 		= self::makeCodeAJAX($url, $this_page_no, $page_number, $paginates, $selector);
			  			$return['start_from']	= $start_from;
			  			return $return;
			  		}

			  	} else {
			  		$return['code'] = null;
			  		$return['start_from'] = 0;
			  		return $return;

			  	}

	}


	public static function makeCode($url, $this_page_no, $page_number, $paginates){

		$return =
				'
				<div class="row text-center">
				<ul class="pagination plPagi">
					<li>       
		              <a href="' . $url."/1" . '">&laquo; Start</a>
		            </li>
		            
		            <li>       
		              <a href="' . ($this_page_no > 1 ? $url. '/' .$this_page_no - 1 : null) . '">&laquo; Prev</a>
		            </li>';

						for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) {
				            	
				            		$return .= '<li '. ($page_number == $i ? 'class="active"' : null). '>';

				            		if ($i > 0 && $page_number < 5 && $i <= 10 ) {
		            					$return .= '<a href=' . $url. '/' . $i . '>';			
				            			$return .= ($i <= 10 ? $i : null);
				            			$return .= '</a>';

				            		} else { 

				            			if ( $i > 0 && $i < $page_number + 6) {
						            			$return .= '<a href="'.$i.'">';			
						            			$return .= $i; 
						            			$return .= '</a>';
					            		}

				            		}
				            
				            		$return .= '</li>';
				            }

				            $return .= '<li><a href="'.(($this_page_no < $paginates) ? $url. '/' .($this_page_no + 1) : null). '">&raquo; Next</a></li>';

							 $return .= '<li>       
				              <a href="'. $url.'/'.$paginates . '">&raquo; End</a>
				            </li>

				</ul>
				</div>';

				return $return;

	}


	public static function makeCodeAJAX($url, $this_page_no, $page_number, $paginates, $selector){

		$return =
				'
				<div class="row text-center">
				<ul class="pagination plPagi">
					<li>       
		              <a onclick="loadData(\'1\');">&laquo; Start</a>
		            </li>
		            
		            <li>       
		              <a onclick="loadData('. ($this_page_no > 1 ? $this_page_no - 1 : "99999") .');">&laquo; Prev</a>
		            </li>';

						for($i = $page_number - 4 ; $i <= min($page_number + 9, $paginates); $i++) {
				            	
				            		$return .= '<li '. ($page_number == $i ? 'class="active"' : null). '>';

				            		if ($i > 0 && $page_number < 5 && $i <= 10 ) {
		            					$return .= '<a onclick="loadData('.$i.');">';
				            			$return .= ($i <= 10 ? $i : null);
				            			$return .= '</a>';

				            		} else { 

				            			if ( $i > 0 && $i < $page_number + 6) {
						            			$return .= '<a onclick="loadData('.$i.');">';		
						            			$return .= $i; 
						            			$return .= '</a>';
					            		}

				            		}
				            
				            		$return .= '</li>';
				            }

				            $return .= '<li><a onclick="loadData('. (($this_page_no < $paginates) ? ($this_page_no + 1) : "99999") . ');">&raquo; Next</a></li>';

							$return .= '<li>       
				               <a onclick="loadData(' . $paginates. ');">&raquo; End</a>
				            </li>
				</ul>
				</div>';

#--------------------------------------------------------------------------------------------------------------------
#	NOTE
#
#	Requires a function called show spinner which will act as a loader
#	Change this section as per your needs
#				
#--------------------------------------------------------------------------------------------------------------------

			$return .= '<script>
			function loadData(page){
				if(page != "99999"){
					showspinner();
					$("'.$selector.'").load("'.$url.'"+page, function(){
						hidespinner();
					});
				}
			}
			</script>';


			return $return;

	}


}