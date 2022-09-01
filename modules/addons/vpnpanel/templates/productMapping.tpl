<div class="fullpageloader" style="position: fixed; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 99999; top: 0px; left: 0px; display: none;">
    <p style="position: absolute; left: 40%; top: 30%; color: #fff; font-size: 25px;"><i class="fa fa-circle-o-notch  fa-spin"></i> Loading Please wait...</p>
</div>
<div class="row">
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {$breadcrumb}
            </ol>
        </nav>
    </div>
    <div class="col-md-12">
        <h2 class="pull-left">Product Mapping</h2>
        <form method="post" style="width: 100%; float: left" class="form-group">
            <table class="table table-bordered" style="width: 100%; max-width: 550px;margin: auto">
                <tr>
                    <th>WHMCS Products</th>

                    <td><select class="form-control productselectize" name="productid"></select></td>
                </tr>
                <tr>
                    <th>Platform</th>
                    <td>
                        <select name="platform" class="form-control">
                            <option value="">Select Platform</option>
                            <option value="google">Google Play Store</option>
                            <option value="ios">Apple Store</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Product SKU</th>
                    <td><input type="text" name="sku" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center><button type="submit" class="btn btn-primary" name="addproduct">Add</button></center>
                    </td>
                </tr>

            </table>
            <center>{if isset($message)}<p class="alert alert-{$msgtype}">{$message}</p>{/if}</center>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>WHMCS Product Name</th>
                    <th>Platform</th>
                    <th>Product SKU</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {$mappedProducts}
            </tbody>
        </table>
    </div>
</div>

<div class="modal modaledi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mapping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form-group">
            <div class="modal-body">
                
                    <table class="table table-bordered" style="width: 100%; max-width: 550px;margin: auto">
                        <tr>
                            <th>WHMCS Products</th>

                            <td><input type="hidden" name="mappid" class="mapid">
                                <select class="form-control productid" name="productid"></select>
                            </td>
                        </tr>
                        <tr>
                            <th>Platform</th>
                            <td>
                                <select name="platform" class="form-control platform">
                                    <option value="">Select Platform</option>
                                    <option value="google">Google Play Store</option>
                                    <option value="ios">Apple Store</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Product SKU</th>
                            <td><input type="text" name="sku" class="form-control sku"></td>
                        </tr>
                    </table>
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="updateproduct">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var options = {$productOptions}; 
    {literal}

    function editProduct(id, productid, platform, sku) {
        $('.productid').val(productid);
        $('.mapid').val(id);
        var selectie = $('.productid').selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            options: options,
        })
        selectie[0].selectize.setValue(productid);
        $('.platform').val(platform);
        $('.sku').val(sku);
        $('.modaledi').modal('show');
    }
    $(document).ready(function() {

        $('.productselectize').selectize({
            valueField: 'id',
            labelField: 'name',
            searchField: 'name',
            options: options
        });
    });
</script>{/literal}