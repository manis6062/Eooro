<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;
?>
<table id="sagepay_setting_title" onclick="showSettings(this.id);" class="standard-table" >
    <tr>
        <th class="standard-tabletitle">
            <?php echo 'SagePay Settings'; ?>
        </th>
    </tr>
</table>

<div id="sagepay_setting" class="defaultItems" style="display: none;">

    <table class="table-form left-table">
        <tr>
            <th>
            <?php if ($this->status == "on") { ?>
                    <input type="checkbox" class="inputCheck" name="payment_sagepayStatus" id="sagepay-status" onclick="enableForm('sagepay')" checked="checked"/>
            <?php } else { ?>
                    <input type="checkbox" class="inputCheck" name="payment_sagepayStatus" id="sagepay-status" onclick="enableForm('sagepay')"/>
            <?php } ?>
            </th>
            <td class="td-form">
                    <div class="label-form"><?php echo 'Enable SagePay'; ?></div>
            </td>
        </tr>
    </table>
    
    <?php if ($this->status == "on") { ?>
                <table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="sagepay_form">
    <?php } else { ?>
                <table cellpadding="2" cellspacing="0" border="0" class="table-form table-form-settings2" id="sagepay_form" <?=(${'sagepay_form'}) ? "style=\"display:table-row;\"" : "style=\"display:none;\""?> >
    <?php } ?>
                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">* <?php echo 'Vendor Name: ';//label-1 ?></div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="sagepay_vendor" value="<?php echo $this->vendor; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">* <?php echo 'Username: '; ?>:</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="text" name="sagepay_username" value="<?php echo $this->username; ?>" />
                    </td>
                    </tr>
                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">* <?php echo 'Password: '; ?>:</div>
                        </td>
                        <td>
                            <input class="small-text-box" type="password" name="sagepay_password" value="<?php echo $this->password; ?>" />
                    </td>
                    </tr>
                    </tr>
                    <tr>
                        <td align="right" class="td-form">
                            <div class="label-form">* <?php echo 'Integration Type: '; ?></div>
                        </td>
                        <td>
                            <select class="small-text-box" name="sagepay_integrationtype">
                                <option value="" > --- Select --- </option>
                                <option value="FORM" <?php if($this->integration_type === 'FORM') echo 'selected="selected"';?> >Form</option>
                                <option value="DIRECT" <?php if($this->integration_type === 'DIRECT') echo 'selected="selected"';?>>Direct</option>
                            </select>
                    </td>
                    </tr>

                </table>

</div>