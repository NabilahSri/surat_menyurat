@extends('template_main')

@section('content')
<style>
    .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 1300px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
</style>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->role == "superadmin" || auth()->user()->role == "admin")
                    <div class="d-flex justify-content-between align-itmes-center">
                        <div>
                            <div class="p-3 rounded bg-soft-primary">
                                <svg class="icon-30" width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M11.9951 16.6766V14.1396" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.19 5.33008C19.88 5.33008 21.24 6.70008 21.24 8.39008V11.8301C18.78 13.2701 15.53 14.1401 11.99 14.1401C8.45 14.1401 5.21 13.2701 2.75 11.8301V8.38008C2.75 6.69008 4.12 5.33008 5.81 5.33008H18.19Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.4951 5.32576V4.95976C15.4951 3.73976 14.5051 2.74976 13.2851 2.74976H10.7051C9.48512 2.74976 8.49512 3.73976 8.49512 4.95976V5.32576" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M2.77441 15.4829L2.96341 17.9919C3.09141 19.6829 4.50041 20.9899 6.19541 20.9899H17.7944C19.4894 20.9899 20.8984 19.6829 21.0264 17.9919L21.2154 15.4829" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                            </div>
                        </div>
                        <div>
                            <h1 class="text-end">{{ $unitkerja }}</h1>
                            <p class="mb-0 text-end">Total Unit Kerja / Bagian</p>
                        </div>
                    </div>
                @else 
                    <div class="d-flex justify-content-between align-itmes-center">
                        <div>
                            <div class="p-3 rounded bg-soft-primary">
                                <svg class="icon-30" width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M11.9951 16.6766V14.1396" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.19 5.33008C19.88 5.33008 21.24 6.70008 21.24 8.39008V11.8301C18.78 13.2701 15.53 14.1401 11.99 14.1401C8.45 14.1401 5.21 13.2701 2.75 11.8301V8.38008C2.75 6.69008 4.12 5.33008 5.81 5.33008H18.19Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.4951 5.32576V4.95976C15.4951 3.73976 14.5051 2.74976 13.2851 2.74976H10.7051C9.48512 2.74976 8.49512 3.73976 8.49512 4.95976V5.32576" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M2.77441 15.4829L2.96341 17.9919C3.09141 19.6829 4.50041 20.9899 6.19541 20.9899H17.7944C19.4894 20.9899 20.8984 19.6829 21.0264 17.9919L21.2154 15.4829" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                            </div>
                        </div>
                        <div>
                            <h1 class="text-end">{{ $totalSurat }}</h1>
                            <p class="mb-0 text-end">Total Semua Surat</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-itmes-center">
                    <div>
                        <div class="p-3 rounded bg-soft-success">
                            <svg class="icon-30" width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                        </div>
                    </div>
                    <div>
                        <h1 class="text-end">{{ $disposisi }}</h1>
                        <p class="mb-0 text-end">Total Riwayat Disposisi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-itmes-center">
                    <div>
                        <div class="p-3 rounded bg-soft-warning">
                            <svg class="icon-30" width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M17.9028 8.85107L13.4596 12.4641C12.6201 13.1301 11.4389 13.1301 10.5994 12.4641L6.11865 8.85107" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                        </div>
                    </div>
                    <div>
                        <h1 class="text-end">{{ $suratmasuk }}</h1>
                        <p class="mb-0 text-end">Total Surat Masuk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-itmes-center">
                    <div>
                        <div class="p-3 rounded bg-soft-info">
                            <svg class="icon-30" width="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M17.9028 8.85107L13.4596 12.4641C12.6201 13.1301 11.4389 13.1301 10.5994 12.4641L6.11865 8.85107" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                        </div>
                    </div>
                    <div>
                        <h1 class="text-end">{{ $suratkeluar }}</h1>
                        <p class="mb-0 text-end">Total Surat Keluar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role == "superadmin" || auth()->user()->role == "admin")
    <div class="col col-lg-8 col-md-8">
        <div class="card">
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="containerdivisi"></div>
                </figure>
            </div>
        </div>
    </div>
    <div class="col col-lg-4 col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Surat Masuk Harian</h5>
                <div class="table-responsive mt-3">
                    @if ($jml_surat_masuk->isEmpty())
                        <p>Tidak ada data surat masuk harian untuk saat ini.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 40px">No</th>
                                    <th>Unit Kerja</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jml_surat_masuk as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_unit_kerja }}</td>
                                        <td>{{ $item->jml }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>    
    @endif
</div>

<script>
    Highcharts.chart('containerdivisi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistika Surat Masuk Berdasarkan Unit Kerja',
            align: 'center'
        },
        xAxis: {
            categories: <?= $json_divisi; ?>,
            crosshair: false,
            accessibility: {
                description: 'Unit Kerja'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: <?= $totaldivisi; ?>
    });
</script>


    
@endsection