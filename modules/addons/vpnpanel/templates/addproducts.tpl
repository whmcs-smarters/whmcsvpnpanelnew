<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {$breadcrumb}
            </ol>
        </nav>
    </div>
</div>
<div class="col-md-12">
    <h2>Add New Product</h2>   
</div>

<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
    <tbody>

        <tr>
            <th scope="row" class="text-right  col-lg-3" >Product Type</th>
            <td class="text-center ">
                <select class="form-control select-inline" style="display: block;">  
                    <option value="hostingaccount">Hosting Account</option>
                    <option value="reselleraccount">Reseller Account</option>
                    <option value="server">Dedicated/VPS Server</option>
                    <option value="other" selected="">Other</option> 
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-right col-lg-3">Product Group</th>
            <td class="text-center">
                <select class="form-control select-inline" style="display: block;">
                    {foreach from=$getproductgroup item=$productGroup}
                        <option>{$productGroup->name}</option>
                    {/foreach}
                </select>   
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-right col-lg-3">Product Name</th>
            <td><input class="form-control input-400 input-inline"></input></td>
        </tr>
        <tr><th scope="row" class="text-right col-lg-3">Payment Type</th>
            <td>
                <input type="radio" id="free">Free</input>
                <input id="one_time" type="radio">One Time</input>

                <div class="col-sm-10 col-sm-offset-1" id="one_time_table">
                    <table id="pricingtbl" class="table table-condensed" style="max-width: 370px;">
                        <tbody>
                            <tr bgcolor="#efefef" style="text-align:center;font-weight:bold">
                                <td>Currency</td>
                                <td></td>
                                <td>One Time/Monthly</td>
                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td rowspan="3" bgcolor="#efefef"><b>USD</b></td>
                                <td>Setup Fee</td>
                                <td><input type="text" name="currency[1][msetupfee]" id="setup_USD_monthly" value="0.00" style="display:none" class="form-control input-inline input-100 text-center"></td>
                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td>Price</td>
                                <td><input type="text" name="currency[1][monthly]" id="pricing_USD_monthly" size="10" value="0.00" style="display:none;" class="form-control input-inline input-100 text-center"></td>

                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td>Enable</td>
                                <td><input type="checkbox" class="one_time_checkbox" currency="USD" cycle="monthly"></td>

                            </tr>
                        </tbody>
                    </table>
                </div>  
                <input type="radio" id="Recurring">Recurring</input>

                <div class="col-sm-10 col-sm-offset-1" id="recurring_table">
                    <table id="pricingtbl" class="table table-condensed" style="">
                        <tbody>
                            <tr bgcolor="#efefef" style="text-align:center;font-weight:bold">
                                <td>Currency</td>
                                <td></td>
                                <td>One Time/Monthly</td>
                                <td class="prod-pricing-recurring" style="display: table-cell;">Quarterly</td>
                                <td class="prod-pricing-recurring" style="display: table-cell;">Semi-Annually</td>
                                <td class="prod-pricing-recurring" style="display: table-cell;">Annually</td>
                                <td class="prod-pricing-recurring" style="display: table-cell;">Biennially</td>
                                <td class="prod-pricing-recurring" style="display: table-cell;">Triennially</td>
                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td rowspan="3" bgcolor="#efefef"><b>USD</b></td>
                                <td>Setup Fee</td>
                                <td><input type="text" name="currency[1][msetupfee]"  value="0.00" style="display: none;" class="form-control input-inline input-100 text-center monthly"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][qsetupfee]"  value="0.00" style="display:none" class="form-control input-inline input-100 text-center Quarterly"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][ssetupfee]"  value="0.00" style="display:none" class="form-control input-inline input-100 text-center Semi-Annually"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][asetupfee]"  value="0.00" style="display:none" class="form-control input-inline input-100 text-center Annually"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][bsetupfee]"  value="0.00" style="display:none" class="form-control input-inline input-100 text-center Biennially"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][tsetupfee]"  value="0.00" style="display:none" class="form-control input-inline input-100 text-center Triennially"></td>
                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td>Price</td>
                                <td><input type="text" name="currency[1][monthly]"  size="10" value="-1.00" style="display: none;" "="" class="form-control input-inline input-100 text-center monthly"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][quarterly]"  size="10" value="-1.00" style="display:none;" "="" class="form-control input-inline input-100 text-center Quarterly"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][semiannually]"  size="10" value="-1.00" style="display:none;" "="" class="form-control input-inline input-100 text-center Semi-Annually"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][annually]"  size="10" value="-1.00" style="display:none;" "="" class="form-control input-inline input-100 text-center Annually"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][biennially]"  size="10" value="-1.00" style="display:none;" "="" class="form-control input-inline input-100 text-center Biennially"></td>
                                <td  style="display: table-cell;"><input type="text" name="currency[1][triennially]"  size="10" value="-1.00" style="display:none;" "="" class="form-control input-inline input-100 text-center Triennially"></td>
                            </tr>
                            <tr bgcolor="#ffffff" style="text-align:center">
                                <td>Enable</td>
                                <td><input type="checkbox" data-type="monthly" class="recurring_checkbox_class" currency="USD" cycle="monthly"></td>
                                <td class="recurring_checkbox_class" data-type="Quarterly" style="display: table-cell;"><input type="checkbox"  currency="USD" cycle="quarterly"></td>
                                <td class="recurring_checkbox_class" data-type="Semi-Annually" style="display: table-cell;"><input type="checkbox"  currency="USD" cycle="semiannually"></td>
                                <td class="recurring_checkbox_class" data-type="Annually" style="display: table-cell;"><input type="checkbox"  currency="USD" cycle="annually"></td>
                                <td class="recurring_checkbox_class" data-type="Biennially" style="display: table-cell;"><input type="checkbox"  currency="USD" cycle="biennially"></td>
                                <td class="recurring_checkbox_class" data-type="Triennially" style="display: table-cell;"><input type="checkbox"  currency="USD" cycle="triennially"></td>
                            </tr>            
                        </tbody>
                    </table>
                </div>  
            </td></tr>
        <tr>
            <th scope="row" class="text-right col-lg-3">Product Description</th> 
            <td class="fieldarea">
                <div class="row">
                    <div class="col-sm-7">
                        <textarea name="description" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-5">
                        <br>
                        You may use HTML in this field<br>
                        &lt;br /&gt; New line<br>
                        &lt;strong&gt;Bold&lt;/strong&gt; <b>Bold</b><br>
                        &lt;em&gt;Italics&lt;/em&gt; <i>Italics</i>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-right col-lg-3">Welcome Email</th>
            <td class="text-center">
                
                    <option>None</option>
                    {foreach from=$emailtemplates item=$emailtemplate}
                        {$emailtemplate|@debug_print_var}
                        <option>{$emailtemplate.name}</option>
                    {/foreach}

               
            </td>
        </tr>
        <tr>
            <th scope="row" class="text-right col-lg-3">Hidden</th>
            <td ><input type="checkbox" ></input></td>
        </tr>
    </tbody>
