<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Phiếu bảo hành</title>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/default.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition" onload="window.print();">
    <div class="container">
        <div class="warranty">
            <div class="col-xs-12 warranty-border">
                <p class="lead text-center" style="font-weight: bold">PHIẾU BẢO HÀNH </p>
                <P class="text-center">Vui lòng trình phiếu khi có nhu cầu sửa chữa - bảo hành</P>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:35%">Sản phẩm:</th>
                                <td>{{ $product->product->p_name }}</td>
                            </tr>
                            <tr>
                                <th>Mã sản phẩm :</th>
                                <td>{{ $product->product->p_code }}</td>
                            </tr>
                            
                            <tr>
                                <th>Khách hàng:</th>
                                <td>{{ isset($product->customer) ? $product->customer->ct_name : '' }}</td>
                            </tr>
                            <tr>
                                <th>Số điện thoại:</th>
                                <td>{{ isset($product->customer) ? $product->customer->ct_phone : '' }}</td>
                            </tr>
                            <tr>
                                <th>Ngày mua:</th>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Ngày hết hạn bảo hành:</th>
                                <td>{{ !empty($product->product->p_warranty_period) ?  addMonthWarranty($product->created_at, $product->product->p_warranty_period) : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin-bottom: 60px">
                    <div class="signature">
                        <div class="signature-50">
                            <p class="text-center">Cửa hàng ( Ký tên )</p>
                        </div>
                        <div class="signature-50">
                            <p class="text-center">Khách hàng ( Ký tên )</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('admin/theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
