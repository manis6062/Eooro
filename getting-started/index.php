<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Getting Started Page</title>

	</head>
		<?php require("../conf/loadconfig.inc.php");
	include(system_getFrontendPath("header.php", "layout"));
		?>
		<div class="container gettingStarted">
			<div class="row">
				<div class="col-sm-12">
					<div class="gettingStarted-logoWrapper">
						<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/gettingStarted_logo.png" width="326" alt="getting started logo" class="img-responsive col-sm-offset-4" />
					</div>
				</div>
				</div> <!-- /row -->
				<div class="row">
					<div class="col-sm-12">
						<h1>Welcome to Eooro.com<br><span>Ok, let’s get you started.</span></h1>
					</div>
					</div><!-- /row -->
					<div class="row">
						<section class="step1 clearfix">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-2 width-reduced">
										<div class="image">
											<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/gettingStarted1.png" width="115" alt="step 1" class="img-responsive" />
											<!-- <span>01</span> -->
										</div>
									</div>
									<div class="col-sm-10">
										<h2>Do one or both of the following things;</h2>
										<div class="well clearfix">
											<p>1. Send a personal email to your customers and ask them to review your business.</p>
											<p>2. Log in and use the <strong>Review Collector</strong> in your <strong>Account</strong> area to input a list of customer names  and click Submit. Our system will send 	out a regular email asking for a review on your behalf. <strong>(see Fig 1)</strong></p>
											<div class="text-center">
												<div class="col-sm-12">
													<strong>fig 1</strong>
												</div>
												<div class="col-sm-12">
													<div class="img-thumbnail">
														<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/fig1.png" height="548" width="699" alt="fig 1" class="img-responsive">
													</div>
												</div>
											</div>
											</div> <!-- /well -->
											<div class="alert alert-warning">
												<strong>Note*<br></strong> We would always recommend sending  a personal email to each of your customers, it is more personal and will result  in a higher influx
												of reviews.
											</div>
										</div>
									</div>
								</div>
							</section>
							</div> <!-- /row -->
							<div class="row">
								<section class="step2 clearfix">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2 width-reduced">
												<div class="image">
													<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/gettingStarted2.png" width="115" alt="step 2" class="img-responsive" />
													<!-- <span>02</span> -->
												</div>
											</div>
											<div class="col-sm-10">
												<h2>Next Step - Website Widgets</h2>
												<div class="well clearfix">
													<p>Once your business has received 4 reviews follow the next steps.</p>
													<p>1. Go to <strong>Website Widgets</strong> in your <strong>Account</strong> area and choose which Widget you want to install on your website.
													(<strong>Fig 2</strong> is the most popular one)</p>
													<p>2. Click the tab called <strong>“HTML Code”</strong> and copy the code and insert in the area of your website where you want the widget to
													appear.</p>
													<div class="text-center clearfix">
														<strong>fig 2</strong>
														<div class="col-sm-12">
															<div class="img-thumbnail">
																<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/fig2.png" height="548" width="699" alt="fig 1" class="img-responsive">
															</div>
														</div>
													</div>
													<div class="alert alert-warning">
														<strong>Very Important*<br></strong>The most important thing about using Website Widget on your site is that it speeds up the time it takes to see those famous Google Stars we all want to love
													</div>
													<div class="seo-ranking">
														<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images/fig3.png" alt="step 2" class="img-responsive" />
													</div>
													<div class="alert alert-warning">
														<strong>Once the Website Widget is on your website google will pick up the links and crawl your review page on Eooro, then in approx. 6 to 8
														weeks you should see the stars for your review page on Eooro showing on Googles search results. The Widget shows your visitors that your reputation is upfront and this helps build trust with your brand.</strong>
													</div>
													</div> <!-- /well -->
												</div>
											</div>
										</div>
									</section>
									</div> <!-- /row -->
									<div class="row">
										<section class="step3 clearfix">
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-2 width-reduced">
														<div class="image">
															<img src="<?php echo DEFAULT_URL?>/custom/domain_1/theme/review/images//gettingStarted3.png" width="115" alt="step 2" class="img-responsive" />
															<!-- <span>03</span> -->
														</div>
													</div>
													<div class="col-sm-10">
														<h2>Final Advice</h2>
														<div class="well clearfix">
															<p>We recommend you include in all of your outgoing emails and invoices a link to your review page on Eooro, this way you can spend
															less time asking your customers to write reviews.</p>
															<p>Then on weekly or monthly basis spend 15 minutes updating new customer names into our Review Collector System, this will
															ensure you have fresh updated reviews. </p>
															<p>If you have any questions please use our Live Chat service on the website or email us at <a href="mailto:support@eooro.com">support@eooro.com.</a></p>
															</div> <!-- /well -->
														</div>
													</div>
												</div>
											</section>
											</div> <!-- /row -->
											<div class="row">
												<div class="col-sm-2 width-reduced">
												</div>
												<div class="col-sm-10">
													<div class="signature-wrapper">
														<p>Happy Reviewing</p>
														<p>Eooro.com<br>New Business Team</p>
													</div>
												</div>
											</div>
										</div>
										
								<?php		include(system_getFrontendPath("footer.php", "layout"));?>

									</body>
								</html>
								<style type="text/css">
									.gettingStarted-logoWrapper{
										padding-top: 20px;
									}
								</style>