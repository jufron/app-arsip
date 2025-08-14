document.addEventListener("DOMContentLoaded", function() {
    const URLRoute = document.getElementById('dashboard-statistic').getAttribute('data-url');

    // todo chart count pemohon & arsip setiap bulan selama 12 bulan/1 tahun dynemic
    let configChartPemohonAndArsipCountMont = {
        series: [], // Akan diisi oleh data dari server
        chart: {
            height: 350,
            type: 'area',
            toolbar: { show: false },
            // Tambahkan ini agar chart tidak error sebelum data dimuat
            animations: { enabled: false }
        },
        colors: ['#4e73df', '#f6c23e'], // biru & emas
        dataLabels: { enabled: false },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        xaxis: {
            categories: [], // Akan diisi oleh data dari server
            title: { text: 'Bulan' }
        },
        yaxis: {
            title: { text: 'Jumlah' }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        },
        // Tampilkan pesan "Loading..."
        noData: {
            text: 'Memuat data chart...'
        }
    };
    const chart1 = new ApexCharts(
        document.querySelector('#permohonan-arsip-bulan-chart'),
        configChartPemohonAndArsipCountMont
    )
    chart1.render();

    // todo chart count pemohon yang dibuat oleh setiap petugas
    let configPemohonCreatedByPetugas = {
        series: [{
            data: [] // Dikosongkan, akan diisi dari server
        }],
        chart: {
            height: 350, // Sesuaikan tinggi jika perlu
            type: 'bar',
            toolbar: { show: false },
        },
        // Palet warna yang akan digunakan secara berulang jika petugas lebih dari 5
        colors: ['#6C5CE7', '#00B894', '#E17055', '#0984E3', '#D63031', '#FDCB6E', '#2D3436'],
        plotOptions: {
            bar: {
                columnWidth: '40%',
                distributed: true, // PENTING: agar setiap bar punya warna berbeda
                borderRadius: 6,
                dataLabels: {
                    position: 'top'
                }
            }
        },
        dataLabels: {
            enabled: true,
            offsetY: -20,
            style: {
                fontSize: '14px',
                colors: ["#333"]
            }
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: [], // Dikosongkan, akan diisi dari server
            labels: {
                style: {
                    fontSize: '14px',
                    fontWeight: 500
                }
            },
            axisTicks: { show: false },
            axisBorder: { show: false }
        },
        // ... sisa konfigurasi Anda (yaxis, tooltip, grid) bisa tetap sama ...
        yaxis: {
            // y-axis config
        },
        tooltip: {
            // tooltip config
        },
        // Tambahkan ini untuk user experience yang lebih baik saat data sedang dimuat
        noData: {
            text: 'Memuat data statistik petugas...'
        }
    };
    const chart2 = new ApexCharts(
        document.querySelector("#petugas-chart"),
        configPemohonCreatedByPetugas
    )
    chart2.render();

    // todo chart count tujuan pengajuan dari pemohon
    let configTujuanPengajuanPemohon = {
        series: [], // Dikosongkan, akan diisi dari server
        labels: [], // Dikosongkan, akan diisi dari server
        chart: {
            width: 380,
            type: 'pie',
            toolbar: { show: false }
        },
        colors: ['#6C5CE7', '#00B894', '#E17055', '#0984E3', '#D63031'],
        legend: {
            position: 'right',
            // ... sisa konfigurasi legend Anda
        },
        dataLabels: {
            // ... konfigurasi dataLabels Anda
        },
        tooltip: {
            // ... konfigurasi tooltip Anda
        },
        stroke: {
            // ... konfigurasi stroke Anda
        },
        responsive: [{
            // ... konfigurasi responsive Anda
        }],
        // Pesan yang ditampilkan saat data sedang diambil dari server
        noData: {
            text: 'Memuat data...'
        }
    };
    const chart3 = new ApexCharts(
        document.querySelector("#pengajuan-chart"),
        configTujuanPengajuanPemohon
    )
    chart3.render();

    let configLokasiPenyimpanan = {
        series: [{
            data: [] // Akan diisi dari server
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: false },
        },
        colors: ['#6C5CE7', '#00B894', '#E17055', '#0984E3', '#D63031'],
        plotOptions: {
            bar: {
                borderRadius: 6,
                horizontal: true,
                distributed: true, // PENTING: agar tiap bar beda warna
                dataLabels: {
                    position: 'center'
                }
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) { return val; },
            style: {
                fontSize: '14px',
                colors: ["#fff"]
            }
        },
        xaxis: {
            categories: [], // Akan diisi dari server
            labels: {
                style: {
                    fontSize: '14px',
                    fontWeight: 500
                    // Kita tidak perlu mendefinisikan warna di sini lagi
                }
            },
            axisTicks: { show: false },
            axisBorder: { show: false }
        },
        // ... sisa konfigurasi Anda bisa tetap sama (yaxis, tooltip, grid)
        noData: {
            text: 'Memuat data lokasi penyimpanan...'
        }
    };
    const chart4 = new ApexCharts(
        document.querySelector("#lokasi-chart"),
        configLokasiPenyimpanan
    )
    chart4.render();

    // todo chart count pemohon dan arsip
    let configPemohonDanArsip = {
        series: [{
            name: 'Jumlah',
            data: [] // Dikosongkan, akan diisi dari server
        }],
        chart: {
            height: 350,
            type: 'bar',
            toolbar: { show: false },
        },
        colors: ['#6C5CE7', '#00B894'],
        plotOptions: {
            bar: {
                borderRadius: 8,
                distributed: true,
                dataLabels: {
                    position: 'top'
                },
                columnWidth: '40%'
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                // Perbaikan: Tampilkan nilai absolut, bukan persentase
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '14px',
                fontWeight: 500,
                colors: ["#333"]
            }
        },
        xaxis: {
            categories: [], // Dikosongkan, akan diisi dari server
            position: 'top',
            labels: {
                style: {
                    fontSize: '14px',
                    fontWeight: 500
                }
            },
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        // ... sisa konfigurasi Anda bisa tetap sama (tooltip, grid, title)
        noData: {
            text: 'Memuat data...' // Pesan saat data belum terisi
        }
    };
    const chart5 = new ApexCharts(
        document.querySelector("#pemohon-arsip-chart"),
        configPemohonDanArsip
    )
    chart5.render();

    // * fetch
    fetch(URLRoute)
        .then(response => response.json())
        .then(data => {
            console.log(data);

            const chartPemohonDanArsipSetiapBulan = data.pemohon_dan_arsip_setiap_bulan;
            chart1.updateOptions({
                series: chartPemohonDanArsipSetiapBulan.series,
                xaxis: {
                    categories: chartPemohonDanArsipSetiapBulan.categories
                },
                chart: {
                    animations: { enabled: true }
                }
            });

            const chartPetugasPenambahanPemohon = data.petugas_create_pemohon;
            chart2.updateOptions({
                series: [{
                    data: chartPetugasPenambahanPemohon.seriesData
                }],
                xaxis: {
                    categories: chartPetugasPenambahanPemohon.categories
                }
            });

            const chartTujuanPengajuanPemohon = data.jenis_pengurusan_pemohon;
            chart3.updateOptions({
                series: chartTujuanPengajuanPemohon.series,
                labels: chartTujuanPengajuanPemohon.labels
            });

            const chartLokasiPenyimpananArsip = data.lokasi_arisp;
            console.log(chartLokasiPenyimpananArsip);
            chart4.updateOptions({
                series: [{
                    data: chartLokasiPenyimpananArsip.seriesData
                }],
                xaxis: {
                    categories: chartLokasiPenyimpananArsip.categories
                }
            });

            const chartPemohonDanArsip = data.pemohon_and_arisp;
            chart5.updateOptions({
                series: [{
                    data: chartPemohonDanArsip.seriesData
                }],
                xaxis: {
                    categories: chartPemohonDanArsip.categories
                }
            });

        })
        .catch(error => {
            console.error('Error fetching chart data:', error);
            chart.updateOptions({
                noData: { text: 'Gagal memuat data.' }
            });
        });


});
