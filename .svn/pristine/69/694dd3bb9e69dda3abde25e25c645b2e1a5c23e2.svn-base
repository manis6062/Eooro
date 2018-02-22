<?

// $dbMain = db_getDBObject(DEFAULT_DB, true);
// $dbDomain = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
// $db = $dbDomain->db_name;

// $sql2 = "SELECT * FROM $db.Setting_Payment WHERE name LIKE 'BRAINTREE%'";
// $resource = $dbDomain->query( $sql2 );


// while($row = mysql_fetch_assoc($resource) ){
// 		$array [] = $row;
// }

// $count = count($array);
// for($i=0; $i<$count; $i++){
// 	$arr[$array[$i] ['name']] = $array[$i] ['value']; //Braintree Stats and Value
// }

?>

<style>

.table-form td input.small-text-box {
  width: 300px;
}

</style>

	<table id="braintree_setting_title" onclick="showSettings(this.id);" class="standard-table">
		<tr>
			<th class="standard-tabletitle">
				Braintree
			</th>
		</tr>
	</table>
	<div id="braintree_setting" style="padding:30px;">

	 Enable Braintree : <input type="checkbox" class="inputCheck" name="braintree_active" id="braintree-status" <? if ($braintree_active == "on") {echo "checked = 'checked'";}  ?> >
	 <br /><br />
	 Environment :
	 <select name="braintree_environment" style="width:300px;">
		
		 <option <? if ($braintree_environment == "Sandbox") echo "selected" ?>> Sandbox</option>
		 <option <? if ($braintree_environment == "Production") echo "Selected" ?>> Production</option>

	 </select> <br /><br />

Sandbox Configuration : 
	<table class="table-form left-table" id="braintree_form">


		<tbody>

                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">MerchantID :</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="braintree_sb_merchantid" value="<?=$braintree_sb_merchantid?>" autocomplete="off">
                    </td>
                    </tr>
                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">PublicKey :</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="braintree_sb_publickey" value="<?=$braintree_sb_publickey?>" autocomplete="off">
                    </td>
                    </tr>
                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">PrivateKey :</div>
                        </td>
                        <td>
                           <input class="small-text-box" type="text" name="braintree_sb_privatekey" value="<?=$braintree_sb_privatekey?>" autocomplete="off">
                    	</td>
                    </tr>

        </tbody>


	</table>
     

Live Configuration : 
	<table class="table-form left-table" id="braintree_form">

		<tbody align="left">
                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">MerchantID :</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="braintree_merchantid" value="<?=$braintree_merchantid?>">
                    </td>
                    </tr>
                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">PublicKey :</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="braintree_publickey" value="<?=$braintree_publickey?>">
                    </td>
                    </tr>
                    

                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">PrivateKey :</div>
                        </td>
                        <td>
                           <input class="small-text-box" type="text" name="braintree_privatekey" value="<?=$braintree_privatekey?>">
                    	</td>
                    </tr>

        </tbody>


	</table>

	</div>
