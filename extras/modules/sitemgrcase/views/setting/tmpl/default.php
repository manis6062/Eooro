<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      Modules / sitemgrcase - case setting
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
?>
<div id="main-right">
    <div id="top-content">
        <div id="header-content">
            <h1>Case Settings</h1>
        </div>
    </div>
    <div id="content-content">
        <div class="default-margin">
            <!-- Everything goes here  -->
            <div class="submenu">
                <ul>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=searchcase'?>">Search</a></li>
                    <li><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=manage'?>">Manage</a></li>
                    <li class="submenu_active"><a href="<?=DEFAULT_URL.'/extras/sitemgr_case.php?controller=setting'?>">Setting</a></li>
                </ul>
            </div> <!-- submenu complete  -->
            <br clear="all">
            
            <!--  Body  -->
            <div class="pull-left">
                <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                    <table>
                        <tr>
                            <td><b>Case Price Settings</b></td>
                        </tr>
                        <tr>
                            <td><label for="price">Case Opening Charge</label></td>
                            <td><input id="price" type="text" value="<?=$this->setting['price']['value'];?>" name="price"/></td>
                        </tr>
                        </table>
                    <input type="hidden" name="controller" value="setting"/>
                    <input type="hidden" name="action" value="updateSettings" />
                    <input type="submit" name="price-submit" value="Submit" class="input-button-form" disabled="false"/>
                </form>
                <form method="post">
                    <table>
                        <tr>
                            <td><b>Case Duration Settings</b></td>
                        </tr>
                        <tr>
                            <td><label>Duration (in days)</label></td>
                            <td><input id="duration" name="duration" type="number" value="<?=$this->setting['duration']['value'];?>"/></td>
                        </tr>
                        </table>
                    <input type="hidden" name="controller" value="setting"/>
                    <input type="hidden" name="action" value="updateSettings" />
                    <input type="submit" name="duration-submit" value="Submit" class="input-button-form" disabled="false"/>
                </form>
                <form method="post">
                    <table>
                         <tr>
                            <td><b>Terms and Conditions</b></td>
                        </tr>
                        <tr>
                            <td><label>Sponsor Terms & Condition </label></td>
                            <td><textarea id="sponsor-terms" name="sponsor-terms" rows="10" cols="50"><?=$this->setting['sponsor_t_and_c']['long_description'];?></textarea></td>
                        </tr>
                        <tr>
                            <td><label>Reviewer Terms & Condition </label></td>
                            <td><textarea id="reviewer-terms" name="reviewer-terms" rows="10" cols="50"><?=$this->setting['reviewer_t_and_c']['long_description'];?></textarea></td>
                        </tr>
                    </table>
                    <input type="hidden" name="controller" value="setting"/>
                    <input type="hidden" name="action" value="updateSettings" />
                    <input type="submit" name="terms-submit" value="Submit" class="input-button-form" disabled="false"/>
                </form>
                <form method="post">   
                    <table>
                        <tr>
                            <td><label><b>Resolution Type: Delete and Close By User</b></label></td>
                        </tr>
                        <tr>
                            <td>Short Description: </td>
                            <td><input id="user-delete" name="user-delete-short" value="<?=$this->setting['resolution_type_user_d']['short_description'];?>" /></td>
                        </tr>
                        <tr>
                            <td>Long Description:</td>
                            <td><textarea id="user-delete" name="user-delete-long" rows="10" cols="50"><?=$this->setting['resolution_type_user_d']['long_description'];?></textarea></td>
                        </tr>
                    </table>
                    <input type="hidden" name="controller" value="setting"/>
                    <input type="hidden" name="action" value="updateSettings" />
                    <input type="submit" name="submit" value="Submit" class="input-button-form" disabled="false"/>
                </form>
                <form method="post">   
                    <table>
                        <tr>
                            <td><label><b>Resolution Type: Keep and Close By User</b></label></td>
                        </tr>
                        <tr>
                            <td>Short Description: </td>
                            <td><input id="user-keep-s" name="user-keep-short" value="<?=$this->setting['resolution_type_user_k']['short_description'];?>" /></td>
                        </tr>
                        <tr>    
                            <td>Long Description:</td>
                            <td><textarea id="user-keep-d" name="user-keep-long" rows="10" cols="50"><?=$this->setting['resolution_type_user_k']['long_description'];?></textarea></td>
                        </tr>
                    </table>
                    <input type="hidden" name="controller" value="setting"/>
                    <input type="hidden" name="action" value="updateSettings" />
                    <input type="submit" name="submit" value="Submit" class="input-button-form" disabled="false"/>
                </form>
            </div>
        </div><!--  default-margin ends  -->
    </div><!--  content-content ends  -->
    <div id="bottom-content">
        &nbsp;
    </div>
</div>
<script> 
    $( 'table' ).css( 'margin', '15px' );
    $( 'form' ).each(function(index, value){
        console.log( index );
        console.log( value );
        $(value).find('input, textarea').each( function( inn, val){
            console.log( inn );
            console.log( val );
            $( val ).change(function(){
//                $(value).find('input[type=submit]').attr( 'disabled', 'disabled' );
//                console.log( input );
                $(value).find('input[type=submit]')[0].disabled = false;
            })
        });
    });
</script>