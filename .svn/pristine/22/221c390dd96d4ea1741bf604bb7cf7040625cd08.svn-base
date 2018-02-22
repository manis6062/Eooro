<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */

$dbMain = db_getDBObject(DEFAULT_DB, true);
$dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
$account_id = sess_getAccountIdFromSession();

if( $account_id ):
    $sql = "SELECT R.*, O.*, L.title FROM Opened_Cases AS O "
            . "JOIN Review AS R ON O.review_id=R.id "
            . "JOIN Listing AS L ON L.id=R.item_id "
            . "WHERE R.member_id=$account_id && O.case_status='A'";
    $resource = $dbDomain->query( $sql );
    while( $row = mysql_fetch_assoc($resource) ){
        $cases[] = $row;

        $sql = "SELECT COUNT(*) as count FROM Case_Messages "
                        . "WHERE case_id='{$row['case_id']}' AND delivery_status='0000-00-00 00:00:00' AND from_user<>{$row['member_id']}";
        $resource2   = $dbDomain->query( $sql );
        $result     = mysql_fetch_assoc( $resource2 );
        $unreadMessages[] = $result['count'];
    }
    $caseSize = count( $cases );
    if ( $cases ):
    ?>

    <article>
        <header class="activity-box">
            <h2>Case Opened Against You</h2>
        </header>
        <section class="activity-box">
            <?php for( $i = 0; $i < $caseSize; $i++ ): ?>
                <section class="item-activity">
                    <p>Listing: <b><?=$cases[$i]['title'];?></b> <em class="pull-right local-date"><?=$cases[$i]['opened_date'];?></em></p>
                    <p>
                        Review Title: <?=$cases[$i]['review_title'];?>
                        <?=$unreadMessages[$i] ? '<span style="color:green;">'.$unreadMessages[$i] . ' New Messages</span>' : ''; ?>
                        <a href="<?=CASE_URL."?id={$cases[$i]['review_id']}";?>" class="pull-right">View Case</a>
                    </p>
                </section>
            <?php endfor; ?>
        </section>
    </article>
<?php endif; 
    endif;
?>
<script>
    function convertGMTtoLocal( date ){
        var parts = date.split( '-' );
        var year    = parts[0];
        var month   = parts[1];
        var parts   = parts[2].split( ' ' );
        var day     = parts[0];
        var hms     = parts[1].split( ':' );

        date = new Date( Date.UTC(year, month, day, hms[0], hms[1], hms[2]) );

        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }
    $( document ).ready(function(){
        $( '.local-date' ).each(function( index, element ){
            var gmt = $( element ).text() + ' UTC';
            $( element ).text( convertGMTtoLocal(gmt) );
        }); 
    });
</script>