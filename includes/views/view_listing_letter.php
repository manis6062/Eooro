<div class="letter-result"  itemprop="review" itemscope itemtype="http://schema.org/Review">
    <a itemprop="name" 
       href="<?=DEFAULT_URL.'/'.ALIAS_LISTING_MODULE.'/'.$listing['friendly_url'];?>">
            <?= $listing['title'];?>
    </a>
    <?php if( $listing['avg_review'] ): ?>
        <span itemprop="reviewRating"><?= $listing['avg_review'];?></span> stars
    <?php endif; ?>
</div>