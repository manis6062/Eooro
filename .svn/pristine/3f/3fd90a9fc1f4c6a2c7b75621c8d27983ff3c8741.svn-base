<?
	//Show Column Overview
	$show = $_GET['page'];
	//Count of Reviews to be collected
	$number_of_reviews = ReviewCollector::GetTotalRequestedReviews($acctId, $listing_id);
	$outstanding_requests = ReviewCollector::GetOutstandingRequests($acctId, $listing_id);

	//Pagination
	$_GET['page'] = $_GET['page'] ? $_GET['page'] : 1;
	$page_number = $_GET['page'];
	$number_of_results_per_page = 5;

	$page_number = ($page_number * $number_of_results_per_page) - $number_of_results_per_page;
	$number_of_pages   = ceil($number_of_reviews / $number_of_results_per_page);

	//Fetch Records
	$requested_reviews = ReviewCollector::GetRequestedReviewsInfo($acctId,$listing_id,$page_number,$number_of_results_per_page);
?>

<h2 id="over" style="color:#000;">Overview</h2>

<div id="overview" style="color:#000;display:none;">
	<strong>Reviews to Date:</strong><br>
	<strong>Total Requested Reviews : <?=$number_of_reviews?></strong><br>
	<strong>Outstanding Requests: <?=$outstanding_requests?></strong><br>


<table width="500" class="table-form" border="0" cellpadding="2" cellspacing="2">
		<tr>
			<td><strong>#</strong></td>										
			<td><strong>Name</strong></td>
			<td><strong>Action</strong></td>
			<td><strong>First Request Sent On</strong></td>
			<td><strong>Received On</strong></td>						
		</tr>
		<?foreach ($requested_reviews as $key => $review){ ?>
			<tr>
				<td><?=($key+1)+($number_of_results_per_page * ($_GET['page'] - 1))?></td>
				<td><?=$review['firstname'] ?> <?=$review['lastname']?></td>
				<td><?=$review['status'] ?></td>
				<td><?=$review['first_request_sent_on'] ?></td>
				<td><?=$review['received_on'] ?></td>
			</tr>
		<? } ?>
</table>
<br><br>
<div class="paginate_records" align="center">
	<?for($i = 1; $i <= $number_of_pages; $i++){?>
		<a href = "review-collector.php?id=<?=$listing_id?>&page=<?=$i?>"?><?=(($_GET['page'] == $i) ? "<strong><u>" : "" )?><?=$i?><?=(($_GET['page'] == $i) ? "</u></strong>" : "" )?></a>
	<?}?>
</div>
<center>
	<a rel="nofollow" href="review-collector/campaign.php?id=<?=$listing_id?>" class="createCampaign">
		<button class="btn btn-default btn-lg ctl">Create Campaign</button>
	</a>
</center>
</div>
<script>
$(document).ready(function() {
    $(".createCampaign").fancybox({    	
	    'width'  : '700px',
    	'height' : '500px',
    	'type'	 : 'iframe',
    	'closeBtn' : false ,
    	fitToView   : false,
		autoSize    : false
    });
});
</script>
<?if ($show) {?>
<script>$("#overview").show();</script>
<?}?>