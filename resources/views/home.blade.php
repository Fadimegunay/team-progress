@extends('layouts.home.app')
@section('styles')
<link href="{{ asset('css\home.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Anasayfa</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="">Anasayfa</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                </ol>
            </div>
        </div>
        <!-- start widget -->
        <div class="state-overview">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-12">
                  <div class="info-box bg-blue">
                    <span class="info-box-icon push-bottom" style="margin: auto;"><i class="material-icons">people</i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Toplam Ziyaretçi</span>
                      <span class="info-box-number">5</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <?php 
                   /* date_default_timezone_set('Europe/Istanbul');
                    $dates = "%".date('Y-m-d H:')."%";
                    $query = sprintf("select id from track where dates like '%s'", $dates);
                    $result = mysqli_query($GLOBALS['con'], $query);
                    $count = mysqli_num_rows($result);*/
                ?>
                <div class="col-xl-3 col-md-6 col-12">
                  <div class="info-box bg-orange">
                    <span class="info-box-icon push-bottom" style="margin: auto;"><i class="material-icons">camera_front</i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Online Ziyaretçi</span>
                      <span class="info-box-number">5</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col-12">
                  <div class="info-box bg-purple">
                    <span class="info-box-icon push-bottom" style="margin: auto;"><i class="material-icons">portrait</i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Bugünki Ziyaretçi</span>
                      <span class="info-box-number">5</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <?php 
                /*    $aylar = array(
                        'Ocak',
                        'Şubat',
                        'Mart',
                        'Nisan',
                        'Mayıs',
                        'Haziran',
                        'Temmuz',
                        'Ağustos',
                        'Eylül',
                        'Ekim',
                        'Kasım',
                        'Aralık'
                    );
                    $query = sprintf("select id from track where MONTH(dates) = MONTH(NOW()) ");
                    $result = mysqli_query($GLOBALS['con'], $query);
                    $count = mysqli_num_rows($result);*/
                ?>
                <div class="col-xl-3 col-md-6 col-12">
                  <div class="info-box bg-success">
                    <span class="info-box-icon push-bottom" style="margin: auto;"><i class="material-icons">nature_people</i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Ocak Ayı Ziyaretçi</span>
                      <span class="info-box-number">5</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- end widget -->
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Sitenizi Bugün Ziyaret Eden Kullanıcılar</header>
                        
                    </div>
                    <div class="card-body ">
                      <div class="table-wrap">
                            <div class="table-responsive tblHeightSet">
                                <table class="table display product-overview mb-30" id="support_table">
                                    <thead>
                                        <tr>
                                            <th>IP Adresi</th>
                                            <th>Tarayıcı</th>
                                            <th>Ay</th>
                                            <th>Yıl</th>
                                            <th>Giriş Zamanı</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <div class="center">
                            <div class="pagination">
                               
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection