<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Real Time CRUD Codeigniter</h2>
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalAdd">Add New Product</button>
                <table id="mytable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="show_product">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add New Product -->
    <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="input1">Product Name</label>
                        <input type="text" name="name" class="form-control name" id="input1" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="input2">Product Price</label>
                        <input type="text" id="price1" name="price" class="form-control price" id="input2" placeholder="Product Price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Product -->
    <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="input1">Product Name</label>
                        <input type="text" name="name" class="form-control name_edit" id="input1" placeholder="Product Name">
                    </div>
                    <div class="form-group">
                        <label for="input2">Product Price</label>
                        <input type="text" id="price2" name="price" class="form-control price_edit" id="input2" placeholder="Product Price">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id_edit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-edit">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Product -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        Anda yakin mau menghapus data ini?
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary btn-delete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        var rupiah1 = document.getElementById('price1');
        rupiah1.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah1.value = formatRupiah(this.value, 'Rp. ');
        });
        var rupiah2 = document.getElementById('price2');
        rupiah2.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah2.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            separator = '';

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // rupiah1.value = formatRupiah(this.value, 'Rp. ');
        // rupiah2.value = formatRupiah(this.value, 'Rp. ');

        $(document).ready(function() {


            // CALL FUNCTION SHOW PRODUCT
            show_product();

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('b2ae92299a92763dda42', {
                cluster: 'ap1',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if (data.message === 'Success!') {
                    show_product();
                }
            });

            // FUNCTION SHOW PRODUCT
            function show_product() {
                $.ajax({
                    url: '<?php echo site_url("product/getProduct"); ?>',
                    type: 'GET',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var count = 1;
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td>' + count++ + '</td>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + formatRupiah(data[i].price, 'Rp. ') + '</td>' +
                                '<td>' +
                                '<a href="javascript:void(0);" class="btn btn-sm btn-info item_edit mr-3" data-id="' + data[i].id + '" data-name="' + data[i].name + '" data-price="' + data[i].price + '">Edit</a>' +
                                '<a href="javascript:void(0);" class="btn btn-sm btn-danger item_delete" data-id="' + data[i].id + '">Delete</a>' +
                                '</td>' +
                                '</tr>';
                        }
                        $('.show_product').html(html);
                    }

                });
            }

            // CREATE NEW PRODUCT
            $('.btn-save').on('click', function() {
                var name = $('.name').val();
                var price = $('.price').val();
                $.ajax({
                    url: '<?php echo site_url("product/create"); ?>',
                    method: 'POST',
                    data: {
                        name: name,
                        price: price
                    },
                    success: function() {
                        $('#ModalAdd').modal('hide');
                        $('.name').val("");
                        $('.price').val("");
                    }
                });
            });
            // END CREATE PRODUCT

            // UPDATE PRODUCT
            $('#mytable').on('click', '.item_edit', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var price = $(this).data('price');
                $('#ModalEdit').modal('show');
                $('.id_edit').val(id);
                $('.name_edit').val(name);
                $('.price_edit').val(price);
            });

            $('.btn-edit').on('click', function() {
                var id = $('.id_edit').val();
                var name = $('.name_edit').val();
                var price = $('.price_edit').val();
                $.ajax({
                    url: '<?php echo site_url("product/update"); ?>',
                    method: 'POST',
                    data: {
                        id: id,
                        name: name,
                        price: price
                    },
                    success: function() {
                        $('#ModalEdit').modal('hide');
                        $('.id_edit').val("");
                        $('.name_edit').val("");
                        $('.price_edit').val("");
                    }
                });
            });
            // END EDIT PRODUCT

            // DELETE PRODUCT
            $('#mytable').on('click', '.item_delete', function() {
                var id = $(this).data('id');
                $('#ModalDelete').modal('show');
                $('.id').val(id);
            });

            $('.btn-delete').on('click', function() {
                var id = $('.id').val();
                $.ajax({
                    url: '<?php echo site_url("product/delete"); ?>',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function() {
                        $('#ModalDelete').modal('hide');
                        $('.id').val("");
                    }
                });
            });
            // END DELETE PRODUCT

        });
    </script>
</body>

</html>