</table>
                    <pre>{$emailtemplates|@debug_print_var} </pre>
<div class="col text-center" id="continue">
    <button class="btn btn-success">Continue >></button>
</div>     

<style>
    .table th, .table td { 
        border-top: none !important; 
    }
    table td {
        border-left: 2px solid #f5f5f5;
    }
    #one_time_table
    {
        margin-top: 20px;
    }
    #recurring_table
    {
        margin-top: 20px;
    }


</style>
<script>
    $(document).ready(function () {
        $("#payment").hide();
        $("#recurring_table").hide();
        $("#continue").click(function () {
            $("#details").hide();
            $("#payment").show();
            $("#continue").hide();
            $("#one_time_table").hide();
        });
        $("#one_time").click(function () {
            $("#one_time_table").show();
            $("#recurring_table").hide();
        });
        $("#free").click(function () {
            $("#one_time_table").hide();
            $("#recurring_table").hide();
        });
        $("#Recurring").click(function () {
            $("#one_time_table").hide();
            $("#recurring_table").show();
        });
        $(".one_time_checkbox").change(function () {
            if (this.checked)
            {
                $("#setup_USD_monthly").show();
                $("#pricing_USD_monthly").show();
            } else
            {
                $("#setup_USD_monthly").hide();
                $("#pricing_USD_monthly").hide();
            }

        });

        $("#one_time").click(function () {
            $("#one_time").siblings().attr("checked", false);

        });
        $("#free").click(function () {
            $("#free").siblings().attr("checked", false);

        });
        $("#Recurring").click(function () {
            $("#Recurring").siblings().attr("checked", false);

        });

        $(".recurring_checkbox_class").click(function () {
            var CLickon = $(this).data("type");
            if ($(this).is(":checked")) {
                $("." + CLickon).show();
            } else if ($(this).is(":not(:checked)")) {
                $("." + CLickon).hide();
            }

        });

    });
</script>